<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentable extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rental_title',
        'rental_duration', //hourly, daily, weekly, monthly
        'rental_charging', //amount charging per time period
        'condition',
        'category',
        'tags',
        'description',
        'image_uploads',
        'street',
        'city',
        'state',
        'country',
        'postcode',
        'status' //either rented or available
    ];

    // this rentable belongs to a certain user
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
