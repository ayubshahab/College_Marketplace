




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
                    <a href="/" class="button1">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                </div> 
                <div class = "track">
                    <h5>Home > YardSales > <?php echo e($yardsale->id); ?></h5>
                </div>
                <!-- card left -->
                <div class="selected-row">
                    <div class = "product-imgs">
                        <div class = "img-display">
                            <?php
                                if(isset($yardsale->image_uploads)){
                                    //decode the json object
                                    $imgLinks = json_decode($yardsale->image_uploads);
                                    $titleImage = null;
                                    if(is_array($imgLinks)){
                                        $titleImage = $imgLinks[0];
                                    }
                                }
                            ?>
                            <img src=<?php echo e($yardsale->image_uploads ? asset('storage/'.$titleImage) : asset('/images/rotunda.jpg')); ?> id = "expandedImg" alt="image doesnt exist">
                        </div>
                        <div style="z-index:10;">
                            <ul class="img-list">
                                 <?php if(is_array(json_decode($yardsale->image_uploads))): ?>
                                    <?php $__currentLoopData = json_decode($yardsale->image_uploads); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <img src=<?php echo e($yardsale->image_uploads ? asset('storage/'.$link) : asset('/images/rotunda.jpg')); ?> alt = "shoe image" onclick="myFunction(this);">
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?> 
                            </ul>
                        </div>
                    </div>
                    <!-- card right -->
                    <div class = "product-content">

                        
                        <div class="show-top">
                            <h1><?php echo e($yardsale->yard_sale_title); ?></h1>

                                
                                <div class = "product-details">
                                    <?php
                                        $startTime = new DateTime($yardsale->yard_sale_date . " " . $yardsale->start_time);
                                        $endTime = new DateTime($yardsale->yard_sale_date . " " . $yardsale->end_time);
                                    ?>
                                    <h4>
                                        Date: <?php echo e($yardsale->yard_sale_date); ?> | From: <?php echo $startTime->format('g:iA')  ?> 
                                        To: <?php echo $endTime->format('g:iA')  ?>
                                    </h4>
                                </div>
                                
                        </div>
                        <div class = "show-top product-description">
                            <h4 class="spacer">YardSale Description:</h4>
                            <p><?php echo e($yardsale->description); ?></p>
                        </div>
                        <div class="show-top">
                            <?php
                                $categories = explode(", ", $yardsale->category);
                            ?>
                            <h4 class="spacer">Categories</h4>
                            <div class="categories">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="/category=<?php echo e($category); ?>"><?php echo e($category); ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div> 
                        </div> 
                        <div class = "product-buttons-container show-top">
                            <?php if(!auth()->guest()): ?>
                            <span>
                                <a href="#" class="button1 bouncy">Add to Favorites</a>
                            </span>
                            <?php endif; ?>
                            <?php if($yardsale->user_id == $currentUser): ?>
                                <span>
                                    <a href="/yardsale/<?php echo e($yardsale->id); ?>/edit" class="button1">Edit Yard Sale</a>
                                </span>
                                <span>
                                        <form method="POST" action="/yardsale/<?php echo e($yardsale->id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button class="button1 delete-button">Delete</button>
                                    </form>
                                </span>
                            <?php endif; ?>
                        </div>

                        
                    </div>
                </div>
            </div>

            
            <div class="map-chat-container">
                <div class="map-container">
                    <h1>Maps feature</h1>
                </div>
                <div class="chat-container">
                    <h1><?php echo count({{$allUsers}})?></h1>
                </div>
            </div> 
        </div>
    </section>
    
    <section class = "listings-parent-container">
         <?php echo $__env->make('partials._listingCarousel', ['listings' => $listings, 'message' => 'Other Related Items', 'carouselClass'=>'','carouselControls' => 'controls', 'carouselP' =>'previous previous1', 'carouselN' => 'next next1'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
    <script>
        function myFunction(imgs) {
            var expandImg = document.getElementById("expandedImg");
            expandImg.src = imgs.src;
            }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/yardsales/show.blade.php ENDPATH**/ ?>