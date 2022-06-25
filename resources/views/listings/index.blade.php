


{{-- the listings page serves as the homepage and extends to layout for additional footer and navigation bar --}}
<x-layout >
    {{-- main page hero section --}}
    @include('partials._hero')

    <main class = "main-listings-container">

        {{-- carousel for listings --}}
        <div class = "listings-parent-container">
            @include('partials._listingCarousel', ['listings' => $listingsNear, 'message' => 'Items Within A Mile', 'carouselClass'=>'','carouselControls' => 'controls', 'carouselP' =>'previous previous1', 'carouselN' => 'next next1'])
        </div>

        {{-- carousel for rentables --}}
        <div class="listings-parent-container">
            @include('partials._rentablesCarousel',
            ['rentables'=> $rentables, 'message' => 'Items For Rent' , 'carouselClass' => 'slider2',
            'carouselControls' => 'controls2', 'carouselP' =>' previous previous2', 'carouselN' => 'next next2'])
        </div>
        
        {{-- main card gallery for items posted within the last 24hrs --}}
        <div class = "listings-parent-container">
            @include('partials._cardGallary', ['listings' => $listings, 'heading'=>'Items Recently Added', 'displayTags' => true])
        </div>

        {{-- carousel for subleases --}}
        <div class="listings-parent-container">
            @include('partials._subleaseCarousel',
            ['subleases'=> $subleases, 'message' => 'Places For Leasing' , 'carouselClass' => 'slider3',
            'carouselControls' => 'controls3', 'carouselP' =>' previous previous3', 'carouselN' => 'next next3'])
        </div>
    </main>
    <script>
        tns({
            container: ".slider2",
            "slideBy":1,
            "speed":400,
            "nav":false,
            controlsContainer:"#controls2",
            responsive:{
                1500:{
                    items: 5,
                    gutter: 5
                },
                1200:{
                    items: 4,
                    gutter: 10
                },
                1024:{
                    items: 3,
                    gutter: 15
                },
                768:{
                    items: 2,
                    gutter: 20
                },
                480:{
                    items: 1
                }
            }
        })

        tns({
            container: ".slider3",
            "slideBy":1,
            "speed":400,
            "nav":false,
            controlsContainer:"#controls3",
            responsive:{
                1500:{
                    items: 5,
                    gutter: 5
                },
                1200:{
                    items: 4,
                    gutter: 10
                },
                1024:{
                    items: 3,
                    gutter: 15
                },
                768:{
                    items: 2,
                    gutter: 20
                },
                480:{
                    items: 1
                }
            }
        })
    </script>
</x-layout>