<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\FormPertanyaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function export($requestId)
    {
        // Ambil data form
        $request = Request::where('id', $requestId)->first();
        if (!$request) {
            abort(404, 'Form tidak ditemukan');
        }
        $formId = $request->form_id;

        // Ambil pertanyaan dan jawaban
        $pertanyaans = FormPertanyaan::where('form_id', $formId)->orderBy('order')->get();
        // if ($formId == '2') {
        //     $view = 'pdf.baptis_anak';
        // } elseif ($formId == '3') {
        //     $view = 'pdf.baptis_dewasa';
        // } elseif ($formId == '4') {
            $view = 'pdf.pernikahan';
        // } elseif ($formId == '5') {
            // $view = 'pdf.attestasi_masuk';
        // } elseif ($formId == '6') {
            // $view = 'pdf.attestasi_keluar';
        // } else {
            // $view = 'pdf.default';
        // }
        // dd($request->form->name);
        
        $answers = $request->form_answers; // Tidak perlu json_decode()
        // Tentukan template berdasarkan form_id
        // $view = ($formId == 1) ? 'pdf.baptis' : 'pdf.nikah';

        // return view($view, compact('request', 'pertanyaans', 'answers'));
        // Generate PDF
        $pdf = Pdf::loadView($view, compact('request', 'pertanyaans', 'answers'))
                    ->setPaper('legal', 'portrait'); // Bisa juga 'landscape' jika diperlukan

        return $pdf->stream('formulir.pdf');
    }
}
