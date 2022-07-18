{{-- css for the carousel --}}
<link rel="stylesheet" types ="text/css" href="/css/carousel.css">

<section id="slider">
    <div class="container">
        <div class="subcontainer">
            <div class="slider-wrapper">
                @unless(count($listings) == 0)
                    <div id="{{$carouselControls}}">
                        <button class = "{{$carouselP}}">
                            <i   class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class = "{{$carouselN}}">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                @endunless
                <div class="controller">
                    <div> 
                        <h2>{{$message}}: @php echo count($listings) @endphp</h2>
                        <a style="font-size:14px;" href="/shop/all?type=listing" class="button1">MORE ></a>
                    </div>
                </div>
                <br>
                @unless(count($listings) == 0)
                    <div class="my-slider {{$carouselClass}}">
                        @foreach($listings as $listing)
                            <div>
                                <x-carousel-card :listing="$listing"/>
                            </div>
                        @endforeach                      
                    </div>
                @else
                    <p class="empty-gallary-message">No Listings Found!</p>
                @endunless
            </div>
        </div>
    </div>
    <script>

        tns({
            container: ".my-slider",
            "slideBy":1,
            "speed":400,
            "nav":false,
            controlsContainer:"#controls",
            responsive:{
                1500:{
                    items: 5,
                    gutter: 5
                },
                1200:{
                    items: 4,
                    gutter: 10
                },
                // 1100:{
                //     items: 3,
                //     gutter: 15
                // },
                1024:{
                    items: 3,
                    gutter: 15
                },
                700:{
                    items: 2,
                    gutter: 20
                },
                480:{
                    items: 1
                }
            }
        })

    </script>
</section>