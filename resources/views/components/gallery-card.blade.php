@props(['listing'])
<li class="cards_item" data-aos="zoom-in" data-aos-once="true">
    <div class="card"> 
        <div class="card_image">
             @if($listing->status =='Available')
                <div class="status green">
                </div>
            @elseif($listing->status=='Pending')
                <div class="status yellow">
                </div>
            @else
                <div class="status">
                </div>
            @endif
            <a href="/listings/{{$listing->id}}">
                @php
                $imgLinks = null;
                    if(isset($listing->image_uploads)){
                        //decode the json object
                        $imgLinks = json_decode($listing->image_uploads);
                        if(is_array($imgLinks)){
                            $imgLinks = $imgLinks[0];
                        }
                    }
                @endphp
                {{-- <h1>{{$listing->image_uploads}}</h1> --}}
                <img src={{$listing->image_uploads ?asset('storage/'.$imgLinks) : asset('/images/rotunda.jpg') }}  alt="image doesnt exist">
                {{-- <img src="https://picsum.photos/500/300/?image=10"> --}}
            </a>
        </div>
        <div class="card_content">
            <a href="/listings/{{$listing->id}}">
                <h1 class="card_title">{{$listing->item_name}}</h1>
            </a>
            <h4 class="card_text">${{$listing->price}} | {{$listing->city}}, {{$listing->state}}</h4>
            <div class="listing-tags">
                <x-listing-tags :listingTags="$listing->tags"/>
            </div>
        </div> 
    </div>
</li>