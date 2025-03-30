<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ["name" => 'Baptis Anak'],
            ["name" => 'Baptis Dewasa Dan Pengakuan Percaya (SIDI)'],
            ["name" => 'Pernikahan'],
            ["name" => 'Pindah Anggota Jemaat Gereja Lain ke Gereja Manahan (Attestasi Masuk)'],
            ["name" => 'Pindah Anggota Jemaat GKJ Manahan ke Gereja Lain (Attestasi Keluar)'],
        ];
        
        foreach ($datas as $data) {
            Form::firstOrCreate($data);
        }
    }
}
