<?php

use App\Models\Caso;
use Illuminate\Database\Seeder;

class CasoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Caso::class,10)->create();
    }
}
