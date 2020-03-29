<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'home',
            'work',
            'urgent',
            'not_urgent',
            'children'
        ];
        foreach ($tags as $tag) {
            Tag::create([
                'text' => $tag,
            ]);
        }
    }
}
