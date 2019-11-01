<?php

use App\Models\CasoEstado;
use Illuminate\Database\Seeder;

class CasoEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CasoEstado::class,1)->create(['nombre' => 'INICIADO']);
        factory(CasoEstado::class,1)->create(['nombre' => 'EVALUANDO']);
        factory(CasoEstado::class,1)->create(['nombre' => 'APROBADO']);
        factory(CasoEstado::class,1)->create(['nombre' => 'RECHAZADO']);
    }
}
