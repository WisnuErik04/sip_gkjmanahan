<?php

namespace Database\Seeders;

use App\Models\AgendaJenis;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgendaJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            ["name" => 'Surat Informatif'],
            ["name" => 'Surat Dibahas'],
        ];
        
        foreach ($datas as $data) {
            AgendaJenis::firstOrCreate($data);
        }
    }
}
