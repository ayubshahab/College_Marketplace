


{{-- the listings page serves as the homepage and extends to layout for additional footer and navigation bar --}}
<x-layout >
    {{-- main page hero section --}}
    @include('partials._hero')

    <main class = "main-listings-container">

        {{-- carousel for listings --}}
        <div class = "listings-parent-container">
            @include('partials._listingCarousel', ['listings' => $listingsNear, 'message' => 'Items Within A Mile', 'carouselClass'=>'my-slider','carouselControls' => 'controls', 'carouselP' =>'previous previous1', 'carouselN' => 'next next1'])
        </div>

        {{-- carousel for rentables --}}
        <div class="listings-parent-container">
            @include('partials._rentablesCarousel',
            ['rentables'=> $rentables, 'message' => 'Items For Rent' , 'carouselClass' => 'slider2',
            'carouselControls' => 'controls2', 'carouselP' =>' previous previous2', 'carouselN' => 'next next2'])
        </div>
        
        {{-- main card gallery for items posted within the last 24hrs --}}
        <div class = "listings-parent-container">
            @include('partials._cardGallary', ['listings' => $listings, 'heading'=>'Items Recently Added', 'displayTags' => true, 'displayMoreButton' => true])
        </div>

        {{-- carousel for subleases --}}
        <div class="listings-parent-container">
            @include('partials._subleaseCarousel',
            ['subleases'=> $subleases, 'message' => 'Places For Leasing' , 'carouselClass' => 'slider3',
            'carouselControls' => 'controls3', 'carouselP' =>' previous previous3', 'carouselN' => 'next next3'])
        </div>
    </main>
</x-layout>