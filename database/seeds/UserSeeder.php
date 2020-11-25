<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //
 
        App\User::create([
            'name' => 'Santiago',
            'email' => 'santiago@gmail.com',
            'password' => bcrypt('1234'), 
        ]);
    }
}
