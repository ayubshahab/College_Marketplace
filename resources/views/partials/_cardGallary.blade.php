{{-- source code from code pen --}}
{{-- source code link https://codepen.io/mahmudulhrabby/pen/GGqdvr --}}

{{-- css for listingGallary --}} 
<link rel="stylesheet" types="text/css" href="/css/listingGallary.css">
<section class="container" style="border: none !important"> 
    <div class="subcontainer">
        <div class="controller">
            <h2>{{$heading}}</h2>
        </div>
    
        {{-- go through the listings and generate cards for each then show in a list of cards  --}}
        <ul class="cards">
            @unless(count($listings) == 0)
                @foreach($listings as $listing)
                    <x-gallery-card :listing="$listing"/>
                @endforeach
            @else
                <p>NO Listings Found!</p>
            @endunless
            
        </ul>
        {{-- for pagination --}}
        <div class="pagination-container">
            {{$listings->appends(request()->query())->links()}}
        </div>
    </div>
</section>