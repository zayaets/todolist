<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $items = ['buy coffee', 'walk the dog', 'bake cake', 'write essay', 'clean the house',
            'cook dinner'];
        foreach ($items as $item) {
            Item::create([
                'text' => $item,
            ]);
        }
    }
}
