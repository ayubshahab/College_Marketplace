{{-- css for the carousel --}}
<link rel="stylesheet" types ="text/css" href="/css/carousel.css">

<section id="slider">
    <div class="container">
        <div class="subcontainer">
            <div class="slider-wrapper">
                <div id="{{$carouselControls}}">
                    <button class = "{{$carouselP}}">
                        <i   class="fa-solid fa-angle-left"></i>
                    </button>
                    <button class = "{{$carouselN}}">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
                <div class="controller">
                    <div> 
                        <h2>{{$message}}: @php echo count($subleases) @endphp</h2>
                    </div>
                </div>
                <br>
                <div class="my-slider {{$carouselClass}}">

                    {{-- need to loop in here  --}}
                    
                    @unless(count($subleases) == 0)
                        @foreach($subleases as $sublease)
                            <x-carousel-card :listing="null" :rentable="null" :sublease="$sublease"/>
                        @endforeach

                        @else
                            <p>No Leases Found!</p>
                    @endunless
                      
                </div>
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
            prevButton:".previous1",
            nextButton:".next1",
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
</section>