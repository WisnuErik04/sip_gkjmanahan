<?php

namespace App\Filament\Resources\RequestResource\Pages;

use Filament\Actions;
use Illuminate\Http\File;
use App\Models\UploadFile;
use App\Models\ListUploadForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\RequestResource;

class CreateRequest extends CreateRecord
{
    protected static string $resource = RequestResource::class;

    // protected function handleRecordCreation(array $data): Model
    // {
    //     // Debugging: Cek data yang diterima sebelum diproses
    //     // dd($data);

    //     // Buat request baru
    //     $request = static::getModel()::create($data);

    //     // Ambil daftar file berdasarkan form_id
    //     $listUploads = ListUploadForm::where('form_id', $request->form_id)->get();

    //     foreach ($listUploads as $upload) {
    //         $fileKey = 'file_' . $upload->id;

    //         // Debugging: Cek apakah file key ada dalam data
    //         if (isset($data[$fileKey])) {
    //             // dd($data[$fileKey]); // Pastikan apakah ini string atau instance UploadedFile

    //             $filePath  = $data[$fileKey];

    //             // if (!$file instanceof \Illuminate\Http\UploadedFile) {
    //             //     continue;
    //             // }
    //             $file = [];
    //             if (Storage::exists($filePath)) {
    //                 // Buat instance File dari storage path
    //                 $file = new File(Storage::path($filePath));
    //             } else {
    //                 dd($filePath);
    //                 // continue; // Lewati jika file tidak ditemukan
    //             }
    //             // Simpan file ke storage permanen
    //             // $filePath = $file->store('uploads/form_permohonan', 'public');

    //             // Debugging: Pastikan file tersimpan di storage
    //             // dd($filePath);

    //             // Simpan data file ke database
    //             UploadFile::create([
    //                 'request_id'          => $request->id,
    //                 'list_upload_form_id' => $upload->id,
    //                 'file_path'           => $filePath,
    //                 'file_name'           => $file->getClientOriginalName(),
    //                 'file_type'           => $file->getClientOriginalExtension(),
    //                 'file_size'           => $file->getSize(),
    //             ]);
    //         }
    //     }

    //     return $request;
    // }

    protected function handleRecordCreation(array $data): Model
    {
        // Debugging: Cek data yang diterima sebelum diproses
        // dd($data);

        // Buat request baru
        $request = static::getModel()::create($data);

        // Ambil daftar file berdasarkan form_id
        $listUploads = ListUploadForm::where('form_id', $request->form_id)->get();

        foreach ($listUploads as $upload) {
            $fileKey = 'file_' . $upload->id;

            if (isset($data[$fileKey]) && !empty($data[$fileKey])) {
                $filePath = $data[$fileKey]; // Path sementara dari Filament

                // Periksa apakah file ada di storage sementara
                if (!Storage::disk('public')->exists($filePath)) {
                    dd("File tidak ditemukan: " . $filePath);
                    continue;
                }

                // Pindahkan file ke lokasi permanen
                $newPath = 'uploads/form_permohonan/' . basename($filePath);
                Storage::disk('public')->move($filePath, $newPath);

                // Simpan data file ke database
                UploadFile::create([
                    'request_id'          => $request->id,
                    'list_upload_form_id' => $upload->id,
                    'file_path'           => $newPath, // Simpan path yang benar
                    'file_name'           => basename($filePath),
                    'file_type'           => pathinfo($filePath, PATHINFO_EXTENSION),
                    'file_size'           => Storage::disk('public')->size($newPath),
                ]);
            }
        }

        return $request;
    }
}
