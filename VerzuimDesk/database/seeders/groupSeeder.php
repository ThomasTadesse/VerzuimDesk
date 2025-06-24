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
    }
}