<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
        	'name' => 'Geovany',
        	'email' => 'geovanymantilla@gmail.com',
        	'password' => bcrypt('123123'),
        	'role' => 0
        ]);

        // Client
        User::create([
        	'name' => 'Claudia',
        	'email' => 'client@gmail.com',
        	'password' => bcrypt('123123'),
        	'role' => 2
        ]);
        
    }
}
