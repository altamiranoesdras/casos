<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Empresa;
use App\Models\Oficina;
use App\User;
use Faker\Generator as Faker;

$factory->define(Oficina::class, function (Faker $faker) {
    return [
        'empresa_id' => Empresa::all()->random()->id,
        'nombre' => $faker->sentence,
        'telefono' => $faker->phoneNumber,
        'correo' => $faker->email,
        'responsable' => null
    ];
});
