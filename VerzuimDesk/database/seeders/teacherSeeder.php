<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $teachers = [
            ['name' => 'Grift,C.W.', 'code' => 'GRI.C.'],
            ['name' => 'Tielen,L.', 'code' => 'TIE.L.'],
            ['name' => 'Neumann,M.H.', 'code' => 'NEU.M.'],
            ['name' => 'Zegveld,D.', 'code' => 'ZEG.D.'],
            ['name' => 'Visser,S.N.A.', 'code' => 'VIS.S.'],
            ['name' => 'Schooten,H', 'code' => 'SCH.H.'],
            ['name' => 'Ruijter,A.', 'code' => 'RUI.A.'],
            ['name' => 'Wakeren,D.A.', 'code' => 'WAK.D.'],
            ['name' => 'Jamil,M', 'code' => 'JAM.M.'],
            ['name' => 'Ommel,', 'code' => 'OMM.'],
            ['name' => 'Jonge,M', 'code' => 'JON.M.'],
            ['name' => 'Rahim,T.', 'code' => 'RAH.T.'],
            ['name' => 'Broek,Y.', 'code' => 'BRO.Y.'],
            ['name' => 'Jagroep,S', 'code' => 'JAG.S.'],
            ['name' => 'Esen,M', 'code' => 'ESE.M.'],
            ['name' => 'Garst,', 'code' => 'GAR.'],
            ['name' => 'Minnaard Evertsen,M', 'code' => 'MIN.M.'],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}