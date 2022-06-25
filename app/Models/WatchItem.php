<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'watchitem_title',
        'type',
        'match_rate',
        'key_tags'
    ];
}
