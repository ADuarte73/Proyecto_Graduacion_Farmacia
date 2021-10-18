<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $configs = [[
            'id' => 1,
            'logo' => 'logo2.png',
            'email' => '',
            'telefono' => '',
            'facebook' => '',
            'twitter' => '',
            'instagram' => ''
            ],
        ];

        foreach ($configs as $Config) {
            $newConfig = new \App\Models\ConfiguracionModel();
            foreach ($Config as $key => $value) {
                $newConfig->{$key} = $value;
            }
            
            $newConfig->save();
        }
    }
}
