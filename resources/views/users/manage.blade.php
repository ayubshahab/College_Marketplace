<x-layout>
    <link rel="stylesheet" types="text/css" href="/css/manage.css">
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
                                    <div>
                                        <h1>12</h1>
                                        <h5>Listings</h5>
                                    </div>

                                    <div>
                                        <h1>6</h1>
                                        <h5>Rentals</h5>
                                    </div>

                                    <div>
                                        <h1>2</h1>
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
                    @include('partials._cardGallary', ['listings' => $myListings, 'heading'=>'Your Listings:', 'displayTags' => false])
                </div>
                <div class="favorites-main">
                    @include('partials._cardGallary', ['listings' => $likedList, 'heading'=>'Liked Items:', 'displayTags' => false])
                </div>
                <div class="watchList-main"></div>
                <div class="requests-main"></div>
            </div>
        </div>
    </div>
    <script>
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
    </script>
</x-layout>