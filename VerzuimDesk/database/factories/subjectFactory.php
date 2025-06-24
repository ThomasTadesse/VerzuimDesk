<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $subjects = [
        'REK', 'NED', 'IT', 'FE-BAS', 'ENG', 'DB', 'SLB', 'BE', 'BP', 'PRM', 
        'HERK', 'Excursie', 'BUR', 'FE-ESS', 'PRO', 'FE-FRON', 'SYSO', 'BE-ESS', 
        'NET-ESS', 'FE-REAC', 'SPR B1', 'SPR B2', 'SPR B3/B4', 'SPR B5', 'RETRO',
        'BE-BASIC', 'NET-BASIC', 'S-OBJECT'
    ];

    public function definition()
    {
        $code = $this->faker->unique()->randomElement($this->subjects);
        
        return [
            'code' => $code,
            'name' => $this->expandSubjectCode($code),
        ];
    }

    protected function expandSubjectCode($code)
    {
        $map = [
            'REK' => 'Rekenen',
            'NED' => 'Nederlands',
            'IT' => 'Informatietechnologie',
            'FE-BAS' => 'Frontend Basics',
            'ENG' => 'Engels',
            'DB' => 'Database',
            'SLB' => 'Studieloopbaanbegeleiding',
            'BE' => 'Backend',
            'BP' => 'Backend Project',
            'PRM' => 'Projectmanagement',
            'HERK' => 'Herkanning',
            'BUR' => 'Burgerschap',
            'FE-ESS' => 'Frontend Essentials',
            'PRO' => 'Project',
            'FE-FRON' => 'Frontend Framework',
            'SYSO' => 'Systeemontwerp',
            'BE-ESS' => 'Backend Essentials',
            'NET-ESS' => 'Netwerk Essentials',
            'FE-REAC' => 'Frontend React',
            'SPR B1' => 'Sprinter B1',
            'SPR B2' => 'Sprinter B2',
            'SPR B3/B4' => 'Sprinter B3/B4',
            'SPR B5' => 'Sprinter B5',
            'RETRO' => 'Retrospective',
            'BE-BASIC' => 'Backend Basics',
            'NET-BASIC' => 'Netwerk Basics',
            'S-OBJECT' => 'Software Objecten'
        ];
        
        return $map[$code] ?? $code;
    }
}