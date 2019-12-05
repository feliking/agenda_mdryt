<?php

use Illuminate\Database\Seeder;
use App\Ciudad;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nombre' => 'La Paz'
            ],
            [
                'nombre' => 'El Alto'
            ],
            [
                'nombre' => 'Santa Cruz'
            ],
            [
                'nombre' => 'Cochabamba'
            ],
            [
                'nombre' => 'Pando'
            ],
            [
                'nombre' => 'Oruro'
            ],
            [
                'nombre' => 'Potosí'
            ],
            [
                'nombre' => 'Sucre'
            ],
            [
                'nombre' => 'Tarija'
            ],
            [
                'nombre' => 'Beni'
            ],
        ];
        foreach($data as $data){
            Ciudad::create($data);
        }
    }
}
