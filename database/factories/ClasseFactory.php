<?php

namespace Database\Factories;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasseFactory extends Factory
{
    protected $model = Classe::class;

    public function definition()
    {
        return [
            'grup' => $this->faker->word,
            'nomTutor' => $this->faker->name,
        ];
    }
}
