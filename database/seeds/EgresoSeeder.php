<?php

use Illuminate\Database\Seeder;

class EgresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Egresos::create([
            'nombre' => 'Televisor', 
            'detalle' => 'Compre un televisor led', 
            'valor' => '14000', 
            'categorias_ings_id' => '2', 
        ]);
    }
}
