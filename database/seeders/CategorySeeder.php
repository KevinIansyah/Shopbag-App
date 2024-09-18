<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Man',
        ]);

        Category::create([
            'name' => 'Woman',
        ]);

        Category::create([
            'name' => 'Kids',
        ]);

        Category::create([
            'name' => 'Top',
        ]);

        Category::create([
            'name' => 'Bottom',
        ]);

        Category::create([
            'name' => 'Accesoris',
        ]);

        Category::create([
            'name' => 'T-Shirts',
        ]);

        Category::create([
            'name' => 'Polo Shirts',
        ]);
    }
}
