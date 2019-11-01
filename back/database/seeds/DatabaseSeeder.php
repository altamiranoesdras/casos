<?php

use App\Models\Caso;
use App\Models\CasoEstado;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RolsTableSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(OficinaSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CasoEstadoSeeder::class);
        $this->call(CasoSeeder::class);
    }
}
