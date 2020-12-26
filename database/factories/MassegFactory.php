<?php

namespace Database\Factories;

use App\Models\Masseg;
use Illuminate\Database\Eloquent\Factories\Factory;

class MassegFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Masseg::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text($maxNbChars = 15),
            'text' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
