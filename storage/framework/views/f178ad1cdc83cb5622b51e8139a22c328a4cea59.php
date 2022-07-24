<?php $listingProvider = app('App\Http\Controllers\ListingController'); ?>
<?php $rentableProvider = app('App\Http\Controllers\RentablesController'); ?>
<?php $subleaseProvider = app('App\Http\Controllers\SubleaseController'); ?>
<?php $userProvider = app('App\Http\Controllers\UserController'); ?>

<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.layout','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <link rel="stylesheet" types="text/css" href="/css/manage.css">
    <!-- CSS -->
    
    
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <div class="listings-parent-container" style="min-height: calc(100vh - 70px); height:fit-auto; padding: 0 !important; display: flex; justify-content:center; position:relative;">
        <img class="manage-img"src=<?php echo e(asset('/images/forest-background.jpg')); ?> alt="">
        <div class="profile-container">
            <input type="checkbox" id="show-filter" class="show-filter">
            <div class="select-panel">
                <label for="show-filter">
                
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
                            <img src=<?php echo e(asset('/images/profile-picture.jpg')); ?> alt="">
                            <div class="account-delete">
                                <i class="fa fa-trash" aria-hidden="true" id="delete-modal-trigger"></i>
                            </div>
                        </div>
                        <div class="profile-theme">
                        </div>
                    </div>
                    <div class="bottom-row">
                        <div class="left-side">
                            <h3><?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?> <span>| <?php echo e(auth()->user()->id); ?></span></h3>
                            <h5><?php echo e(auth()->user()->email); ?></h5>
                        </div>
                        <div class="details-cont">
                            <div class="details-inner">
                                <div class="post-count">
                                    <?php
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
                                    ?>
                                    <div>
                                        <h1><?php echo e($listingCount != 0? $listingCount : 0); ?></h1>
                                        <h5>Listings</h5>
                                    </div>

                                    <div>
                                        <h1><?php echo e($rentalCount != 0? $rentalCount : 0); ?></h1>
                                        <h5>Rentals</h5>
                                    </div>

                                    <div>
                                        <h1><?php echo e($leaseCount != 0? $leaseCount : 0); ?></h1>
                                        <h5>Leases</h5>
                                    </div>
                                </div>
                                <div class="recent-messages">
                                    
                                </div>
                            </div>
                            <div class="my-address">
                                <form class="addressForm" action="/users/additionalInfo" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <h3 class="">Address</h3>
                                    <input type="text" name="street" placeholder="Street, nbr"  value="<?php echo e(auth()->user()->street); ?>" required/>
                                    <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    <input type="text" name = "city" placeholder="City"  value="<?php echo e(auth()->user()->city); ?>" required/>
                                    <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    <input type="text" name = "state" placeholder="State"  value="<?php echo e(auth()->user()->state); ?>" required/>
                                    <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    <input type="text" name = "country" placeholder="Country"  value="<?php echo e(auth()->user()->country); ?>" required/>
                                    <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    <input type="text" name = "postcode"placeholder="Postcode"  value="<?php echo e(auth()->user()->postcode); ?>" required />
                                    <?php $__errorArgs = ['postcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                    <input type="text" id="number" name="number" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required
                                    value="<?php echo e(auth()->user()->number); ?>" />
                                    <?php $__errorArgs = ['phoneNumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    
                                    <input type="submit" value="Update">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="delete-modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h1>Delete Account</h1>
                            <p>Are you sure you want to delete your account?</p>

                            <div class="clearfix">
                                <input type="button" class="button1" class="cancelbtn" id="cancelbtn" value="Cancel" />
                                <form action="/users/delete/<?php echo e(auth()->user()->id); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <input type="submit" class="deletebtn button1" value="Delete"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="myPosts-main">
                    <?php echo $__env->make('partials._cardGallary', ['listings' => $myListings, 'heading'=>'My Listings', 'displayTags' => false, 'displayMoreButton' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="favorites-main">
                    <?php echo $__env->make('partials._cardGallary', ['listings' => $likedList, 'heading'=>'Liked Items', 'displayTags' => false, 'displayMoreButton' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="watchList-main">
                    <div class="watchlist-header">
                        <h2>WatchList</h2>
                        <div class="create-watch-item" id="modal-trigger">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    <div class="watchitem-container">
                        <?php if(count($watchList) != 0): ?>
                            <?php $__currentLoopData = $watchList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $watchItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class='watchitem'>
                                <div class="watchitem-header">
                                    <div class="watchitem-heading-inner">
                                        <h3><?php echo e($watchItem->watchitem_title); ?></h3>
                                        <?php if($watchItem->type == "listing"): ?>
                                            <h5><span class="watchitem-listing"><?php echo e($watchItem->type); ?></span> | Match Rate:  <?php echo e($watchItem->match_rate); ?>%</h5>
                                        <?php elseif($watchItem->type == "rentable"): ?>
                                            <h5><span class="watchitem-rentable"><?php echo e($watchItem->type); ?></span> | Match Rate:  <?php echo e($watchItem->match_rate); ?>%</h5>
                                        <?php elseif($watchItem->type == 'lease'): ?>
                                            <h5><span class="watchitem-sublease"><?php echo e($watchItem->type); ?></span> | Match Rate:  <?php echo e($watchItem->match_rate); ?>%</h5>
                                        <?php endif; ?>
                                    </div>
                                    <div class="watchitem-crud">
                                        
                                        <form method="POST" action="/watchitems/<?php echo e($watchItem->id); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button><i class="fa fa-trash" ></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="tags-container">
                                    <?php
                                        $tags = explode(", ", $watchItem->key_tags);
                                        $matches = $watchItem->matches_found == null ? null : explode(', ', $watchItem->matches_found) ;
                                    ?>
                                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.listing-tags','data' => ['tags' => $tags]] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listing-tags'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tags' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tags)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                </div>
                                <div class="found-carousel">
                                    <div class="carousel" aria-label="carousel" Tabindex="0">
                                        <div class="slides">
                                            <?php if($watchItem->type == 'listing'): ?>
                                                <?php if( $matches != null): ?>
                                                    <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="slides-item" id="slide-1">
                                                            <?php
                                                        
                                                                $foundMatch = $listingProvider::getListingById($match);

                                                                $imgLinks = null;
                                                                if(isset($foundMatch->image_uploads)){
                                                                    $imgLinks = json_decode($foundMatch->image_uploads);
                                                                    if(is_array($imgLinks)){
                                                                        $imgLinks = $imgLinks[0];
                                                                    }
                                                                }

                                                                $hardLink=['/images/rotunda.jpg', '/images/old-cabell.jpg', '/images/cavalier-horse.jpg'];
                                                                $link = $hardLink[random_int(0, count($hardLink)-1)];
                                                            ?>
                                                            <?php if($foundMatch != null): ?>
                                                                <a href="/listings/<?php echo e($foundMatch->id); ?>">
                                                                    <img src=<?php echo e($foundMatch->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset($link)); ?>  alt="image doesnt exist">
                                                                </a>
                                                                <div class="slidesitem-details">
                                                                    <h1><?php echo e($foundMatch->item_name); ?></h1>
                                                                    <h3>$<?php echo e($foundMatch->price); ?></h3>
                                                                </div>

                                                                <div class="remove-recommendation">
                                                                    <form action="/remove_recommendation" method="POST" enctype="multipart/form-data">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="watchitem_id" value="<?php echo e($watchItem->id); ?>">
                                                                        <input type="hidden" name="recommendation_id" value="<?php echo e($match); ?>">
                                                                        <button type="submit"><i class="fa-solid fa-x"></i></button>
                                                                    </form>
                                                                </div> 
                                                                <?php if($foundMatch->status =='Available'): ?>
                                                                    <div class="status green">
                                                                    </div>
                                                                <?php elseif($foundMatch->status == "Pending"): ?>
                                                                    <div class="status yellow">
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="status ">
                                                                    </div>
                                                                <?php endif; ?> 
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <p>No matches found. Please stand by as we look for more!</p>
                                                <?php endif; ?>
                                            <?php elseif($watchItem->type == 'rentable'): ?>
                                                <?php if($matches != null): ?>
                                                    <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="slides-item" id="slide-1">
                                                            <?php
                                                                $foundMatch = $rentableProvider::getRentableById($match);

                                                                $imgLinks = null;
                                                                if(isset($foundMatch->image_uploads)){
                                                                    $imgLinks = json_decode($foundMatch->image_uploads);
                                                                    if(is_array($imgLinks)){
                                                                        $imgLinks = $imgLinks[0];
                                                                    }
                                                                }

                                                                $hardLink=['/images/rotunda.jpg', '/images/old-cabell.jpg', '/images/cavalier-horse.jpg'];
                                                                $link = $hardLink[random_int(0, count($hardLink)-1)];
                                                            ?>
                                                            <?php if($foundMatch != null): ?>
                                                                <a href="/rentables/<?php echo e($foundMatch->id); ?>">
                                                                    <img src=<?php echo e($foundMatch->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset($link)); ?>  alt="image doesnt exist">
                                                                </a>
                                                                <div class="slidesitem-details">
                                                                    <h1><?php echo e($foundMatch->rental_title); ?></h1>
                                                                    <h3>$<?php echo e($foundMatch->rental_charging); ?></h3>
                                                                </div>

                                                                <div class="remove-recommendation">
                                                                    <form action="/remove_recommendation" method="POST" enctype="multipart/form-data">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="watchitem_id" value="<?php echo e($watchItem->id); ?>">
                                                                        <input type="hidden" name="recommendation_id" value="<?php echo e($match); ?>">
                                                                        <button type="submit"><i class="fa-solid fa-x"></i></button>
                                                                    </form>
                                                                </div>  

                                                                
                                                                <?php if($foundMatch->status =='Available'): ?>
                                                                    <div class="status green">
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="status ">
                                                                    </div>
                                                                <?php endif; ?> 
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <p>No matches found. Please stand by as we look for more!</p>
                                                <?php endif; ?>
                                            <?php elseif($watchItem->type == 'lease'): ?>
                                                 <?php if($matches != null): ?>
                                                    <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="slides-item" id="slide-1">
                                                            <?php
                                                                $foundMatch = $subleaseProvider::getSubleaseById($match);

                                                                $imgLinks = null;
                                                                if(isset($foundMatch->image_uploads)){
                                                                    $imgLinks = json_decode($foundMatch->image_uploads);
                                                                    if(is_array($imgLinks)){
                                                                        $imgLinks = $imgLinks[0];
                                                                    }
                                                                }

                                                                $hardLink=['/images/rotunda.jpg', '/images/old-cabell.jpg', '/images/cavalier-horse.jpg'];
                                                                $link = $hardLink[random_int(0, count($hardLink)-1)];
                                                            ?>
                                                            <?php if($foundMatch != null): ?>
                                                                <a href="/subleases/<?php echo e($foundMatch->id); ?>">
                                                                    <img src=<?php echo e($foundMatch->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset($link)); ?>  alt="image doesnt exist">
                                                                </a>
                                                                <div class="slidesitem-details">
                                                                    <h1><?php echo e($foundMatch->sublease_title); ?></h1>
                                                                    <h3>$<?php echo e($foundMatch->rent); ?> /Month</h3>
                                                                </div>

                                                                <div class="remove-recommendation">
                                                                    <form action="/remove_recommendation" method="POST" enctype="multipart/form-data">
                                                                        <?php echo csrf_field(); ?>
                                                                        <input type="hidden" name="watchitem_id" value="<?php echo e($watchItem->id); ?>">
                                                                        <input type="hidden" name="recommendation_id" value="<?php echo e($match); ?>">
                                                                        <button type="submit"><i class="fa-solid fa-x"></i></button>
                                                                    </form>
                                                                </div>  
                                                                <?php if($foundMatch->status =='Available'): ?>
                                                                    <div class="status green">
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="status ">
                                                                    </div>
                                                                <?php endif; ?> 
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <p>No matches found. Please stand by as we look for more!</p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>  
                                    </div>
                                </div>
                                
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            
                            <h3>Create New Watch Item</h3>
                            <p>All tags entered below will be cross checked with with the respective fields of the type selected.</p>
                            <form action="/users/manage/createWatchItem" class="watchlist-form" id="watchlist-form" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="user_id"
                                value=<?php echo e(auth()->user()->id); ?>>
                                <input type="text" placeholder="Title" name="watchitem_title" required>
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
                                            
                                            
                                            
                                            
                                            
                                            <option value="100" selected>100%</option>
                                        </select>
                                    </div>
                                    <div class="right">
                                        <input type="text" placeholder="Press Enter to Add Tag Word"  onkeydown="search(this)" class="input">
                                        <input type="submit" value="Create" class="submit-form">
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
            for (let i = 0; i < myElement.children.length; i++) {
                if(i == id){
                    myElement.children[i].style.display = 'flex';
                }else{
                    myElement.children[i].style.display = 'none';
                }
            }
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


        // create watch item modal popup 
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("modal-trigger");
        var span = document.getElementsByClassName("close")[1];
        btn.onclick = function() {
            modal.style.display = "grid";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == deleteModal) {
                deleteModal.style.display = "none";
            }
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


        // preventing form submit on enter when entering watch list item tags
        document.getElementById("watchlist-form").onkeypress = function(e) {
            var key = e.charCode || e.keyCode || 0;     
            if (key == 13) {
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/users/manage.blade.php ENDPATH**/ ?>