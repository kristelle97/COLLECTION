<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collection;

class CollectionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'collection_id',
        'description',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
}
