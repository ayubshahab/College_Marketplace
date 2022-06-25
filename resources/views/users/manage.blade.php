<x-layout>
    <link rel="stylesheet" types="text/css" href="/css/manage.css">
    <!-- CSS -->
    {{-- might need a license for flickity  --}}
    {{-- https://flickity.metafizzy.co/ --}}
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <div class="listings-parent-container" style="min-height: calc(100vh - 70px); height:fit-auto; padding: 0 !important; display: flex; justify-content:center; position:relative;">
        <img class="manage-img"src={{asset('/images/forest-background.jpg')}} alt="">
        <div class="profile-container">
            <input type="checkbox" id="show-filter" class="show-filter">
            <div class="select-panel">
                <label for="show-filter">
                {{-- <i class="fas fa-bars sidebar-toggle"></i> --}}
                    <i class="fas fa-bars sidebar-toggle"></i>
                </label> 
                <ul class="panel-options">
                    <li data-aos="fade-right" data-aos-delay="100"><span  onclick="toggleDiv(0)" class="selector">Profile</span></li>
                    <li data-aos="fade-right" data-aos-delay="200"><span class="selector" onclick="toggleDiv(1)">My Posts</span></li>
                    <li data-aos="fade-right" data-aos-delay="300"><span class="selector" onclick="toggleDiv(2)">Favorites</span></li>
                    <li data-aos="fade-right" data-aos-delay="400"><span
                    class="selector" onclick="toggleDiv(3)">Watch List</span></li>
                    <li data-aos="fade-right" data-aos-delay="500"><span class="selector" onclick="toggleDiv(4)">Requests</span></li>
                </ul>
            </div>
            <div class="show-panel" id="main-panels-container">
                <div class="profile-main">
                    <div class='top-row'>
                        <div class='profile-picture'>
                            <img src={{asset('/images/profile-picture.jpg')}} alt="">
                        </div>
                        <div class="profile-theme">
                        </div>
                    </div>
                    <div class="bottom-row">
                        <div class="left-side">
                            <h3>{{auth()->user()->first_name}} {{auth()->user()->last_name}} <span>| {{auth()->user()->id}}</span></h3>
                            <h5>{{auth()->user()->email}}</h5>
                        </div>
                        <div class="details-cont">
                            <div class="details-inner">
                                <div class="post-count">
                                    @php
                                        $listingCount = 0;
                                        $rentalCount = 0;
                                        $leaseCount = 0;
                                        foreach($myListings as $single){
                                            if($single instanceof \App\Models\Listing){
                                                $listingCount++;
                                            }elseif($single instanceof \App\Models\Rentable){
                                                $rentalCount++;
                                            }elseif($single instanceof \App\Models\Sublease){
                                                $leaseCount++;
                                            }
                                        }    
                                    @endphp
                                    <div>
                                        <h1>{{$listingCount != 0? $listingCount : 0}}</h1>
                                        <h5>Listings</h5>
                                    </div>

                                    <div>
                                        <h1>{{$rentalCount != 0? $rentalCount : 0}}</h1>
                                        <h5>Rentals</h5>
                                    </div>

                                    <div>
                                        <h1>{{$leaseCount != 0? $leaseCount : 0}}</h1>
                                        <h5>Leases</h5>
                                    </div>
                                </div>
                                <div class="recent-messages">
                                    
                                </div>
                            </div>
                            <div class="my-address">
                                <form class="addressForm" action="/users/additionalInfo" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h3 class="">Address</h3>
                                    <input type="text" name="street" placeholder="Street, nbr"  value="{{ old('street', null) }}"/>
                                    @error('street')
                                        <p>{{$message}}</p>
                                    @enderror

                                    <input type="text" name = "city" placeholder="City"  value="{{ old('city', null) }}"/>
                                    @error('city')
                                        <p>{{$message}}</p>
                                    @enderror

                                    <input type="text" name = "state" placeholder="State"  value="{{ old('state', null) }}"/>
                                    @error('state')
                                        <p>{{$message}}</p>
                                    @enderror

                                    <input type="text" name = "country" placeholder="Country"  value="{{ old('country', null) }}" />
                                    @error('country')
                                        <p>{{$message}}</p>
                                    @enderror

                                    <input type="text" name = "postcode"placeholder="Postcode"  value="{{ old('postcode', null) }}" />
                                    @error('postcode')
                                        <p>{{$message}}</p>
                                    @enderror

                                    <input type="text" name = "phoneNumber"placeholder="Phone Number"  value="{{ old('phoneNumber', null) }}" />
                                    @error('phoneNumber')
                                        <p>{{$message}}</p>
                                    @enderror
                                    
                                    <input type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="myPosts-main">
                    @include('partials._cardGallary', ['listings' => $myListings, 'heading'=>'My Listings', 'displayTags' => false])
                </div>
                <div class="favorites-main">
                    @include('partials._cardGallary', ['listings' => $likedList, 'heading'=>'Liked Items', 'displayTags' => false])
                </div>
                <div class="watchList-main">
                    <div class="watchlist-header">
                        <h2>WatchList</h2>
                        <div class="create-watch-item" id="modal-trigger">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    <div class="watchitem-container">
                        @if(count($watchList) != 0)
                            @foreach($watchList as $watchItem)
                            <div class='watchitem'>
                                <h3>{{$watchItem->watchitem_title}}</h3>
                                <h5>{{$watchItem->type}} | Match Rate:  {{$watchItem->match_rate}}</h5>
                                <div class="tags-container">
                                    @php
                                        $tags = explode(", ", $watchItem->key_tags);
                                    @endphp
                                    <x-listing-tags :tags="$tags"/>
                                </div>
                                <div class="found-carousel">
                                    <div class="carousel" aria-label="carousel" Tabindex="0">
                                        <div class="slides">
                                            @foreach($matches as $match)
                                                <div class="slides-item" id="slide-1">
                                                    1
                                                </div>
                                            @endforeach
                                        </div>  
                                    </div>
                                </div>
                                <div class="bottom-ribbon"></div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            
                            <h3>Create New Watch Item</h3>
                            <p>All tags entered below will be cross checked with with the respective fields of the type selected.</p>
                            <form action="/users/manage/createWatchItem" class="watchlist-form" id="watchlist-form" method="POST">
                                @csrf
                                <input type="hidden" name="user_id"
                                value={{auth()->user()->id}}>
                                <input type="text" placeholder="Title" name="watchitem_title">
                                <div class="watch-tags-container">
                                    <input type="hidden" name="key_tags" id="key_tags">
                                    <ul class="tags-list" id="tags-list">

                                    </ul>
                                </div>
                                <div class="watchlist-bottom">
                                    <div class="left">
                                        <select name="type" id="type">
                                            <option value="listing">Listing</option>
                                            <option value="rentable">Rentable</option>
                                            <option value="lease">Lease</option>
                                        </select>
                                        <select name="match_rate" id="match_rate" >
                                            <option value="" disabled selected>Match Rate</option>
                                            <option value="20">20%</option>
                                            <option value="40">40%</option>
                                            <option value="60">60%</option>
                                            <option value="80">80%</option>
                                            <option value="100">100%</option>
                                        </select>
                                    </div>
                                    <div class="right">
                                        <input type="text" placeholder="Press Enter to Add Tag Word"  onkeydown="search(this)" class="input">
                                        <input type="submit" value="Set Filter" class="submit-form">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="requests-main"></div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script>

        // clicking through the panel options and their corresponding displays
        function toggleDiv(id) {
            const myElement = document.getElementById('main-panels-container');
            const options = document.getElementsByClassName('selector');
            console.log(options);
            for (let i = 0; i < myElement.children.length; i++) {
                if(i == id){
                    myElement.children[i].style.display = 'flex';
                }else{
                    myElement.children[i].style.display = 'none';
                }
            }
        }

        // modal popup 
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("modal-trigger");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "grid";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // preventing form submit on enter
        document.getElementById("watchlist-form").onkeypress = function(e) {
            var key = e.charCode || e.keyCode || 0;     
            if (key == 13) {
                // alert("No Enter!");
                e.preventDefault();
            }
        } 

        // get input value from 
        var keyTags = [];
        function search(ele) {
            if(event.key === 'Enter') {
                if(ele.value.trim() != null && ele.value.trim() != " " && ele.value.trim() != ""){
                    var ul = document.getElementById('tags-list');
                    var li =document.createElement('li');
                    var a = document.createElement('a');
                    a.innerHTML= ele.value;
                    keyTags.push(ele.value);
                    li.appendChild(a);
                    ul.appendChild(li);
                    ele.value="";     
                }   
            }
            document.getElementById('key_tags').value=keyTags.join(", ");
        }
    </script>
</x-layout>