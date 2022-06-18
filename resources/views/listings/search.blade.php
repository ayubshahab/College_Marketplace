<?php
    // Assumes base ends with '/'
    // function urlFactory($base, $kvs) {
    //     $url = $base;
    //     foreach (array_values($kvs) as $kv) {
    //         $value = $kvs[$kv[0]];
    //         $key = $kv[1];
    //         if (types($value) == array) {
    //             // TODO: Exercise to the writer
    //         }
    //         else {
    //             $url += $key . "=" . $value . "&";
    //         }
    //     }
    //     $url = substr($url, 0, -1);

    //     return $url
    // }

    // function toggleParam($kvs, $key, $value, $isSelected) {

    //     // if the value is within the key value pairs key
    //     if (!$isSelected) {
    //         if (array_key_exists($key, $kvs) {
    //             if (type($kvs[$keys]) == array) {
    //                 array_push($kv[$key], $value);
    //             }
    //             else {
    //                 $prev = $kv[$key];
    //                 $unset($kv[$key])
    //                 $kvs[$key] = array($prev, $value);
    //             }
    //         }
    //         else {
    //             $kvs[$key] = $value
    //         }
    //     }
    //     else {
    //         unset($kv[$key])
    //     }

    //     return $kvs;
    // }

    use App\Libraries\HashMap;
    $map = new HashMap("String", "String");
    $base = "http://college_marketplace.test/shop/listings";

    function deconstructUrl($input, $map){
        $data = $input;
        foreach ( $data as $key => $value) {
           $map -> put($key, $value);
        }
    }

    deconstructUrl(Request::except('_token'), $map);

    function toggleParam($key, $value, $map){
        deconstructUrl(Request::except('_token'), $map);
        if($map->containsValue($value)){ 
            // already contains value, need to toggle it now
            return "already contains";
        }
        $map->put($key, $value);
        // deconstructUrl(Request::except('_token'), $map);
    }

    // whats in your map is currenlty whats in your url query,
    // currently the state of the page
    // its okay if a key value pair is not present
    


    // button is selected -> a -> is clicked
    //what ever the state is to check if it is enabled
    // toggleParam($kvs, "gender", "male", $pageEl.selected)
    // $url = urlFactory($base, $kvs)
    // href={{urlFactory($base, toggleParam($kvs, $pageEl.name))}}
?>

<link rel="stylesheet" types ="text/css" href="/css/search.css" />
<x-layout>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
   
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

    <div style="position: relative; overflow:hidden;">
        <input type="checkbox" id="show-filter" class="show-filter">
        
        <div class = "side-filter-container">
            <label for="show-filter"><i class="fas fa-bars sidebar-toggle"></i></label> 
            
            <ul class="filter-list">
                <li><a href="">View All</a></li>
                {{-- Category Dropdown --}}
                <li>
                    <input type="checkbox" id="cat">
                    <label for="cat" style="position: relative;">Categories <span class="down-arrow"></span> </label>
                    <ul>
                        <li><a href="{{toggleParam('category', 'furniture', $map)}}">Furniture</a></li>
                        <li><a href="{{toggleParam('category', 'clothes', $map)}}">Clothes</a></li>
                        <li><a href="{{toggleParam('category', 'electronics', $map)}}">Electronics</a></li>
                        <li><a href="{{toggleParam('category', 'kitchen', $map)}}">Kitchen</a></li>
                        <li><a href="{{toggleParam('category', 'school accessories', $map)}}">School Accessories</a></li>
                    </ul>
                </li>
                
                {{-- Price Dropdown --}}
                <li>
                    <input type="checkbox" id="cost">
                    <label for="cost" style="position: relative;">Price <span class="down-arrow"></span> </label>

                    <ul>
                    <li><a href="#">Negotiable</a></li>
                    <li><a href="">Fixed</a></li>
                    <li><a href="#">Free</a></li>
                    </ul>
                </li>

                {{-- Distance Dropdown --}}
                <li>
                    <input type="checkbox" id="dist">
                    <label for="dist" style="position: relative;">Distance <span class="down-arrow"></span> </label>

                    <ul>
                    <li><a href="#">0 - 0.5 Mi</a></li>
                    <li><a href="">0.5 - 1 Mi</a></li>
                    <li><a href="#">1 - 1.5 Mi</a></li>
                    <li><a href="#">1.5 - 2 Mi</a></li>
                    <li><a href="#"> > 2 Mi</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div style = "padding-left: 50px">
            @php
                $map->forEach(function($key, $value) {
                    echo "<h5 style= 'color:black;'>" . $key . " = " . $value. "</h5>";
                    // echo "hello";
                });
            @endphp
        </div>
        

        {{-- need to create an event listener for the above filters where the results is a list of listings that are paginated and then passed into the card gallery--}}
        <div class = "listings-parent-container" style="min-height: 100vh;">
            @include('partials._cardGallary',['listings'=>$listings, 'heading' => 'Results for: '.$searchWord . $tagWord])
        </div>
    </div>
</x-layout> 