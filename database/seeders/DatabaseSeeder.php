<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('ingredients')->insert([
            'name' =>'Sprinkles',
            'capacity' =>'2',
            'durability' =>'0',
            'flavor' =>'-2',
            'texture' =>'0',
            'calories' =>'3',
            'in_pantry' => '1'
        ]);
        DB::table('ingredients')->insert([
            'name' =>'Butterscotch',
            'capacity' =>'0',
            'durability' =>'5',
            'flavor' =>'-3',
            'texture' =>'0',
            'calories' =>'3',
            'in_pantry' => '1'
        ]);
        DB::table('ingredients')->insert([
            'name' =>'Chocolate',
            'capacity' =>'0',
            'durability' =>'0',
            'flavor' =>'5',
            'texture' =>'-1',
            'calories' =>'8',
            'in_pantry' => '1'
        ]);
        DB::table('ingredients')->insert([
            'name' =>'Candy',
            'capacity' =>'0',
            'durability' =>'-1',
            'flavor' =>'0',
            'texture' =>'5',
            'calories' =>'8',
            'in_pantry' => '1'
        ]);
    }
}
