<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MassegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Masseg::factory(10)->create();
    }
}
