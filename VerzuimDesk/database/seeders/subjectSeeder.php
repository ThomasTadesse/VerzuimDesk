<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            ['code' => 'REK', 'name' => 'Rekenen'],
            ['code' => 'NED', 'name' => 'Nederlands'],
            ['code' => 'IT', 'name' => 'Informatietechnologie'],
            ['code' => 'FE-BAS', 'name' => 'Frontend Basics'],
            ['code' => 'ENG', 'name' => 'Engels'],
            ['code' => 'DB', 'name' => 'Database'],
            ['code' => 'SLB', 'name' => 'Studieloopbaanbegeleiding'],
            ['code' => 'BE', 'name' => 'Backend'],
            ['code' => 'BP', 'name' => 'Backend Project'],
            ['code' => 'PRM', 'name' => 'Projectmanagement'],
            ['code' => 'HERK', 'name' => 'Herkanning'],
            ['code' => 'Excursie', 'name' => 'Excursie'],
            ['code' => 'BUR', 'name' => 'Burgerschap'],
            ['code' => 'FE-ESS', 'name' => 'Frontend Essentials'],
            ['code' => 'PRO', 'name' => 'Project'],
            ['code' => 'FE-FRON', 'name' => 'Frontend Framework'],
            ['code' => 'SYSO', 'name' => 'Systeemontwerp'],
            ['code' => 'BE-ESS', 'name' => 'Backend Essentials'],
            ['code' => 'NET-ESS', 'name' => 'Netwerk Essentials'],
            ['code' => 'FE-REAC', 'name' => 'Frontend React'],
            ['code' => 'SPR B1', 'name' => 'Sprinter B1'],
            ['code' => 'SPR B2', 'name' => 'Sprinter B2'],
            ['code' => 'SPR B3/B4', 'name' => 'Sprinter B3/B4'],
            ['code' => 'SPR B5', 'name' => 'Sprinter B5'],
            ['code' => 'RETRO', 'name' => 'Retrospective'],
            ['code' => 'BE-BASIC', 'name' => 'Backend Basics'],
            ['code' => 'NET-BASIC', 'name' => 'Netwerk Basics'],
            ['code' => 'S-OBJECT', 'name' => 'Software Objecten'],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}