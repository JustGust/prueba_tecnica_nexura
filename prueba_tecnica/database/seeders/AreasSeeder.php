<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
               
                'nombre' => 'Ventas'
            ],
            [
                'nombre' => 'Calidad',
             
            ],
            [
                'nombre' => 'Producción',
              
            ],
            [
                'nombre' => 'Administración',
            ]
        ]);

    }
}
