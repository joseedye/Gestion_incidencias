<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=>'Categoria A1',
            //'descripcion'=>'',
            'project_id'=>1
        ]);
        Category::create([
            'name'=>'Categoria A2',
            //'descripcion'=>'',
            'project_id'=>1
        ]);
        Category::create([
            'name'=>'Categoria B1',
            //'descripcion'=>'',
            'project_id'=>2
        ]);
        Category::create([
            'name'=>'Categoria B2',
            //'descripcion'=>'',
            'project_id'=>2
        ]);
    }
}
