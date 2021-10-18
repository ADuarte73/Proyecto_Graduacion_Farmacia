<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $usuarios = [[
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@farmaciasanjose.com.gt',
            'password' => 'admin123.'
        ],
        ];

        foreach ($usuarios as $usuario) {
            $newUsuario = new \App\Models\UserModel();
            foreach ($usuario as $key => $value) {
                $newUsuario->{$key} = $value;
            }
            
            $newUsuario->save();
        }
    }
}
