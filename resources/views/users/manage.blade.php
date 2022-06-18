<x-layout>
    <link rel="stylesheet" types="text/css" href="/css/manage.css">
    <div class="listings-parent-container" style="min-height: 100vh;">
        <div class="profile-container">
            <div class="profile-header">
                <img src="/images/rotunda.jpg" alt="">
            </div>
            <div class = 'profile-body'>
                <div class="profile-details">
                    <div class='user-logo'>
                        
                    </div>
                    <h2>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
                    <h4>{{auth()->user()->email}}</h3>
                    <h4>{{auth()->user()->number ? auth()->user()->number : "No number given" }}</h4>

                    {{-- bought, sold, rented, subleased --}}
                </div>
                <div class="profile-attributes">
                    <div class='attributes-selector' id="buttons">
                        <ul>
                            <li><a  class="button1">My Listings</a></li>
                            <li><a  class="button1">Favorites</a></li>
                            <li><a  class="button1">Watch List</a></li>
                            <li><a  class="button1">Profile</a></li>
                        </ul>
                    </div>
                    {{-- container to show all my listings --}}
                    <div class='my-listings'>
                         @include('partials._cardGallary', ['listings' => $myListings, 'heading'=>'Your Listings:'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>