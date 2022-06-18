@props(['listing'])
<div>
    <div {{$attributes->merge(['class'=> 'slide single-post-cont'])}}>
        <a href="/listings/{{$listing->id}}">
            <div class="slide-img">
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
                @php
                    $hardLink=['/images/rotunda.jpg', '/images/old-cabell.jpg', '/images/cavalier-horse.jpg'];
                    $link = $hardLink[random_int(0, count($hardLink)-1)];
                @endphp
                <img src={{$listing->image_uploads ?asset('storage/'.$imgLinks) : asset($link) }}  alt="image doesnt exist">
            </div>
        </a>
        <div class = "listing-details">
            <a href="/listings/{{$listing->id}}">{{$listing->item_name}}</a>
            <h4>${{$listing->price}}</h4>
            <h5>{{$listing->city}}, {{$listing->state}}</h5>
            {{-- <p>{{$listing->status}}</p> --}}
        </div>
    </div>
</div>