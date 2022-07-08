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
                    <x-gallery-card :listing="$listing" :displayTags="$displayTags"/>
                @endforeach
            @else
                <p class="empty-gallary-message">NO Listings Found!</p>
            @endunless
            
        </ul>
        {{-- for pagination --}}
        <div class="pagination-container">
            @if($listings instanceof \Illuminate\Pagination\Paginator ||
            $listings instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{-- {{$listings->appends(request()->query())->links()}} --}}
                @if($listings->currentPage() > 1)
                    {{-- <a class="button1 paginate-previous" href="{{ $listings->previousPageUrl()}}">Previous</a> --}}
                    <a class="button1 paginate-previous" href="{{$listings->appends(request()->query())->previousPageUrl()}}">Previous</a>
                @elseif($listings->hasPages())
                    {{-- first page --}}
                    <a class="button1 paginate-previous">First Page</a>
                @endif
                @if($listings->hasMorePages())
                    {{-- <a class ="button1 paginate-next" href="{{ $listings->nextPageUrl() }}">Next</a> --}}
                    <a class="button1 paginate-next" href="{{$listings->appends(request()->query())->nextPageUrl()}}">Next</a>
                @elseif($listings->hasPages())
                    {{-- last page --}}
                    <a class ="button1 paginate-next" >Last Page</a>
                @endif
            @endif
        </div>
    </div>
</section>