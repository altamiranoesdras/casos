<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Caso;
use App\Models\CasoEstado;
use Faker\Generator as Faker;

$factory->define(Caso::class, function (Faker $faker) {
    return [
        'caso_estado_id' => CasoEstado::all()->random()->id,
        'titulo' => $faker->sentence,
        'cuerpo' => $faker->text
    ];
});
