<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Empresa;
use App\User;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence,
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'correo' => $faker->email,
        'admin' => null
    ];
});
