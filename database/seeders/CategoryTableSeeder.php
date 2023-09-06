<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Laratrust\Models\LaratrustRole;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrCreate(
            [
            'name' => 'Category 1',
            'status' => 'Active',
            ]
        );
        $subCategory = Category::firstOrCreate(
            [
            'name' => 'Category 1.1',
            'parent_id' =>$category->id,
            'status' => 'Active',
            ]
        );
        Category::firstOrCreate(
            [
            'name' => 'Category 1.1.1',
            'parent_id' =>$subCategory->id,
            'status' => 'Active',
            ]
        );
        
       
    }
}
