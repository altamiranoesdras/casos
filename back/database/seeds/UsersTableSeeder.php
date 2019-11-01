<?php

use App\Models\Empresa;
use App\Models\Oficina;
use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,1)->create(['username' => 'admin'])->each(function (User $user){

            $user->syncRoles([Role::DEVELOPER,Role::SUPERADMIN,Role::ADMIN]);

            $user->syncPermissions(['permiso directo 1','permiso directo 2']);

        });


        factory(User::class,1)->create(['username' => 'prueba1'])->each(function (User $user){

            $user->syncRoles([Role::OPERADOR]);

            $user->syncPermissions(['permiso directo 2']);

        });


        factory(User::class,1)->create(['username' => 'prueba2'])->each(function (User $user){

            $user->syncRoles([Role::OPERADOR]);

            $user->syncPermissions(['permiso directo 1']);

        });


        factory(User::class,8)->create()->each(function (User $user){

            $user->syncRoles([Role::OPERADOR]);

        });


        foreach (Empresa::all() as $index => $empresa) {

            $empresa->admin = User::all()->random()->id;
            $empresa->save();

        }


        foreach (Oficina::all() as $index => $ofi) {

            $ofi->responsable= User::all()->random()->id;
            $ofi->save();

        }

    }
}
