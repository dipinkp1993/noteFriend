<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'user_id' => 1,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'send_date' => $this->faker->date(),
            'is_published' => $this->faker->boolean,
            'heart_count' => $this->faker->numberBetween(0, 5),
            'recipient' => $this->faker->email,
        ];
    }
}
