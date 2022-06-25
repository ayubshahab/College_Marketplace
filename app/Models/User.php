<?php

namespace App\Models;

use App\Models\Listing;
use App\Models\Sublease;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'email',
        'avatar',
        'watchlist',
        'favorites',
        'number',
        'street',
        'city',
        'state',
        'country',
        'postcode'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function listings(){
       return $this->hasMany(Listing::class, 'user_id');
    }

    public function rentables(){
       return $this->hasMany(Rentable::class, 'user_id');
    }

    public function subleases(){
       return $this->hasMany(Sublease::class, 'user_id');
    }

    public function allPosts(){
        $allListings = $this->hasMany(Listing::class, 'user_id')->get();
        $allRentals = $this->hasMany(Rentable::class, 'user_id')->get();
        $allLeases = $this->hasMany(Sublease::class, 'user_id')->get();
        // dd($allListings->get());
        return collect($allListings)->merge($allRentals)->merge($allLeases);
    }
    public function allLiked(){
        $allListings = null;
        if($this->favorites != null){
            $temp = explode(", ",$this->favorites);
            foreach($temp as $tp){
                if($allListings!=null){
                    $allListings = $allListings->merge(Listing::latest()->where('id', 'like', $tp)->get());
                } else {
                    $allListings = Listing::latest()->where('id', 'like', $tp)->get();   
                }
            }
        }
        
        $allRentables = null;
        if($this->rentableFavorites != null){
            $temp = explode(", ", $this->rentableFavorites);
            foreach($temp as $tp){
                // dd($tp);
                // dd(Rentable::latest()->where('id', 'like', $tp)->get());
                if($allRentables!=null){
                    $allRentables = $allRentables->merge(Rentable::latest()->where('id', 'like', $tp)->get());
                } else {
                    $allRentables = Rentable::latest()->where('id', 'like', $tp)->get();   
                }
            }
        }

        $allLeases = null;
        if($this ->leaseFavorites != null){
            $temp = explode(", ", $this->leaseFavorites);
            foreach($temp as $tp){
                if($allLeases != null){
                    $allLeases = $allLeases->merge(Sublease::latest()->where('id','like',$tp)->get());
                }else{
                    $allLeases = Sublease::latest()->where('id','like',$tp)->get();
                }
            }
        }
        return collect($allListings)->merge($allRentables)->merge($allLeases);
    }

}
