<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_tag')->insert([
            ['item_id' => 1, 'tag_id' => 1],
            ['item_id' => 1, 'tag_id' => 3],
            ['item_id' => 2, 'tag_id' => 1],
            ['item_id' => 2, 'tag_id' => 3],
            ['item_id' => 3, 'tag_id' => 3],
            ['item_id' => 3, 'tag_id' => 5],
            ['item_id' => 4, 'tag_id' => 2],
            ['item_id' => 4, 'tag_id' => 3],
            ['item_id' => 5, 'tag_id' => 1],
            ['item_id' => 5, 'tag_id' => 4],
            ['item_id' => 6, 'tag_id' => 5],
            ['item_id' => 7, 'tag_id' => 2],
            ['item_id' => 7, 'tag_id' => 3],
            ['item_id' => 8, 'tag_id' => 2],
            ['item_id' => 8, 'tag_id' => 4],
            ['item_id' => 9, 'tag_id' => 2],
            ['item_id' => 9, 'tag_id' => 5],
        ]);
    }
}
