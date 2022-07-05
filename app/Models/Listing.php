<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_name',
        'price',
        'negotiableFree',
        'condition',
        'category',
        'tags',
        'description',
        'image_uploads',
        'street',
        'city',
        'state',
        'country',
        'postcode'
    ];
    public function scopeFilter($query, array $filters){
        // dd($filters); -> have the keys

        //$query is all the listings -> in latest order
        
        //search: go through all the search words in the search request
        //tag: filter will always be one
        //condition: multiple conditions possible
        //category: mulitple categorys possible
        //negotiableFree: multiple possible
        //distance: multiple possible
        // dd($filters);
        // dd($query);
        // echo $query;
        foreach($filters as $key => $value){
            if($key == 'type'){
                continue;
            }else{
                // if category is present, it takes precedence over condition
                if($key == 'category'){
                    // can select multiple categories
                    $categories = explode(",", $value);
                    foreach($categories as $category){
                        $query->orWhere('category', 'like', '%' . $category . '%');
                    }
                }
                if($key == 'condition'){
                    // can select multiple categories
                    $conditions = explode(",", $value);
                    foreach($conditions as $condition){
                        $query->orWhere('condition', 'like', '%' . $condition . '%');
                    }
                }
            }
        }
        // dd($filters);
        
        // if($filters['tag'] ?? false){
        //     $query->where('tags', 'like', '%'. request()->tag . '%');
        // }

        // if($filters['search'] ?? false){
        //     // dd(request()->search);

        //     $searchWords = explode(' ', request()->search);
        //     // dd($searchWords);
        //     foreach($searchWords as $word){
        //         $query->where('tags', 'like', '%'. $word . '%')
        //         ->orWhere('item_name', 'like', '%'. $word . '%')
        //         ->orWhere('description', 'like', '%'. $word . '%')
        //         ->orWhere('category', 'like', '%'. $word .'%')
        //         ->orWhere('tags', 'like', '%'. $word . '%');
        //     }
        // }
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
