




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
   
    
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/subleases/show.blade.php ENDPATH**/ ?>