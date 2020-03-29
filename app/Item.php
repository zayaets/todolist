<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Item extends Model
{
    use SoftDeletes;
    use Sortable;

    public $sortable = [
        'id', 'text', 'status', 'user_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    protected $table = 'items';

    protected $fillable = [
        'text', 'status'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
//        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'item_tag', 'item_id', 'tag_id');
    }

    public function scopeDone($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUndone($query)
    {
        return $query->where('status', 0);
    }
}
