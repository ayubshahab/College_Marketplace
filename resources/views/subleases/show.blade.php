{{-- @extends('layout') --}}

{{-- @section('content') --}}

{{-- css for individual user listing --}}
<link rel="stylesheet" type="text/css" href="/css/listing.css">

<x-layout>
    <section class = "product-details-container">
        <div class = "card-wrapper-selected">
            <div class = "card-selected">
                <div class="back-button">
                    <a href="javascript:history.back()" class="button1 b-button">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div> 
                <div class = "track">
                    <h5>Home > Clothes > Pants > Ripped Jeans</h5>
                    @if($leaseItem->status =='Available')
                        <div class="stat-container">
                            <div class="stat green">
                            </div>
                            <h4>{{$leaseItem->status}}</h4>
                        </div>
                    {{-- the else ortion of the if is for when status is rented --}}
                    @else 
                        <div class="stat-container">
                            <div class="stat">
                            </div>
                            <h4>{{$leaseItem->status}}</h4>
                        </div>
                    @endif 
                </div>
                <div class="selected-row">
                    <!-- card left -->
                    <div class = "product-imgs">
                        <div class = "img-display">
                            @php
                                if(isset($leaseItem->image_uploads)){
                                    //decode the json object
                                    $imgLinks = json_decode($leaseItem->image_uploads);
                                    $titleImage = null;
                                    if(is_array($imgLinks)){
                                        $titleImage = $imgLinks[0];
                                    }
                                }
                            @endphp
                            <img src={{$leaseItem->image_uploads ? Storage::disk('s3')->url($titleImage) : asset('/images/rotunda.jpg')}} id = "expandedImg" alt="image doesnt exist">
                        </div>
                        <div class = "img-showcase">
                            @if(is_array(json_decode($leaseItem->image_uploads)))
                                @foreach(json_decode($leaseItem->image_uploads) as $link)
                                    <img src={{$leaseItem->image_uploads ? Storage::disk('s3')->url($link) : asset('/images/rotunda.jpg')}} alt = "shoe image" onclick="myFunction(this);">
                                @endforeach
                            @endif 
                        </div>
                    </div>
                    <!-- card right -->
                    
                    <div class = "product-content">
                        {{-- product title --}}
                        <div class = "product-header show-top">
                            <div class="name-status">
                                <h1>{{$leaseItem->sublease_title}}</h1> 
                            </div>
                            <h3> 
                                <span>${{$leaseItem->rent}}</span> | {{$leaseItem->location}}
                            </h3>    
                        </div>

                        {{-- dates available --}}
                        <div class = "product-details show-top" style="display:flex;flex-direction:row;gap:10px;">
                            <h4>From: 
                                <span>{{$leaseItem->date_from}}</span>
                            </h4>
                            <h4>To: 
                                <span>{{$leaseItem->date_to}}</span>
                            </h4>
                        </div>

                        {{-- price and other info --}}
                        <div class = "product-details show-top">
                            <h4>Rent Negotiable/Fixed: 
                                <span>{{$leaseItem->negotiable}}</span>
                            </h4>
                            <h4>Condition: 
                                <span>{{$leaseItem->condition}}</span>
                            </h4>
                        </div>

                        <div class = "product-categories show-top">
                            @php
                                $utilities = explode(", ", $leaseItem->utilities);
                            @endphp
                            <div class="categories">
                                <h4 class="spacer">Utilities Included:</h4>
                                @foreach($utilities as $utility)
                                    <a href="/shop/all?type=lease&utilities={{$utility}}">{{$utility}}</a>
                                @endforeach
                            </div> 
                        </div>  

                        <div class = "product-description show-top">
                            <h4>Item Description:</h4>
                            <p>{{$leaseItem->description}}</p>
                        </div>

                        <div class="product-buttons">
                            <ul>
                                <li>
                                    @if($currentUser != null and $currentUser->leaseFavorites != null and in_array($leaseItem->id, explode(", " , $currentUser->leaseFavorites)))
                                        <form action="/users/removefavorite" method="GET">
                                            @csrf
                                            <input type="hidden" name="type" value="sublease">
                                            <input type="hidden" name="id" value="{{$leaseItem->id}}">
                                            <button><i class="fa-solid fa-heart saved"></i></button>
                                        </form>
                                    @else
                                        <form action="/users/addfavorite" method="GET">
                                            @csrf
                                            <input type="hidden" name="type" value="sublease">
                                            <input type="hidden" name="id" value="{{$leaseItem->id}}">
                                            <button><i class="fa-solid fa-heart bouncy"></i></button>
                                        </form>
                                    @endif                                
                                </li>
                                @if($currentUser != null and $leaseItem->user_id == $currentUser->id)
                                    <li>
                                        <form method="POST" action="/subleases/{{$leaseItem->id}}/update">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" id="status" style = " font-size: 17px; text-align:center;" onchange="this.form.submit()">
                                                <option style = "text-align:center;">Status</option>
                                                <option style = "text-align:center;" value="Available">Available</option>
                                                <option style = "text-align:center;" value="Leased">Leased</option> 
                                            </select>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="/subleases/{{$leaseItem->id}}/edit" method = "GET">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$leaseItem->id}}">
                                            <button><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                        <span id="delete-modal-trigger">
                                            <i class="fa fa-trash" ></i>
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- user chat and map area --}}
            <div class="map-chat-container">
                <div class="map-container" id = "map-container">
                    {{-- <h1>Maps feature</h1> --}}
                </div>
                <div class="chat-container">
                    {{-- only want to go through list of users & the messages from each user if the current listing is mine --}}
                    @if($currentUser != null and $leaseItem->user_id == $currentUser->id)
                        <div class="user-wrapper">
                            <ul class="users">
                                @if(count($allUsers) >= 1)
                                    @foreach($allUsers as $user)
                                        <li class="user" id="{{ $user->id }}">
                                            {{--will show unread count notification--}}
                                            @if($user->unread)
                                                <span class="pending">{{ $user->unread }}</span>
                                            @endif
                                
                                            {{-- <span class="pending">1</span> --}}


                                            <div class="media-left">
                                                <img src="{{ $user->avatar }}" alt="" class="media-object">
                                            </div>

                                            <div class="media-body">
                                                <p class="name">{{ $user->first_name }} {{$user->last_name }} | ID: {{$user->id}} </p>
                                                <p class='email'>{{$user ->email}} </p>   
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="no-messages"><span>You have no messages</span></li>
                                @endif
                            </ul>
                        </div>
                    @endif

                    {{-- the messages container should be default active, and only inactive the current listing is the user's own --}}
                    <div id="scroll-to-bottom" class="messages-container active">
                        @if($currentUser != null and $leaseItem->user_id == $currentUser->id)
                            <a class="message-back">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                        @else
                            <a class="back-placeholder">
                                Chat with {{$listingOwner->first_name}} {{$listingOwner->last_name}}
                            </a>
                        @endif
                       
                        <ul class="messages" id='messages'>
                            @if(auth()->guest())
                                <li class="message clearfix">
                                    <div class="sent">
                                        <p>Please log in to begin chat</p>
                                        <p class='date'>-System</p>
                                    </div>
                                </li>
                            @endif
                            
                        </ul>
                        <div id = "input-text" class=.input-text>
                            <input type="text" name="message" placeholder="Message Seller" class="submit">
                        </div>
                    </div> 
                </div>
            </div> 
        </div>
        <div class="modal" id="delete-modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1>Delete Listing</h1>
                <p>Are you sure you want to delete this listing?</p>

                <div class="clearfix">
                    <input type="button" class="button1" class="cancelbtn" id="cancelbtn" value="Cancel" />
                    <form method="POST" action="/subleases/{{$leaseItem->id}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="deletebtn button1" value="Delete"/>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- carousel section --}}
    <section class = "listings-parent-container">
        {{-- carousel for subleases --}}
        @include('partials._subleaseCarousel',
        ['subleases'=> $subleaseQuery, 'message' => 'Places For Leasing' , 'carouselClass' => 'slider3',
        'carouselControls' => 'controls3', 'carouselP' =>' previous previous3', 'carouselN' => 'next next3'])
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    

    {{-- for pusher real time messages --}}
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
   
    <script>
        
        function isEmpty(input){
            if(input === '' || input === null || input === undefined || input == null){
                return true;
            }return false;
        }                
        function initMap() {
            var mapTwo;
            var geocoder;
            var listingLat = "{{$leaseItem->latitude}}";
            var listingLong = "{{$leaseItem->longitude}}";

            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var mapOptions = {
                zoom: 15,
                center: latlng
            }

            mapTwo = new google.maps.Map(document.getElementById('map-container'), mapOptions);
                console.log(listingLat, listingLong);

            if(!isEmpty("{{$leaseItem->street}}")  && !isEmpty("{{$leaseItem->state}}")) {
                console.log('top if');
                var address = "{{$leaseItem->street." ".$leaseItem->city}}";
                //console.log(address);
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == 'OK') {
                        mapTwo.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                        mapTwo: mapTwo,
                        position: results[0].geometry.location
                    });
                    marker.setMap(mapTwo);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            } else {
                console.log('bottom if');
                console.log("{{$leaseItem->latitude}}", "{{$leaseItem->longitude}}");
                var latlng = new google.maps.LatLng("{{$leaseItem->latitude}}", "{{$leaseItem->longitude}}");
                //console.log(latlng);
                var mapOptions = {
                    zoom: 15,
                    center: latlng
                }
                mapTwo = new google.maps.Map(document.getElementById('map-container'), mapOptions);
                var marker = new google.maps.Marker({
                    mapTwo: mapTwo,
                    position: latlng
                });
                marker.setMap(mapTwo);
            }
        }

        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
        }

        var listing_id = "{{$leaseItem->id}}"
        var listingOwner = "{{$leaseItem->user_id}}";
        var userLoggedIn = "{{$currentUser ? $currentUser->id : -1}}";
        var receiverSelected = null; //the person whose chat we have open
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Pusher.logToConsole = true;

            var pusher = new Pusher('5b40ba1f12ea9bf24b29', {
                cluster: 'us2'
            });

            var channel = pusher.subscribe('my-channel');
            // 2 cases
            // if I am not the listing owner, show me messages that have been sent to me instantly
            // if I am the listing owner -> get selected user and update their information or display a pending symbol
            channel.bind('my-event', function(data) {
                console.log(data);
                if (userLoggedIn == data.from) {
                    // if I am not the listing owner and I am sending a message
                    if(userLoggedIn != listingOwner){
                        loadConversation(listingOwner, userLoggedIn);
                    }else{ //if I am the listing owner and I am sending the message
                        //  need to have an option for a user selected or pending
                        if(receiverSelected != null){ // if the receiver is selected
                            $('#'+receiverSelected).click();
                        }
                    }
                }else if (userLoggedIn == data.to) {
                    if(userLoggedIn != listingOwner){
                        loadConversation(listingOwner, userLoggedIn);
                    }else{ //if the listing owner is the user logged in
                        if(receiverSelected != null){ // if the receiver is selected
                            $('#'+receiverSelected).click();
                        }else{
                            console.log(data);
                            if(data.for_sublease == listing_id){
                                var pending = parseInt($('#' + data.from).find('.pending').html());
                                if (pending) {
                                    $('#' + data.from).find('.pending').html(pending + 1);
                                } else {
                                    $('#' + data.from).append('<span class="pending">1</span>');
                                }
                            }
                        }
                    }
                }
            });

            // if I am the listing owner, I want to see all the users that have contacted me
            if(listingOwner == userLoggedIn){
                $('.messages-container').removeClass('active');
                $('.user-wrapper').addClass('active');
            }

            // back button to switch from messages container to users list container
            $('.message-back').click(function(){
                $('.messages-container').removeClass('active');
                $('.user-wrapper').addClass('active');
                receiverSelected = null;
            });
            
            // if the listing is not mine, load all messages from the listing owner, to me the current user logged in
            if("{{!auth()->guest()}}"){
                loadConversation(listingOwner, userLoggedIn);
            }
            function loadConversation(UserSending, UserReceiving ){
                if("{{$leaseItem->user_id}}" != userLoggedIn){
                    var ul = document.getElementById("messages");
                    ul.innerHTML = null;
                    
                    $.ajax({
                        type: "GET",
                        url: "/messages?from=" + UserSending + "&to=" + UserReceiving + "&sublease_id=" + listing_id, // need to create this route
                        data: "JSON",
                        cache: false,
                        success: function (data) {
                            // console.log(data);
                            if(data != null){
                                
                                var ul = document.getElementById("messages");
                                for(var i = 0; i< data.length; i++){
                                    // console.log(data[i]);
                                    var li = document.createElement("li");
                                    li.className = 'message clearfix'
                                    
                                    var div = document.createElement('div');
                                    if(data[i].from == userLoggedIn){
                                        div.className="sent"
                                    }else{
                                        div.className="received"
                                    }
                                    var message = document.createElement('p');
                                    message.innerHTML = data[i].message;
                                    div.appendChild(message);
                                    var date = document.createElement('p');
                                    date.innerHTML = "{{date('d M y, h:i a', strtotime(" + data[i].created_at + "))}}";
                                    date.className='date';
                                    div.appendChild(date);

                                    li.appendChild(div);
                                    ul.appendChild(li);
                                    scrollToBottomFunc();
                                }
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                        }
                    });
                }
            }

            // if I am the listing owner, I want to click on a user and get all the messages from me to them or them to me
            $('.user').click(function(){
                var ul = document.getElementById("messages");
                ul.innerHTML = null;

                $('.user-wrapper').removeClass('active');
                $('.messages-container').addClass('active');
                receiverSelected = $(this).attr('id');
                $(this).find('.pending').remove();

                $.ajax({
                    type: "GET",
                    url: "/messages?from=" + receiverSelected + "&to=" + listingOwner + "&sublease_id=" + listing_id, // need to create this route
                    data: "JSON",
                    cache: false,
                    success: function (data) {
                        // console.log(data);
                        if(data != null){
                            
                            var ul = document.getElementById("messages");
                            for(var i = 0; i< data.length; i++){
                                // console.log(data[i]);
                                var li = document.createElement("li");
                                li.className = 'message clearfix'
                                
                                var div = document.createElement('div');
                                if(data[i].from == listingOwner){
                                    div.className="sent"
                                }else{
                                    div.className="received"
                                }
                                var message = document.createElement('p');
                                message.innerHTML = data[i].message;
                                div.appendChild(message);
                                var date = document.createElement('p');
                                date.innerHTML = "{{date('d M y, h:i a', strtotime(" + data[i].created_at + "))}}";
                                date.className='date';
                                div.appendChild(date);

                                li.appendChild(div);
                                ul.appendChild(li);
                                scrollToBottomFunc();
                            }
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }
                });
            });

            // take to take in to account two different scenarios
            //1) if the listing is not mine, i wanna be able to message the listing owner
            //2) if the listing is mine, select a specifc user, then get their id and sent them the message
            if("{{!auth()->guest()}}"){
                $(document).on('keyup', 'input', function(e){
                    var msg = $(this).val();
                    var datastr = null;
                    // if I am the listing owner, then i need a receiver id which should be the person I have selected form the users list
                    if(listingOwner == userLoggedIn){
                        // if it is my ownlisting, use receiver id, instead of listing owner id
                        datastr = "receiver_id=" + receiverSelected + "&message=" + msg + "&for_sublease=" + listing_id;
                            // console.log(datastr);
                    }else{ //else send a message to the listing owner from me thats default
                        // console.log("bottom branch");
                        datastr = "receiver_id=" + listingOwner + "&message=" + msg + "&for_sublease=" + listing_id;
                    }
                    console.log(datastr);
                    if(e.keyCode == 13 && msg != '' && listingOwner != ''){
                        $(this).val(''); // while pressed enter text box will be empty
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: "/sendmessage", 
                            type: 'POST',
                            data: datastr,
                            dataType: 'JSON',
                            _token: CSRF_TOKEN,
                            cache: false,
                            success: function (data) {
                                console.log(data);
                            },
                            error: function (jqXHR, status, err) {
                                console.log(err);
                            },
                            complete: function () {
                                // scrollToBottomFunc();
                            }
                        })
                    }
                });
            }
        });

         // make a function to scroll down auto
        function scrollToBottomFunc() {
           let scroll_to_bottom = document.getElementById('messages');
            scrollBottom(scroll_to_bottom);
        }
        function scrollBottom(element) {
            element.scroll({ top: element.scrollHeight, behavior: "smooth"})
        }

        //delete modal
        var deleteModal = document.getElementById("delete-modal");
        var deleteButton = document.getElementById("delete-modal-trigger");
        var deleteSpan = document.getElementsByClassName("close")[0];
        var cancelBtn = document.getElementById('cancelbtn');
        deleteButton.onclick = function() {
            deleteModal.style.display = "grid";
        }
        deleteSpan.onclick = function() {
            deleteModal.style.display = "none";
        }
        cancelBtn.onclick = function() {
            deleteModal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == deleteModal) {
                deleteModal.style.display = "none";
            }
        }
    </script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHQxwBJAiHYROOX3zT6P7AwnBq1WGVmnM&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>

</x-layout>
{{-- @endsection --}}