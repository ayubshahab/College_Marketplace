




<link rel="stylesheet" type="text/css" href="/css/listing.css">

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.layout','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                    <?php if($leaseItem->status =='Available'): ?>
                        <div class="stat-container">
                            <div class="stat green">
                            </div>
                            <h4><?php echo e($leaseItem->status); ?></h4>
                        </div>
                    
                    <?php else: ?> 
                        <div class="stat-container">
                            <div class="stat">
                            </div>
                            <h4><?php echo e($leaseItem->status); ?></h4>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="selected-row">
                    <!-- card left -->
                    <div class = "product-imgs">
                        <div class = "img-display">
                            <?php
                                if(isset($leaseItem->image_uploads)){
                                    //decode the json object
                                    $imgLinks = json_decode($leaseItem->image_uploads);
                                    $titleImage = null;
                                    if(is_array($imgLinks)){
                                        $titleImage = $imgLinks[0];
                                    }
                                }
                            ?>
                            <img src=<?php echo e($leaseItem->image_uploads ? Storage::disk('s3')->url($titleImage) : asset('/images/rotunda.jpg')); ?> id = "expandedImg" alt="image doesnt exist">
                        </div>
                        <div class = "img-showcase">
                            <?php if(is_array(json_decode($leaseItem->image_uploads))): ?>
                                <?php $__currentLoopData = json_decode($leaseItem->image_uploads); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src=<?php echo e($leaseItem->image_uploads ? Storage::disk('s3')->url($link) : asset('/images/rotunda.jpg')); ?> alt = "shoe image" onclick="myFunction(this);">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?> 
                        </div>
                    </div>
                    <!-- card right -->
                    
                    <div class = "product-content">
                        
                        <div class = "product-header show-top">
                            <div class="name-status">
                                <h1><?php echo e($leaseItem->sublease_title); ?></h1> 
                            </div>
                            <h3> 
                                <span>$<?php echo e($leaseItem->rent); ?></span> | <?php echo e($leaseItem->location); ?>

                            </h3>    
                        </div>

                        
                        <div class = "product-details show-top" style="display:flex;flex-direction:row;gap:10px;">
                            <h4>From: 
                                <span><?php echo e($leaseItem->date_from); ?></span>
                            </h4>
                            <h4>To: 
                                <span><?php echo e($leaseItem->date_to); ?></span>
                            </h4>
                        </div>

                        
                        <div class = "product-details show-top">
                            <h4>Rent Negotiable/Fixed: 
                                <span><?php echo e($leaseItem->negotiable); ?></span>
                            </h4>
                            <h4>Condition: 
                                <span><?php echo e($leaseItem->condition); ?></span>
                            </h4>
                        </div>

                        <div class = "product-categories show-top">
                            <?php
                                $utilities = explode(", ", $leaseItem->utilities);
                            ?>
                            <div class="categories">
                                <h4 class="spacer">Utilities Included:</h4>
                                <?php $__currentLoopData = $utilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $utility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="/shop/all?type=lease&utilities=<?php echo e($utility); ?>"><?php echo e($utility); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div> 
                        </div>  

                        <div class = "product-description show-top">
                            <h4>Item Description:</h4>
                            <p><?php echo e($leaseItem->description); ?></p>
                        </div>

                        <div class="product-buttons">
                            <ul>
                                <li>
                                    <?php if($currentUser != null and $currentUser->leaseFavorites != null and in_array($leaseItem->id, explode(", " , $currentUser->leaseFavorites))): ?>
                                        <form action="/users/removefavorite" method="GET">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="type" value="sublease">
                                            <input type="hidden" name="id" value="<?php echo e($leaseItem->id); ?>">
                                            <button><i class="fa-solid fa-heart saved"></i></button>
                                        </form>
                                    <?php else: ?>
                                        <form action="/users/addfavorite" method="GET">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="type" value="sublease">
                                            <input type="hidden" name="id" value="<?php echo e($leaseItem->id); ?>">
                                            <button><i class="fa-solid fa-heart bouncy"></i></button>
                                        </form>
                                    <?php endif; ?>                                
                                </li>
                                <?php if($currentUser != null and $leaseItem->user_id == $currentUser->id): ?>
                                    <li>
                                        <form method="POST" action="/subleases/<?php echo e($leaseItem->id); ?>/update">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <select name="status" id="status" style = " font-size: 17px; text-align:center;" onchange="this.form.submit()">
                                                <option style = "text-align:center;">Status</option>
                                                <option style = "text-align:center;" value="Available">Available</option>
                                                <option style = "text-align:center;" value="Leased">Leased</option> 
                                            </select>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="/subleases/<?php echo e($leaseItem->id); ?>/edit" method = "GET">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($leaseItem->id); ?>">
                                            <button><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="/subleases/<?php echo e($leaseItem->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button><i class="fa fa-trash" ></i></button>
                                        </form>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="map-chat-container">
                <div class="map-container" id = "map-container">
                    
                </div>
                <div class="chat-container">
                    
                    

                    
                    
                </div>
            </div> 
        </div>
    </section>

    
    <section class = "listings-parent-container">
        
        <?php echo $__env->make('partials._subleaseCarousel',
        ['subleases'=> $subleaseQuery, 'message' => 'Places For Leasing' , 'carouselClass' => 'slider3',
        'carouselControls' => 'controls3', 'carouselP' =>' previous previous3', 'carouselN' => 'next next3'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    

    
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
   
    <script>
        
        var map = L.map('map-container').setView([51.505, -0.09], 13);

        function initMap() {

            var mapTwo;
            var geocoder;

            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var mapOptions = {
                zoom: 15,
                center: latlng
            }

            mapTwo = new google.maps.Map(document.getElementById('map-container'), mapOptions);

            if("<?php echo e($leaseItem->latitude); ?>" === "" || "<?php echo e($leaseItem->longitude); ?>" === "") {
                var address = "<?php echo e($leaseItem->street." ".$leaseItem->city); ?>";
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
                var latlng = new google.maps.LatLng("<?php echo e($leaseItem->latitude); ?>", "<?php echo e($leaseItem->langitude); ?>");
                //console.log(latlng);
                var mapOptions = {
                    zoom: 15,
                    center: latlng
                }
                mapTwo = new google.maps.Map(document.getElementById('map-container'), mapOptions);
                marker.setMap(mapTwo);
            }
        }

        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
        }

        var listing_id = "<?php echo e($leaseItem->id); ?>"
        var listingOwner = "<?php echo e($leaseItem->user_id); ?>";
        var userLoggedIn = "<?php echo e($currentUser ? $currentUser->id : -1); ?>";
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
                            if(data.for_listing == listing_id){
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
            if("<?php echo e(!auth()->guest()); ?>"){
                loadConversation(listingOwner, userLoggedIn);
            }
            function loadConversation(UserSending, UserReceiving ){
                if("<?php echo e($leaseItem->user_id); ?>" != userLoggedIn){
                    var ul = document.getElementById("messages");
                    ul.innerHTML = null;
                    
                    $.ajax({
                        type: "GET",
                        url: "/messages?from=" + UserSending + "&to=" + UserReceiving + "&listing_id=" + listing_id, // need to create this route
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
                                    date.innerHTML = "<?php echo e(date('d M y, h:i a', strtotime(" + data[i].created_at + "))); ?>";
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
                    url: "/messages?from=" + receiverSelected + "&to=" + listingOwner + "&listing_id=" + listing_id, // need to create this route
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
                                date.innerHTML = "<?php echo e(date('d M y, h:i a', strtotime(" + data[i].created_at + "))); ?>";
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
            if("<?php echo e(!auth()->guest()); ?>"){
                $(document).on('keyup', 'input', function(e){
                    var msg = $(this).val();
                    var datastr = null;
                    // if I am the listing owner, then i need a receiver id which should be the person I have selected form the users list
                    if(listingOwner == userLoggedIn){
                        // if it is my ownlisting, use receiver id, instead of listing owner id
                        datastr = "receiver_id=" + receiverSelected + "&message=" + msg + "&for_listing=" + listing_id;
                            // console.log(datastr);
                    }else{ //else send a message to the listing owner from me thats default
                        // console.log("bottom branch");
                        datastr = "receiver_id=" + listingOwner + "&message=" + msg + "&for_listing=" + listing_id;
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
    </script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHQxwBJAiHYROOX3zT6P7AwnBq1WGVmnM&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\COLLEGE_MARKETPLACE\resources\views/subleases/show.blade.php ENDPATH**/ ?>