<?php

namespace Database\Seeders;

use App\Models\LevelVerification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class levelVerificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ["name" => 'None', "order" => '0'],
            ["name" => 'Verifikator 1', "order" => '1'],
            ["name" => 'Verifikator 2', "order" => '2'],
        ];
        
        foreach ($datas as $data) {
            LevelVerification::firstOrCreate($data);
        }
    }
}
