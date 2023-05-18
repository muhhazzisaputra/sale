<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Size;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();

        Category::create([
            'code' => 'TS',
            'name' => 'Tshirt'
        ]);

        Category::create([
            'code' => 'CN',
            'name' => 'Crewneck'
        ]);

        Category::create([
            'code' => 'HD',
            'name' => 'Hoodie'
        ]);

        Category::create([
            'code' => 'JK',
            'name' => 'Jaket'
        ]);

        Category::create([
            'code' => 'LP',
            'name' => 'Long Pants'
        ]);

        Size::create([
            'name' => 'S'
        ]);

        Size::create([
            'name' => 'M'
        ]);

        Size::create([
            'name' => 'L'
        ]);

        Size::create([
            'name' => 'XL'
        ]);

        Size::create([
            'name' => 'XXL'
        ]);

        Product::factory(15)->create();
    }
}
