<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Pago;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $usuario = new Usuario;
        $usuario->nick_usu = 'heraclesGYM';
        $usuario->password_usu = 'heracles001';
        $usuario->save();
        // 
        // Cliente::factory(50)->create();
        // Pago::factory(25)->create();
    }
}
