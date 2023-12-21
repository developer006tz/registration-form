<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\UserLanguage;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserLanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserLanguage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'language_id' => \App\Models\Language::factory(),
        ];
    }
}
