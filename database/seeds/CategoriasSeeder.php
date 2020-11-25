<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\CategoriasIng::create([
            'nombre' => 'En negro', 
            'detalle' => 'Ingresos pagos en negro', 
            'subcategorias_id' => '1',  
        ]);

        App\CategoriasIng::create([
            'nombre' => 'Tecnologia', 
            'detalle' => 'Gastos en tecnologia', 
            'subcategorias_id' => '2',  
        ]);
    }
}
