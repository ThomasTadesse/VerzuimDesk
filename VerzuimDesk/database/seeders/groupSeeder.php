<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        Group::create([
            'code' => 'IO-SD-2408B',
            'name' => 'Software Development 2024 August B'
        ]);
        
        Group::create([
            'code' => 'IO-SD-2408C',
            'name' => 'Software Development 2024 August C'
        ]);
        
        Group::create([
            'code' => 'IO-SD-2408A',
            'name' => 'Software Development 2024 August A'
        ]);
    }
}