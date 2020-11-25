<?php

use Illuminate\Database\Seeder;

class IngresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Ingresos::create([
            'nombre' => 'Changa', 
            'detalle' => 'Le corte el pasto al vecino', 
            'valor' => '1200', 
            'categorias_ings_id' => '1', 
        ]);
    }
}
