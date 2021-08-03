<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CollectionItem;
use App\Models\User;


class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    public function items()
    {
        return $this->hasMany(CollectionItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot() {
        parent::boot();
// whenever delete collection is called this piece of code is ran and items are deleted before the collection gets deleted
        static::deleting(function($collection) {
             $collection->items()->delete();
        });
    }

}
