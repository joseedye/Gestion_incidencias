<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SupportsTableSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Support
        User::create([
        	'name' => 'Soporte S1',
        	'email' => 'soporte@gmail.com',
        	'password' => bcrypt('123123'),
        	'role' => 1
        ]);
        //Support
        User::create([
        	'name' => 'Soporte S2',
        	'email' => 'soporte02@gmail.com',
        	'password' => bcrypt('123123'),
        	'role' => 1
        ]);
    }
}
