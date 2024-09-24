<?php

namespace Database\Factories;

use App\Models\User; // Ensure this import is correct
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'      => $this->faker->name(), // Changed fake() to $this->faker-> to follow convention
            'email'     => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'  => bcrypt('111222333'),
            'user_type' => $this->faker->randomElement([1, 2]), // 1 for admin, 2 for user
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
?>














<?php

// namespace Database\Factories;

// use App\Models\User;
// use Illuminate\Database\Eloquent\Factories\Factory;
// use Illuminate\Support\Str;
// // User::factory()->count(20)->create()
// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
//  */
// class UserFactory extends Factory
// {
//   //  protected $model = User::class;
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             'name' => fake()->name(),
//             'email' => fake()->unique()->safeEmail(),
//             'email_verified_at' => now(),
//             'password' => bcrypt('111222333'),
//             'user_type' => fake()->randomElement([1, 2]), // 1 for admin, 2 for user
//             'remember_token' => Str::random(10),
//         ];
//     }

//     /**
//      * Indicate that the model's email address should be unverified.
//      *
//      * @return $this
//      */
//     // public function unverified(): static
//     // {
//     //     return $this->state(fn (array $attributes) => [
//     //         'email_verified_at' => null,
//     //     ]);
//     // }
// }
