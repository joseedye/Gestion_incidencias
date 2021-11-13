<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name'=>'Proyecto A',
            'descripcion'=>'El proyecto consiste en crear un sitio moderno'
        ]);

        Project::create([
            'name'=>'Proyecto B',
            'descripcion'=>'El proyecto consiste en crear una app moderna'
        ]);
    }
}
