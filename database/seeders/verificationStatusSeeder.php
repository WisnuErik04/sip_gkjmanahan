<?php

namespace Database\Seeders;

use App\Models\VerificationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class verificationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $datas = [
            ["name" => 'Disetujui', "order" => '1'],
            ["name" => 'Ditolak', "order" => '2'],
        ];
        
        foreach ($datas as $data) {
            VerificationStatus::firstOrCreate($data);
        }
    }
}
