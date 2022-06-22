@props(['listing', 'rentable', 'sublease'])
<div>
    {{-- if the card is a listing card --}}
    @if($listing != null)
        <div {{$attributes->merge(['class'=> 'slide single-post-cont'])}}>
            <div class="cr cr-top cr-right cr-sticky listing">{{$listing->status}}</div>
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
    {{-- if the card is a rentable card --}}
    @elseif($rentable != null)
        <div {{$attributes->merge(['class'=> 'slide single-post-cont '])}}>
            <div class="cr cr-top cr-right cr-sticky rentable">{{$rentable->status}}</div>
            <a href="/rentables/{{$rentable->id}}">
                <div class="slide-img">
                    @if($rentable->status =='Available')
                        <div class="status green">
                        </div>
                    @else
                        <div class="status">
                        </div>
                    @endif
                
                    @php
                    $imgLinks = null;
                        if(isset($rentable->image_uploads)){
                            //decode the json object
                            $imgLinks = json_decode($rentable->image_uploads);
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
                    <img src={{$rentable->image_uploads ?asset('storage/'.$imgLinks) : asset($link) }}  alt="image doesnt exist">
                </div>
            </a>
            <div class = "listing-details">
                <a href="/rentables/{{$rentable->id}}">{{$rentable->rental_title}}</a>
                <h4>${{$rentable->rental_charging}} / {{$rentable->rental_duration}}</h4>
                <h5>{{$rentable->city}}, {{$rentable->state}}</h5> 
            </div>
        </div>
    @else
         <div {{$attributes->merge(['class'=> 'slide single-post-cont '])}}>
            <div class="cr cr-top cr-right cr-sticky sublease">{{$sublease->status}}</div>
            <a href="/subleases/{{$sublease->id}}">
                <div class="slide-img">
                    @if($sublease->status =='Available')
                        <div class="status green">
                        </div>
                    @else
                        <div class="status">
                        </div>
                    @endif
                
                    @php
                    $imgLinks = null;
                        if(isset($sublease->image_uploads)){
                            //decode the json object
                            $imgLinks = json_decode($sublease->image_uploads);
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
                    <img src={{$sublease->image_uploads ?asset('storage/'.$imgLinks) : asset($link) }}  alt="image doesnt exist">
                </div>
            </a>
            <div class = "listing-details">
                <a href="/subleases/{{$sublease->id}}">{{$sublease->sublease_title}}</a>
                <h4>${{$sublease->rent}} / Mo | {{$sublease->negotiable}}</h4>
                <h5>{{$sublease->location}}</h5> 
            </div>
        </div>
    @endif
</div>