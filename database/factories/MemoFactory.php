<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Memo>
 */
class MemoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'   => $this->faker->realText('20'),
            'status'  => 'incomplete',
            'detail'  => $this->faker->realText('100'),
            'limit'   => $this->faker->date('Y-m-d'),
            'user_id' => mt_rand(1, 5),
        ];
    }
}
