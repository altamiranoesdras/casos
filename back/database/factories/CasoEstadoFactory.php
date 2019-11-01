<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\CasoEstado;
use Faker\Generator as Faker;

$factory->define(CasoEstado::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word
    ];
});
