{{-- @extends('layout') --}}

{{-- @section('content') --}}

{{-- css for individual user listing --}}
<link rel="stylesheet" type="text/css" href="/css/listing.css">
<x-layout>
    <section class = "product-details-container">
        <div class = "card-wrapper-selected">
            <div class = "card-selected">
                <div class="back-button">
                    <a href="/" class="button1">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div> 
                <div class = "track">
                    <h5>Home > YardSales > {{$yardsale->id}}</h5>
                </div>
                <!-- card left -->
                <div class="selected-row">
                    <div class = "product-imgs">
                        <div class = "img-display">
                            @php
                                if(isset($yardsale->image_uploads)){
                                    //decode the json object
                                    $imgLinks = json_decode($yardsale->image_uploads);
                                    $titleImage = null;
                                    if(is_array($imgLinks)){
                                        $titleImage = $imgLinks[0];
                                    }
                                }
                            @endphp
                            <img src={{$yardsale->image_uploads ? asset('storage/'.$titleImage) : asset('/images/rotunda.jpg')}} id = "expandedImg" alt="image doesnt exist">
                        </div>
                        <div style="z-index:10;">
                            <ul class="img-list">
                                 @if(is_array(json_decode($yardsale->image_uploads)))
                                    @foreach(json_decode($yardsale->image_uploads) as $link)
                                        <li>
                                            <img src={{$yardsale->image_uploads ? asset('storage/'.$link) : asset('/images/rotunda.jpg')}} alt = "shoe image" onclick="myFunction(this);">
                                        </li>
                                    @endforeach
                                @endif 
                            </ul>
                        </div>
                    </div>
                    <!-- card right -->
                    <div class = "product-content">

                        {{-- product title --}}
                        <div class="show-top">
                            <h1>{{$yardsale->yard_sale_title}}</h1>

                                {{-- price and other info --}}
                                <div class = "product-details">
                                    @php
                                        $startTime = new DateTime($yardsale->yard_sale_date . " " . $yardsale->start_time);
                                        $endTime = new DateTime($yardsale->yard_sale_date . " " . $yardsale->end_time);
                                    @endphp
                                    <h4>
                                        Date: {{$yardsale->yard_sale_date}} | From: <?php echo $startTime->format('g:iA')  ?> 
                                        To: <?php echo $endTime->format('g:iA')  ?>
                                    </h4>
                                </div>
                                
                        </div>
                        <div class = "show-top product-description">
                            <h4 class="spacer">YardSale Description:</h4>
                            <p>{{$yardsale->description}}</p>
                        </div>
                        <div class="show-top">
                            @php
                                $categories = explode(", ", $yardsale->category);
                            @endphp
                            <h4 class="spacer">Categories</h4>
                            <div class="categories">
                                @foreach($categories as $category)
                                    <a href="/category={{$category}}">{{$category}}</a>
                                @endforeach
                            </div> 
                        </div> 
                        <div class = "product-buttons-container show-top">
                            @if(!auth()->guest())
                            <span>
                                <a href="#" class="button1 bouncy">Add to Favorites</a>
                            </span>
                            @endif
                            @if($yardsale->user_id == $currentUser)
                                <span>
                                    <a href="/yardsale/{{$yardsale->id}}/edit" class="button1">Edit Yard Sale</a>
                                </span>
                                <span>
                                        <form method="POST" action="/yardsale/{{$yardsale->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button1 delete-button">Delete</button>
                                    </form>
                                </span>
                            @endif
                        </div>

                        {{-- <div class = "tags-container">
                            <x-listing-tags :listingTags="$yardsale->category"/>
                        </div> --}}
                    </div>
                </div>
            </div>

            {{-- user chat and map area --}}
            <div class="map-chat-container">
                <div class="map-container">
                    <h1>Maps feature</h1>
                </div>
                <div class="chat-container">
                    <h1><?php echo count({{$allUsers}})?></h1>
                </div>
            </div> 
        </div>
    </section>
    {{-- carousel section --}}
    <section class = "listings-parent-container">
         @include('partials._listingCarousel', ['listings' => $listings, 'message' => 'Other Related Items', 'carouselClass'=>'','carouselControls' => 'controls', 'carouselP' =>'previous previous1', 'carouselN' => 'next next1'])
    </section>
    <script>
        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
            }
    </script>
</x-layout>
{{-- @endsection --}}