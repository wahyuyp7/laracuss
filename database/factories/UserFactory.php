<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $username = strtolower(fake()->unique()->userName());

        return [
            'username' => $username,
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'picture' => fake()->optional(0.6)->imageUrl(300, 300, 'people', true, $username),
        ];
    }

    /**
     * State untuk user tanpa foto profil.
     */
    public function withoutPicture(): static
    {
        return $this->state(fn (array $attributes) => [
            'picture' => null,
        ]);
    }
}
