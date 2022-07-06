

<?php $__env->startSection('content'); ?>
    <section class = "product-details-container">
        <div class = "card-wrapper-selected">
            <div class = "card-selected">
                <div class="back-button">
                    <a href="/" class="button1">
                        <i class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
                <div class = "track">
                    <h5>Home > Clothes > Pants > Ripped Jeans</h5>
                </div>
                <!-- card left -->
                <div class="selected-row">
                    <div class = "product-imgs">
                        <div class = "img-display">
                        </div>
                        <div class = "img-showcase">
                                <img src = "shoes_images/shoe_1.jpg" alt = "shoe image">
                                <img src = "shoes_images/shoe_2.jpg" alt = "shoe image">
                                <img src = "shoes_images/shoe_3.jpg" alt = "shoe image">
                                <img src = "shoes_images/shoe_4.jpg" alt = "shoe image">
                                <img src = "shoes_images/shoe_4.jpg" alt = "shoe image">
                        </div>
                    </div>
                    <!-- card right -->
                    <div class = "product-content">

                        
                        <h1><?php echo e($listing->item_name); ?></h1>

                        
                        <div class = "product-details">
                            <h3>$<?php echo e($listing->price); ?> | <?php echo e($listing->city); ?>, <?php echo e($listing->state); ?></h3>
                            <h5>Item Negotiable: <?php echo e($listing->negotiable); ?> | <?php echo e($listing->condition); ?> | <?php echo e($listing->category); ?></h5>
                        </div>
                        
                        <div class = "product-description">
                            <h4>Item Description:</h4>
                            <p><?php echo e($listing->description); ?></p>
                        </div>

                        <div class = "product-buttons-container">
                            <a href="#" class="button1 bouncy">Save to Favorites</a>
                            
                        </div>

                        <div class = "tags-container">
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.listing-tags','data' => ['listingTags' => $listing->tags]] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('listing-tags'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listingTags' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing->tags)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
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
                    <h1>Chatbox feature to chat with seller</h1>
                </div>
            </div> 
        </div>
    </section>
    
    <section class = "listings-parent-container">
        
        <?php echo $__env->make('partials._listingCarousel', ['listings' => $listings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/listing.blade.php ENDPATH**/ ?>