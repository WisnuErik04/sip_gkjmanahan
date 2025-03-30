<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\ListUploadForm;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListUploadFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Form::where('name', 'Baptis Anak')->first()->id;


        $datas = [
            ["name" => 'Baptis Anak'],
            ["name" => 'Baptis Dewasa Dan Pengakuan Percaya (SIDI)'],
            ["name" => 'Pernikahan'],
            ["name" => 'Pindah Anggota Jemaat Gereja Lain ke Gereja Manahan (Attestasi Masuk)'],
            ["name" => 'Pindah Anggota Jemaat GKJ Manahan ke Gereja Lain (Attestasi Keluar)'],
        ];
        
        foreach ($datas as $data) {
        }
        
        $forms = Form::all();
        
        foreach ($forms as $form) {
            if ($form->name == "Baptis Anak") {
                $datas = [
                    ["name" => "Scan Formulir", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 1],
                    ["name" => "Scan Akta Kelahiran Anak", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 2],
                    ["name" => "Scan Akta Pernikahan Gerejawi", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 3],
                    ["name" => "Scan Catatan Sipil Kedua Orang Tua", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 3],
                    ["name" => "Scan Surat Pengantar dari Gereja Asal (Jika kedua orangtua bukan anggota jemaat GKJ Manahan)", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 4],
                ];
                foreach ($datas as $data) {
                    ListUploadForm::firstOrCreate($data);
                }
            } else if ($form->name == "Baptis Dewasa Dan Pengakuan Percaya (SIDI)") {
                $datas = [
                    ["name" => "Scan Formulir", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 1],
                    ["name" => "Pasfoto Berwarna Ukuran 3x4", "form_id" => "$form->id", "upload_type" => "image", "order" => 2],
                    ["name" => "Scan Surat Baptis Anak (Bagi yang sudah)", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 3],
                    ["name" => "Scan Surat Pengantar dari Gereja Asal (Jika peserta dari gereja lain)", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 4],
                ];
                foreach ($datas as $data) {
                    ListUploadForm::firstOrCreate($data);
                }
            } else if ($form->name == "Pernikahan") {
                $datas = [
                    ["name" => "Scan Formulir", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 1],
                    ["name" => "Scan Surat Pengantar/Pelimpahan (Bagi yang bukan anggota GKJ Manahan)", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 2],
                    ["name" => "Scan Surat Baptis atau Sidi", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 3],
                    ["name" => "Scan Sertifikat Pembinaan Pranikah", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 4],
                    ["name" => "Pasfoto Berwarna Ukuran 4x6 ", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 5],
                ];
                foreach ($datas as $data) {
                    ListUploadForm::firstOrCreate($data);
                }
            } else if ($form->name == "Pindah Anggota Jemaat Gereja Lain ke Gereja Manahan (Attestasi Masuk)") {
                $datas = [
                    ["name" => "Scan Formulir", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 1],
                    ["name" => "Scan Surat Pindah/Atestasi dari Gereja Asal ", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 2],
                    ["name" => "Scan Surat Baptis/Sidi ", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 3],
                    ["name" => "Scan Surat Nikah", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 4],
                    ["name" => "Scan Catatan Sipil ", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 5],
                    ["name" => "Scan Kartu Keluarga (KK)  ", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 5],
                ];
                foreach ($datas as $data) {
                    ListUploadForm::firstOrCreate($data);
                }
            } else if ($form->name == "Pindah Anggota Jemaat GKJ Manahan ke Gereja Lain (Attestasi Keluar)") {
                $datas = [
                    ["name" => "Scan Formulir", "form_id" => "$form->id", "upload_type" => "pdf", "order" => 1],
                ];
                foreach ($datas as $data) {
                    ListUploadForm::firstOrCreate($data);
                }
            }
        }
    }
}
