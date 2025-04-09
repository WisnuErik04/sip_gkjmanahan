<?php

namespace App\Livewire;

use App\Models\Form;
use App\Models\Request;
use Livewire\Component;
use App\Models\UploadFile;
use App\Models\RequestStatus;
use Livewire\WithFileUploads;
use App\Models\FormPertanyaan;
use App\Models\ListUploadForm;
use App\Services\FonnteService;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\RequestStatusesMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Spatie\LivewireFilepond\WithFilePond;

class FormPermohonan extends Component
{

    use WithFilePond;
    // use WithFileUploads;

    public $pemohon_nama, $pemohon_hp_telepon, $pemohon_email, $pemohon_warga_blok, $pemohon_alamat;
    public $form_id, $listUploads, $pertanyaans = [];
    public $uploadedFiles = [];
    public $answers = [];
    public $uploadProgress = [];
    public $forms;
    protected $listeners = ['upload:progress' => 'updateProgress'];

    public $step = 1;

    public function nextStep()
    {
        $this->resetErrorBag(); // Reset error sebelum validasi

        if ($this->step === 1) {
            $this->validate([
                'pemohon_nama' => 'required|string',
                'pemohon_hp_telepon' => 'required|regex:/^0\d{9,14}$/',
                'pemohon_email' => 'required|email',
                'pemohon_warga_blok' => 'required|string',
                'pemohon_alamat' => 'required|string',
            ]);
        }

        if ($this->step === 2) {
            $this->validate([
                'form_id' => 'required|exists:forms,id',
            ]);

            // $pertanyaans = FormPertanyaan::where('form_id', $this->form_id)->orderBy('order')->get();
            // $this->$pertanyaans = $pertanyaans;
            // $listUploads = ListUploadForm::where('form_id', $this->form_id)->get();
            // $this->$listUploads = $listUploads;
            // foreach ($pertanyaans as $pertanyaan) {
            //     if ($pertanyaan->required && $pertanyaan->tipe_jawaban !== 'header') {
            //         $this->validate([
            //             "answers.{$pertanyaan->order}" => 'required',
            //         ]);
            //     }
            // }

            // foreach ($listUploads as $upload) {
            //     if ($upload->is_required) {
            //         $this->validate([
            //             "uploadedFiles.{$upload->id}" => 'required',
            //         ]);
            //     }
            // }
        }

        if ($this->step === 3) {
            $pertanyaans = FormPertanyaan::where('form_id', $this->form_id)->orderBy('order')->get();
            // $this->$pertanyaans = $pertanyaans;
            $messages = [];

            foreach ($pertanyaans as $pertanyaan) {
                if ($pertanyaan->tipe_jawaban !== 'header') {
                    $fieldName = 'answers.' . $pertanyaan->order;

                    if (!isset($this->answers[$pertanyaan->order])) {
                        $this->answers[$pertanyaan->order] = null;
                    }

                    if ($pertanyaan->required) {
                        $rules[$fieldName] = 'required';
                        $messages[$fieldName . '.required'] = $pertanyaan->pertanyaan . ' harus diisi.';
                    } else {
                        $rules[$fieldName] = 'nullable';
                        $messages[$fieldName . '.nullable'] = '';
                    }
                }
            }
            $this->validate($rules, $messages);
        }

        if ($this->step === 4) {
            $listUploads = ListUploadForm::where('form_id', $this->form_id)->get();
            // $this->$listUploads = $listUploads;
            $messages = [];

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
            $this->validate($rules, $messages);
        }
        $this->step++;
    }


    public function previousStep()
    {
        $this->step--;
    }

    public function updateProgress($event, $percentage)
    {
        // dd($event);
        $this->uploadProgress[$event] = $percentage;
    }

    public function updatedFormId()
    {
        $this->listUploads = ListUploadForm::where('form_id', $this->form_id)->get();
        $this->pertanyaans = FormPertanyaan::where('form_id', $this->form_id)->orderBy('order')->get();
    }

    // public function mount()
    // {
    //     $this->forms = Form::all(); // Ambil daftar form dari database
    // }

    public function mount($existingAnswers = [])
    {
        $this->forms = Form::select('id', 'name')->get(); // Ambil daftar form dari database
        $this->answers = $existingAnswers;
    }

    // public function submit()
    // {

    //     $this->validate([
    //         'pemohon_nama' => 'required|string',
    //         'pemohon_hp_telepon' => 'required|string',
    //         'pemohon_email' => 'required|email',
    //         'pemohon_warga_blok' => 'required|string',
    //         'pemohon_alamat' => 'required|string',
    //         'form_id' => 'required|exists:forms,id',
    //         'uploadedFiles' => 'array',
    //         'uploadedFiles.*' => 'required|file|max:2048',
    //     ]);

    //     //     dd('Validasi sukses');

    //     $permohonan = Request::create([
    //         'pemohon_nama' => $this->pemohon_nama,
    //         'pemohon_hp_telepon' => $this->pemohon_hp_telepon,
    //         'pemohon_email' => $this->pemohon_email,
    //         'pemohon_warga_blok' => $this->pemohon_warga_blok,
    //         'pemohon_alamat' => $this->pemohon_alamat,
    //         'form_id' => $this->form_id,
    //         'user_id' => '1',
    //         'request_status_id' => RequestStatus::where('name', 'Pengajuan')->pluck('id')->first(),
    //     ]);

    //     // dd($this->uploadedFiles);
    //     // Simpan file yang diunggah
    //     foreach ($this->uploadedFiles as $uploadId => $file) {
    //         // dd($file);
    //         $path = $file->store('uploads/form_permohonan', 'public');
    //         $size = $file->getSize(); // Mengambil ukuran file dalam byte
    //         $sizeInKB = round($size / 1024, 2); // Konversi ke KB
    //         $fileExtension = $file->getClientOriginalExtension();
    //         // dd('asas '.$uploadId);
    //         UploadFile::create([
    //             'request_id' => $permohonan->id,
    //             'list_upload_form_id' => $uploadId,
    //             'file_name' => ListUploadForm::find($uploadId)->name ?? 'Dokumen',
    //             'file_path' => $path,
    //             'file_type' => $fileExtension,
    //             'file_size' => $sizeInKB,
    //         ]);
    //     }

    //     // Reset form setelah submit
    //     $this->resetExcept('forms');
    //     $this->listUploads = []; // Kosongkan daftar unggahan

    //     session()->flash('message', 'Permohonan berhasil disimpan!');
    // }

    public function submit()
    {
        DB::beginTransaction(); // Mulai transaksi untuk mencegah error

        try {

            $listUploads = ListUploadForm::where('form_id', $this->form_id)->get();
            $pertanyaans = FormPertanyaan::where('form_id', $this->form_id)->orderBy('order')->get();

            $rules = [
                'pemohon_nama' => 'required|string',
                'pemohon_hp_telepon' => 'required|string',
                'pemohon_email' => 'required|email',
                'pemohon_warga_blok' => 'required|string',
                'pemohon_alamat' => 'required|string',
                'form_id' => 'required|exists:forms,id',
                'uploadedFiles' => 'array',
            ];

            $messages = [];

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

            foreach ($pertanyaans as $pertanyaan) {
                if ($pertanyaan->tipe_jawaban !== 'header') {
                    $fieldName = 'answers.' . $pertanyaan->order;

                    if (!isset($this->answers[$pertanyaan->order])) {
                        $this->answers[$pertanyaan->order] = null;
                    }

                    if ($pertanyaan->required) {
                        $rules[$fieldName] = 'required';
                        $messages[$fieldName . '.required'] = $pertanyaan->pertanyaan . ' harus diisi.';
                    } else {
                        $rules[$fieldName] = 'nullable';
                        $messages[$fieldName . '.nullable'] = '';
                    }
                }
            }
            $this->validate($rules, $messages);

            // Simpan permohonan
            $permohonan = Request::create([
                'pemohon_nama' => $this->pemohon_nama,
                'pemohon_hp_telepon' => $this->pemohon_hp_telepon,
                'pemohon_email' => $this->pemohon_email,
                'pemohon_warga_blok' => $this->pemohon_warga_blok,
                'pemohon_alamat' => $this->pemohon_alamat,
                'form_id' => $this->form_id,
                'telah_dijadwalkan_sidang' => false,
                'form_answers' => $this->answers,
                // 'user_id' => '1',
                'request_status_id' => RequestStatus::where('name', 'Pengajuan')->pluck('id')->first(),
            ]);

            // Simpan file yang diunggah
            foreach ($this->uploadedFiles as $uploadId => $file) {
                $path = $file->store('uploads/form_permohonan', 'public');
                $size = round($file->getSize() / 1024, 2); // Konversi ke KB
                $fileExtension = $file->getClientOriginalExtension();

                UploadFile::create([
                    'request_id' => $permohonan->id,
                    'list_upload_form_id' => $uploadId,
                    'file_name' => ListUploadForm::find($uploadId)->name ?? 'Dokumen',
                    'file_path' => $path,
                    'file_type' => $fileExtension,
                    'file_size' => $size,
                ]);
            }

            // **Generate PDF dan Simpan Path dalam Request**
            $pdfPath = $this->generateAndSavePDF($permohonan);
            $permohonan->update(['form_file_path' => $pdfPath]);

            $JenisPermohonan = Form::where('id', $this->form_id)->pluck('name')->first();
            $status = 'Pengajuan';
            $notes = 'Permohonan telah diajukan dan diproses pada kesekretariatan';
            $data = [
                'pemohon_nama' => $permohonan->pemohon_nama,
                'pemohon_warga_blok' => $permohonan->pemohon_warga_blok,
                'pemohon_alamat' => $permohonan->pemohon_alamat,
                'form' => $JenisPermohonan,
                'status' => $status,
                'notes' => $notes,
            ];
            // Mail::to($permohonan->pemohon_email)->send(new RequestStatusesMail($data));

            $fonnteService = new FonnteService();
            $message = "Detail Permohonan:\n";
            $message .= "Nama: $permohonan->pemohon_nama\n";
            $message .= "Warga Blok/Pepanthan: $permohonan->pemohon_warga_blok\n";
            $message .= "Jenis Permohonan: $JenisPermohonan\n";
            $message .= "Status: $status\n";
            $message .= "Keterangan: " . $notes . "\n";
            $message .= "\nTerima kasih,\nAdmin Sekretariat GKJ Manahan Surakarta";
            $fonnteService->sendMessage($permohonan->pemohon_hp_telepon, $message);

            DB::commit(); // **Simpan Semua Perubahan Jika Berhasil**
            // Reset form setelah submit
            $this->resetExcept('forms');
            $this->listUploads = []; // Kosongkan daftar unggahan
            return redirect()->route('form.success');
            // session()->flash('message', 'Permohonan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack(); // **Rollback jika ada error**
            // dd($e); // atau dd($e->getMessage());
            return redirect()->route('form.gagal');
            // session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

    protected function attributes()
    {
        return [
            'pemohon_nama' => 'Nama Pemohon',
            'pemohon_hp_telepon' => 'Nomor HP/Telpon',
            'pemohon_email' => 'Alamat Email',
            'pemohon_warga_blok' => 'Blok Rumah',
            'pemohon_alamat' => 'Alamat Lengkap',
            'form_id' => 'Form Permohonan',
            'uploadedFiles.*' => 'File yang diunggah',
        ];
    }

    protected function messages()
    {
        return [
            'pemohon_nama.required' => 'Nama Pemohon harus diisi.',
            'pemohon_hp_telepon.required' => 'Nomor HP/Telpon harus diisi.',
            'pemohon_email.required' => 'Alamat Email harus diisi.',
            'pemohon_email.email' => 'Alamat Email tidak valid.',
            'pemohon_warga_blok.required' => 'Blok Rumah harus diisi.',
            'pemohon_alamat.required' => 'Alamat Lengkap harus diisi.',
            'form_id.required' => 'Form Permohonan harus dipilih.',
            'form_id.exists' => 'Form Permohonan tidak valid.',
            'uploadedFiles.*.file' => 'File yang diunggah harus berupa file.',
            'uploadedFiles.*.max' => 'File yang diunggah tidak boleh lebih dari 2MB.',
        ];
    }


    public function render()
    {
        return view('livewire.form-permohonan', [
            'currentStep' => $this->step
        ]);
    }
}
