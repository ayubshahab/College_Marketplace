{{-- @extends('layout') --}}

{{-- @section('content') --}}

{{-- css for individual user listing --}}
<link rel="stylesheet" type="text/css" href="/css/listing.css">

<x-layout>
    <section class = "product-details-container">
        <div class = "card-wrapper-selected">
            <div class = "card-selected">
                <div class="back-button">
                    <a href="/" class="button1 b-button">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div> 
                <div class = "track">
                    <h5>Home > Clothes > Pants > Ripped Jeans</h5>
                    @if($rentable->status =='Available')
                        <div class="stat-container">
                            <div class="stat green">
                            </div>
                            <h4>{{$rentable->status}}</h4>
                        </div>
                    @else
                        <div class="stat-container">
                            <div class="stat">
                            </div>
                            <h4>{{$rentable->status}}</h4>
                        </div>
                    @endif 
                </div>
                <div class="selected-row">
                    <!-- card left -->
                    <div class = "product-imgs">
                        <div class = "img-display">
                            @php
                                if(isset($rentable->image_uploads)){
                                    //decode the json object
                                    $imgLinks = json_decode($rentable->image_uploads);
                                    $titleImage = null;
                                    if(is_array($imgLinks)){
                                        $titleImage = $imgLinks[0];
                                    }
                                }
                            @endphp
                            <img src={{$rentable->image_uploads ? asset('storage/'.$titleImage) : asset('/images/rotunda.jpg')}} id = "expandedImg" alt="image doesnt exist">
                        </div>
                        <div class = "img-showcase">
                            @if(is_array(json_decode($rentable->image_uploads)))
                                @foreach(json_decode($rentable->image_uploads) as $link)
                                    <img src={{$rentable->image_uploads ? asset('storage/'.$link) : asset('/images/rotunda.jpg')}} alt = "shoe image" onclick="myFunction(this);">
                                @endforeach
                            @endif 
                        </div>
                    </div>
                    <!-- card right -->
                    <div class = "product-content">

                        {{-- product title --}}
                        <div class = "product-header show-top">
                            <div class="name-status">
                                <h1>{{$rentable->rental_title}}</h1> 
                            </div>
                            <h3> 
                                <span>${{$rentable->rental_charging}} / {{$rentable->rental_duration}}</span> | {{$rentable->city}}, {{$rentable->state}}
                            </h3>    
                        </div>

                        {{-- price and other info --}}
                        <div class = "product-details show-top">
                            <h4>Condition: 
                                <span>{{$rentable->condition}}</span>
                            </h4>
                        </div>
                        
                        <div class = "product-categories show-top">
                            @php
                                $categories = explode(", ", $rentable->category);
                            @endphp
                            <div class="categories">
                                <h4 class="spacer">Categories:</h4>
                                @foreach($categories as $category)
                                    <a href="/category?category={{$category}}">{{$category}}</a>
                                @endforeach
                            </div> 
                        </div>  

                        <div class = "product-description show-top">
                            <h4>Rental Description:</h4>
                            <p>{{$rentable->description}}</p>
                        </div>

                        <div class = "tags-container show-top">
                            @php
                                $tags = explode(", ", $rentable->tags);
                            @endphp
                            <x-listing-tags :tags="$tags"/>
                        </div>

                        <div class="product-buttons">
                            {{-- <ul>
                                <li>
                                    @if($currentUser != null and $currentUser->favorites != null and in_array($listing->id, explode(", " , $currentUser->favorites)))
                                        <a href="/users/removefavorite/{{$listing->id}}"><i class="fa-solid fa-heart saved"></i></a>
                                    @else
                                        <a href="/users/addfavorite/{{$listing->id}}"><i class="fa-solid fa-heart bouncy"></i></a>
                                    @endif                                
                                </li>
                                @if($currentUser != null and $listing->user_id == $currentUser->id)
                                    <li>
                                        <form method="POST" action="/listings/{{$listing->id}}/update">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" id="status" style = " font-size: 17px; text-align:center;" onchange="this.form.submit()">
                                                <option style = "text-align:center;">Status</option>
                                                <option style = "text-align:center;" value="Available">Available</option>
                                                <option style = "text-align:center;" value="Pending">Pending</option>
                                                <option style = "text-align:center;" value="Sold">Sold</option>  
                                            </select>
                                        </form>
                                    </li>
                                    <li><a href="/listings/{{$listing->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li>
                                        <form method="POST" action="/listings/{{$listing->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button><i class="fa fa-trash" ></i></button>
                                        </form>
                                    </li>
                                @endif
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>

            {{-- user chat and map area --}}
            <div class="map-chat-container">
                <div class="map-container">
                    <h1>Maps feature</h1>
                </div>
                <div class="chat-container">
                     
                </div>
            </div> 
        </div>
    </section>

    {{-- carousel section --}}
    <section class = "listings-parent-container">
        {{-- <h1>helo</h1> --}}
        {{-- @include('partials._listingCarousel', ['listings' => $listings]) --}}
         @include('partials._rentablesCarousel', ['rentables' => $rentables, 'message' => 'Related Rentable Items', 'carouselClass'=>'','carouselControls' => 'controls', 'carouselP' =>'previous previous1', 'carouselN' => 'next next1'])
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    

    {{-- for pusher real time messages --}}
     <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
     <script>
        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
        }
     </script>

</x-layout>
{{-- @endsection --}}