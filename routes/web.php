<?php

use App\Models\Request;
use App\Models\UploadFile;
use App\Services\FonnteService;
use App\Mail\RequestStatusesMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Filament\User\Pages\PublicForm;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PublicFormController;

// Route::get('/', function () {
//     return view('landing');
// });
Route::get('/', [LandingController::class, 'index'])->name('home');
// Route::get('/note', [NoteController::class, 'index'])->name('note.index');

Route::get('/form-permohonan', function () {
    return view('form-permohonan', [
        'menu' => "Form Permohonan",
    ]);
})->name('form-permohonan');
Route::get('/form-success', function () {
    return view('form-success', [
        'menu' => "Form Permohonan",
    ]);
})->name('form.success');
Route::get('/form-gagal', function () {
    return view('form-gagal', [
        'menu' => "Form Permohonan",
    ]);
})->name('form.gagal');


// Route::get('/tes-email', function () {
//     $data = [
//         'pemohon_nama' => '$permohonan->pemohon_nama',
//         'pemohon_warga_blok' => '$permohonan->pemohon_warga_blok',
//         'pemohon_alamat' => '$permohonan->pemohon_alamat',
//         'form' => "Form::where('id', )->pluck('name')->first()",
//         'status' => "Pengajuan",
//     ];
//     Mail::to('erikwnugroho@gmail.com')->send(new RequestStatusesMail($data));
// })->name('tes-email');

// Route::get('/form-permohonan', [PublicFormController::class, 'index'])->name('form-permohonan');
// Route::get('/form-permohonan', PublicForm::class)->name('public-form');
Route::get('/download-file-upload/{id}', function ($id) {
    if (!auth()->user()) {
        abort(403);
    }

    $file = UploadFile::findOrFail($id);
    
    // Ambil path dari storage
    $filePath = $file->file_path;

    if (Storage::disk('public')->exists($filePath)) {
        return Storage::disk('public')->download($filePath);
    }

    abort(404, 'File tidak ditemukan');
})->name('file.download');

Route::get('/view-file-upload/{id}', function ($id) {
    if (!auth()->user()) {
        abort(403);
    }

    $file = UploadFile::findOrFail($id);
    
    // Ambil path dari storage
    $filePath = $file->file_path;

    if (Storage::disk('public')->exists($filePath)) {
        // return Storage::disk('public')->view($filePath);
        return response()->file(Storage::disk('public')->path($filePath));
    }

    abort(404, 'File tidak ditemukan');

})->name('file.view');

Route::get('/download-file/{id}', function ($id) {
    if (!auth()->user()) {
        abort(403);
    }

    $file = Request::select('form_file_path')->findOrFail($id);
    
    // Ambil path dari storage
    $filePath = $file->form_file_path;

    if (Storage::disk('public')->exists($filePath)) {
        return Storage::disk('public')->download($filePath);
    }

    abort(404, 'File tidak ditemukan');
})->name('file.downloadForm');
Route::get('/view-file/{id}', function ($id) {
    if (!auth()->user()) {
        abort(403);
    }

    $file = Request::select('form_file_path')->findOrFail($id);
    
    // Ambil path dari storage
    $filePath = $file->form_file_path;

    if (Storage::disk('public')->exists($filePath)) {
        // return Storage::disk('public')->download($filePath);
        return response()->file(Storage::disk('public')->path($filePath));

    }

    abort(404, 'File tidak ditemukan');
})->name('file.viewForm');

Route::get('/laporan-agenda/excel/{id}', [ReportController::class, 'exportExcel'])->name('laporan.agenda.excel');
Route::get('/laporan-pleno/excel/{id}', [ReportController::class, 'exportPlenoExcel'])->name('laporan.pleno.excel');
Route::get('/export-form/{request_id}', [PdfController::class, 'export'])->name('export.form');

// Route::get('/test-wa/{id}', function ($id) {
//     $user = User::findOrFail($id);

//     $fonnteService = new FonnteService();
//     $message = "Halo " . $user->name . ", ini adalah pesan percobaan dari Laravel.";

//     $response = $fonnteService->sendMessage($user->whatsapp, $message);

//     return response()->json($response);
// });
Route::get('/test-wa', function () {
    // $user = User::findOrFail($id);
    $user_name = "Erik Wisnu";
    $user_whatsapp = "08122771747wwqw1";
    // $user_whatsapp = "0895349290103";
    $fonnteService = new FonnteService();
    $message = "Halo " . $user_name . ", ini adalah pesan percobaan dari Laravel.";

    $message = "Detail Permohonan:\n";
    $message .= "Nama: data_pemohon_nama']\n";
    $message .= "Warga Blok/Pepanthan: data_pemohon_warga_blok']\n";
    $message .= "Jenis Permohonan: data_form']\n";
    $message .= "Status: data_status']\n";
    $message .= "Keterangan: (data_notes?\n";
    $message .= "\nThanks,\nAdmin";

    $response = $fonnteService->sendMessage($user_whatsapp, $message);

    return response()->json($response);
});