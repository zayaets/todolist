<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'item_tag', 'item_id', 'tag_id');
    }
}
