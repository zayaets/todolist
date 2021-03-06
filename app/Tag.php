<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'text'
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_tag', 'tag_id', 'item_id');
    }
}
