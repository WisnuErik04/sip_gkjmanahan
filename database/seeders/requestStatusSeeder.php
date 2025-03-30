<?php

namespace Database\Seeders;

use App\Models\RequestStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class requestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ["name" => 'Pengajuan', "order" => '1'],
            ["name" => 'Diproses', "order" => '2'],
            ["name" => 'Agenda', "order" => '3'],
            ["name" => 'Disetujui', "order" => '4'],
            ["name" => 'Ditolak', "order" => '5'],
        ];
        
        foreach ($datas as $data) {
            RequestStatus::firstOrCreate($data);
        }
    }
}
