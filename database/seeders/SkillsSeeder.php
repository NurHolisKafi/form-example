<?php

namespace Database\Seeders;

use App\Models\Skills;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['Programming', 'Graphic Design', 'Project Management', 'Public Speaking', 'Data Analysis'];

        foreach ($skills as $key) {
            Skills::create([
                'name' => $key
            ]);
        }
    }
}
