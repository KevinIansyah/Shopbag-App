<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'name' => 'S',
            'type' => 'clothing_size'
        ]);

        Size::create([
            'name' => 'M',
            'type' => 'clothing_size'
        ]);

        Size::create([
            'name' => 'L',
            'type' => 'clothing_size'
        ]);

        Size::create([
            'name' => 'XL',
            'type' => 'clothing_size'
        ]);

        Size::create([
            'name' => 'XXL',
            'type' => 'clothing_size'
        ]);


        Size::create([
            'name' => '38',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '39',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '40',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '41',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '42',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '43',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => '44',
            'type' => 'shoe_size'
        ]);

        Size::create([
            'name' => 'FR',
            'type' => 'accessories_size'
        ]);
    }
}
