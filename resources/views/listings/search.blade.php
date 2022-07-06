<?php
    use App\Libraries\HashMap;
    $map = new HashMap("String", "Array");
    $base = "http://college_marketplace.test/shop/all";

    function deconstructUrl($input, $map){
        $data = $input;
        foreach ( $data as $key => $value) {
            $value = explode(",", $value);
            $map -> put($key, $value);
        }
    }

    deconstructUrl(Request::except('_token'), $map);

    function urlBuilder($futureMap, $base){
        $base = $base . "?";
        $futureMap->forEach(
            function($key, $value) use(&$base, &$futureMap) {
                if($key=="page"){
                    $futureMap->remove($key);
                }else{
                    $base = $base . $key . "=" . implode(",",$value) . "&";
                }
            }
        );

        // Remove last character since key value pairs will end in &.
        // With no key value pairs the last character is a ? so that would need to be removed anyways.
        return substr($base, 0, -1);
    }

    function toggleParam($key, $value, $map){
        $nextMap = clone $map;

        //if we are toggling the type, type always needs to have a default of all, unless specified
        //the type=all is replaced by the specified type
        if($nextMap->contains($key)) {
            $storedAtKey = $nextMap->get($key);
            if($key == "type"){
                $nextMap->remove($key);
                $nextMap->put($key, array($value));
                return $nextMap;
            }
            if(in_array($value, $storedAtKey)) {
                // basically deleting key-> value pair if present
                if (($index = array_search($value, $storedAtKey)) !== NULL) {
                    unset($storedAtKey[$index]);
                    $nextMap->put($key, $storedAtKey);
                }
                if(count($storedAtKey) == 0) {
                    $nextMap->remove($key);
                }
            } else {
                // if adding a new value to a key value pair
                array_push($storedAtKey, $value);
                $nextMap->put($key, $storedAtKey);
            }
        } else {
            $nextMap->put($key, array($value));
        }
        return $nextMap;
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
            <label for="show-filter">
                {{-- <i class="fas fa-bars sidebar-toggle"></i> --}}
                <i class="fa-solid fa-filter sidebar-toggle"></i>
            </label> 
            
            <ul class="filter-list">
                {{-- type dropdown --}}
                <li>
                    <input type="checkbox" id="type">
                    <label for="type" style="position: relative;">Type <span class="down-arrow"></span> </label>
                    <ul> 
                        <li><a id= "all" href="{{urlBuilder(toggleParam('type', 'all', $map), $base)}}">Show All Items</a></li>
                        <li><a id = "listing" href="{{urlBuilder(toggleParam('type', 'listing', $map), $base)}}">Listing</a></li>
                        <li><a id="rentable" href="{{urlBuilder(toggleParam('type', 'rentable', $map), $base)}}">Rentable</a></li>
                        <li><a id="lease" href="{{urlBuilder(toggleParam('type', 'lease', $map), $base)}}">Leaseable</a></li>
                    </ul>
                </li>
                {{-- <li><a href="/shop/listings">View All</a></li> --}}
                {{-- Category Dropdown --}}
                <li>
                    <input type="checkbox" id="cat">
                    <label for="cat" style="position: relative;">Categories <span class="down-arrow"></span> </label>
                    <ul> 
                        <li><a href="{{urlBuilder(toggleParam('category', 'furniture', $map), $base)}}">Furniture</a></li>
                        <li><a href="{{urlBuilder(toggleParam('category', 'clothes', $map), $base)}}">Clothes</a></li>
                        <li><a href="{{urlBuilder(toggleParam('category', 'electronics', $map), $base)}}">Electronics</a></li>
                        <li><a href="{{urlBuilder(toggleParam('category', 'kitchen', $map), $base)}}">Kitchen</a></li>
                        <li><a href="{{urlBuilder(toggleParam('category', 'school accessories', $map), $base)}}">School Accessories</a></li>
                    </ul>
                </li>

                {{-- condition dropdown --}}
                <li>
                    <input type="checkbox" id="cond">
                    <label for="cond" style="position: relative;">Condition <span class="down-arrow"></span> </label>
                    <ul> 
                        <li><a href="{{urlBuilder(toggleParam('condition', 'new', $map), $base)}}">New</a></li>
                        <li><a href="{{urlBuilder(toggleParam('condition', 'good', $map), $base)}}">Good</a></li>
                        <li><a href="{{urlBuilder(toggleParam('condition', 'slightly used', $map), $base)}}">Slightly Used</a></li>
                        <li><a href="{{urlBuilder(toggleParam('condition', 'used normal wear', $map), $base)}}">Used Normal Wear</a></li>
                    </ul>
                </li>
                
                {{-- Price Dropdown --}}
                <li>
                    <input type="checkbox" id="cost">
                    <label for="cost" style="position: relative;">Price <span class="down-arrow"></span> </label>

                    <ul>
                    <li><a href="{{urlBuilder(toggleParam('negotiable', 'negotiable', $map), $base)}}">Negotiable</a></li>
                    <li><a href="{{urlBuilder(toggleParam('negotiable', 'fixed', $map), $base)}}">Fixed</a></li>
                    <li><a href="{{urlBuilder(toggleParam('negotiable', 'free', $map), $base)}}">Free</a></li>
                    </ul>
                </li>

                {{-- Distance Dropdown --}}
                <li>
                    <input type="checkbox" id="dist">
                    <label for="dist" style="position: relative;">Distance <span class="down-arrow"></span> </label>

                    <ul>
                    <li><a href="{{urlBuilder(toggleParam('distance', '0 - 0.5 Mi', $map), $base)}}">0 - 0.5 Mi</a></li>
                    <li><a href="{{urlBuilder(toggleParam('distance', '0.5 - 1 Mi', $map), $base)}}">0.5 - 1 Mi</a></li>
                    <li><a href="{{urlBuilder(toggleParam('distance', '1 - 1.5 Mi', $map), $base)}}">1 - 1.5 Mi</a></li>
                    <li><a href="{{urlBuilder(toggleParam('distance', '1.5 - 2 Mi', $map), $base)}}">1.5 - 2 Mi</a></li>
                    <li><a href="{{urlBuilder(toggleParam('distance', '> 2 Mi', $map), $base)}}"> > 2 Mi</a></li>
                    </ul>
                </li>

                 {{-- Utilities Dropdown --}}
                <li>
                    <input type="checkbox" id="util">
                    <label for="util" style="position: relative;">Utilities <span class="down-arrow"></span> </label>

                    <ul>
                    <li><a href="{{urlBuilder(toggleParam('utilities', 'electric', $map), $base)}}">Electric</a></li>
                    <li><a href="{{urlBuilder(toggleParam('utilities', 'gas', $map), $base)}}">Gas</a></li>
                    <li><a href="{{urlBuilder(toggleParam('utilities', 'water', $map), $base)}}">Water</a></li>
                    <li><a href="{{urlBuilder(toggleParam('utilities', 'trash', $map), $base)}}">Trash</a></li>
                    <li><a href="{{urlBuilder(toggleParam('utilities', 'internet', $map), $base)}}">Internet</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        {{-- <div style = "padding-left: 50px">
            @php
                $nextMap->forEach(function($key, $value) {

                    echo "<h5 style= 'color:black;'>" . $key . " = " . implode(" ",$value). "</h5>";
                    // echo "hello";
                });
            @endphp
        </div>
         --}}

        {{-- need to create an event listener for the above filters where the results is a list of listings that are paginated and then passed into the card gallery --}}
        <div class = "listings-parent-container" style="min-height: 100vh;">
            @include('partials._cardGallary',['listings'=>$listings, 'heading' => 'Results Showing: '. count($listings), 'displayTags' => true])
        </div>
    </div>
    <script>
        function add(val){
            $( "#"+val ).toggleClass( 'className', ".picked" );
        }
    </script>
</x-layout> 