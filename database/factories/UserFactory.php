<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categories;
use App\Products;
use App\Rol;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'sex' => 'M',
        'phone' => $faker->phoneNumber,
        'status' => 'A',
        'rol_id' => factory(Rol::class)
    ];
});

$factory->define(Rol::class, function (Faker $faker){
    return [
        'name' => $faker->name
    ];
});

$factory->define(Products::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(1),
        'ingredients' => $faker->paragraph(1),
        'price' => $faker->numberBetween(100, 1000),
        'status' => 'A',
        'category_id' => factory(Categories::class)
    ];
});

$factory->define(Categories::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => 'A'
    ];
});
