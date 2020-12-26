<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Theme::factory(5)->create();
    }
}
