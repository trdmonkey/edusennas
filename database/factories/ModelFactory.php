<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'last_login_at' => $faker->dateTime,
        
    ];
});/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'email_verified_at' => $faker->dateTime,
        'password' => bcrypt($faker->password),
        'rol' => $faker->sentence,
        'estado' => $faker->boolean(),
        'color' => $faker->sentence,
        'remember_token' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Categorium::class, static function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->sentence,
        'slug' => $faker->unique()->slug,
        'descripcion' => $faker->text(),
        'estado' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Palabra::class, static function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->sentence,
        'slug' => $faker->unique()->slug,
        'descripcion' => $faker->text(),
        'estado' => $faker->boolean(),
        'link' => $faker->text(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'categoria_id' => $faker->sentence,
        
        
    ];
});
