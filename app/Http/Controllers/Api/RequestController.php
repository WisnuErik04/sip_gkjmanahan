<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use App\Models\RequestStatus;
use App\Models\FormPertanyaan;
use App\Models\ListUploadForm;
use App\Services\FonnteService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction(); // Mulai transaksi untuk mencegah error

        try {
            // Ambil data list uploads dan pertanyaan berdasarkan form_id
            $listUploads = ListUploadForm::where('form_id', $request->form_id)->get();
            $pertanyaans = FormPertanyaan::where('form_id', $request->form_id)->orderBy('order')->get();

            // Validasi input
            $rules = [
                'pemohon_nama' => 'required|string',
                'pemohon_hp_telepon' => [
                    'required',
                    'regex:/^0\d{9,14}$/'
                ],
                'pemohon_email' => 'required|email',
                'pemohon_warga_blok' => 'required|string',
                'pemohon_alamat' => 'required|string',
                'form_id' => 'required|exists:forms,id',
                'uploadedFiles' => 'array',
            ];

            $messages = [];
            // Validasi setiap upload file
            foreach ($listUploads as $upload) {
                $fieldName = 'uploadedFiles.' . $upload->id;

                if ($upload->is_required) {
                    $rules[$fieldName] = 'required|file|max:2048';
                    $messages[$fieldName . '.required'] = $upload->name . ' wajib diunggah.';
                } else {
                    $rules[$fieldName] = 'nullable|file|max:2048';
                }

                // Tentukan jenis file yang diperbolehkan
                if ($upload->upload_type == 'pdf') {
                    $rules[$fieldName] .= '|mimes:pdf';
                    $messages[$fieldName . '.mimes'] = $upload->name . ' harus berupa file PDF.';
                } elseif ($upload->upload_type == 'image') {
                    $rules[$fieldName] .= '|mimes:jpg,jpeg,png';
                    $messages[$fieldName . '.mimes'] = $upload->name . ' harus berupa gambar (JPG, JPEG, PNG).';
                }
            }

            // Validasi setiap pertanyaan form
            $answers = $request->input('answers', []);
            foreach ($pertanyaans as $pertanyaan) {
                if ($pertanyaan->tipe_jawaban !== 'header') {
                    $fieldName = 'answers.' . $pertanyaan->order;

                    if (!isset($answers[$pertanyaan->order])) {
                        $answers[$pertanyaan->order] = null;
                    }

                    if ($pertanyaan->required) {
                        $rules[$fieldName] = 'required';
                        $messages[$fieldName . '.required'] = $pertanyaan->pertanyaan . ' harus diisi.';
                    } else {
                        $rules[$fieldName] = 'nullable';
                    }
                }
            }

            // Validasi data
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terjadi kesalahan dalam validasi data.',
                    'data' => $validator->errors()
                ], 422);
            }

            // // Simpan permohonan
            // $permohonan = RequestModel::create([
            //     'pemohon_nama' => $request->pemohon_nama,
            //     'pemohon_hp_telepon' => $request->pemohon_hp_telepon,
            //     'pemohon_email' => $request->pemohon_email,
            //     'pemohon_warga_blok' => $request->pemohon_warga_blok,
            //     'pemohon_alamat' => $request->pemohon_alamat,
            //     'form_id' => $request->form_id,
            //     'telah_dijadwalkan_sidang' => false,
            //     'form_answers' => $answers,
            //     'request_status_id' => RequestStatus::where('name', 'Pengajuan')->pluck('id')->first(),
            // ]);

            // // Simpan file yang diunggah
            // foreach ($request->uploadedFiles as $uploadId => $file) {
            //     $path = $file->store('uploads/form_permohonan', 'public');
            //     $size = round($file->getSize() / 1024, 2); // Konversi ke KB
            //     $fileExtension = $file->getClientOriginalExtension();

            //     UploadFile::create([
            //         'request_id' => $permohonan->id,
            //         'list_upload_form_id' => $uploadId,
            //         'file_name' => ListUploadForm::find($uploadId)->name ?? 'Dokumen',
            //         'file_path' => $path,
            //         'file_type' => $fileExtension,
            //         'file_size' => $size,
            //     ]);
            // }

            // // **Generate PDF dan Simpan Path dalam Request**
            // $pdfPath = $this->generateAndSavePDF($permohonan);
            // $permohonan->update(['form_file_path' => $pdfPath]);

            // // Mengirim notifikasi via WhatsApp
            // $JenisPermohonan = Form::where('id', $request->form_id)->pluck('name')->first();
            // $status = 'Pengajuan';
            // $notes = 'Permohonan telah diajukan dan diproses pada kesekretariatan';
            // $data = [
            //     'pemohon_nama' => $permohonan->pemohon_nama,
            //     'pemohon_warga_blok' => $permohonan->pemohon_warga_blok,
            //     'pemohon_alamat' => $permohonan->pemohon_alamat,
            //     'form' => $JenisPermohonan,
            //     'status' => $status,
            //     'notes' => $notes,
            // ];
            // $fonnteService = new FonnteService();
            // $message = "Detail Permohonan:\n";
            // $message .= "Nama: $permohonan->pemohon_nama\n";
            // $message .= "Warga Blok/Pepanthan: $permohonan->pemohon_warga_blok\n";
            // $message .= "Jenis Permohonan: $JenisPermohonan\n";
            // $message .= "Status: $status\n";
            // $message .= "Keterangan: " . $notes . "\n";
            // $message .= "\nTerima kasih,\nAdmin Sekretariat GKJ Manahan Surakarta";
            // $fonnteService->sendMessage($permohonan->pemohon_hp_telepon, $message);

            // DB::commit(); // **Simpan Semua Perubahan Jika Berhasil**

            return response()->json([
                'status' => true,
                'message' => 'Permohonan berhasil disimpan!',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack(); // **Rollback jika ada error**
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    private function generateAndSavePDF($request)
    {
        // Data untuk PDF
        // $data = [
        //     'title' => 'Hasil Jawaban Form',
        //     'pemohon_nama' => $permohonan->pemohon_nama,
        //     'pemohon_warga_blok' => $permohonan->pemohon_warga_blok,
        //     'pemohon_alamat' => $permohonan->pemohon_alamat,
        //     'form' => Form::where('id', $permohonan->form_id)->pluck('name')->first(),
        //     'answers' => json_decode($permohonan->form_answers, true),
        // ];

        // **Buat PDF dari View**
        // $pdf = Pdf::loadView('pdf.form', $data);
        $formId = $request->form_id;
        $pertanyaans = FormPertanyaan::where('form_id', $formId)->orderBy('order')->get();
        if ($formId == '2') {
            $view = 'pdf.baptis_anak';
        } elseif ($formId == '3') {
            $view = 'pdf.baptis_dewasa';
        } elseif ($formId == '4') {
            $view = 'pdf.pernikahan';
        } elseif ($formId == '5') {
            $view = 'pdf.attestasi_masuk';
        } elseif ($formId == '6') {
            $view = 'pdf.attestasi_keluar';
        } else {
            $view = 'pdf.default';
        }

        $answers = $request->form_answers;
        $pdf = Pdf::loadView($view, compact('request', 'pertanyaans', 'answers'))
            ->setPaper('legal', 'portrait'); // Bisa juga 'landscape' jika diperlukan

        // **Simpan PDF ke Storage**
        $pdfFileName = 'form_permohonan_' . $request->id . '.pdf';
        $pdfPath = 'uploads/form_permohonan/' . $pdfFileName;

        Storage::disk('public')->put($pdfPath, $pdf->output());

        return $pdfPath; // Path ini akan disimpan di tabel request
    }
}
