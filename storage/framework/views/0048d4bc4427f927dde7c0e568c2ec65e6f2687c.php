<?php foreach($attributes->onlyProps(['listing', 'rentable', 'sublease']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['listing', 'rentable', 'sublease']); ?>
<?php foreach (array_filter((['listing', 'rentable', 'sublease']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div>
    
    <?php if($listing != null): ?>
        <div <?php echo e($attributes->merge(['class'=> 'slide single-post-cont'])); ?>>
            
            
            <div class="slide-img">
                
                <?php if($listing->status =='Available'): ?>
                    <div class="status green">
                    </div>
                <?php elseif($listing->status=='Pending'): ?>
                    <div class="status yellow">
                    </div>
                <?php else: ?>
                    <div class="status">
                    </div>
                <?php endif; ?>
                <a href="/listings/<?php echo e($listing->id); ?>">
                    <?php
                        /*function debug_to_console($data) {
                                    $output = $data;
                                    if (is_array($output))
                                    $output = implode(',', $output);
                                    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
                        }*/ 
                    $imgLinks = null;
                        if(isset($listing->image_uploads)){
                            //decode the json object
                            $imgLinks = json_decode($listing->image_uploads);
                            if(is_array($imgLinks)){
                                $imgLinks = $imgLinks[0];
                                //echo Storage::disk('s3')->url('listings/'.$imgLinks);
                                //echo $imgLinks;
                                //debug_to_console($imgLinks);
                            }
                        }
                    ?>
                    
                    <?php
                        $hardLink=['/images/rotunda.jpg', '/images/old-cabell.jpg', '/images/cavalier-horse.jpg'];
                        $link = $hardLink[random_int(0, count($hardLink)-1)];
                    ?>
                    <img src=<?php echo e($listing->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset($link)); ?>  alt="image doesnt exist">
                </a>
            </div>
            
            <div class = "listing-details">
                <a href="/listings/<?php echo e($listing->id); ?>"><?php echo e($listing->item_name); ?></a>
                <h4>$<?php echo e($listing->price); ?></h4>
                <h5><?php echo e($listing->city); ?>, <?php echo e($listing->state); ?></h5>
                
            </div>
            <div class="listing-type">
                <h5>For Sale</h5>
            </div>
        </div>
    
    <?php elseif($rentable != null): ?>
        <div <?php echo e($attributes->merge(['class'=> 'slide single-post-cont '])); ?>>
            
            
            <div class="slide-img">
                    
                <?php if($rentable->status =='Available'): ?>
                    <div class="status green">
                    </div>
                <?php else: ?>
                    <div class="status">
                    </div>
                <?php endif; ?>
                <a href="/rentables/<?php echo e($rentable->id); ?>">
                    <?php
                    $imgLinks = null;
                        if(isset($rentable->image_uploads)){
                            //decode the json object
                            $imgLinks = json_decode($rentable->image_uploads);
                            if(is_array($imgLinks)){
                                $imgLinks = $imgLinks[0];
                            }
                        }
                    ?>
                    
                    <?php
                        $hardLink=['/images/rotunda.jpg', '/images/old-cabell.jpg', '/images/cavalier-horse.jpg'];
                        $link = $hardLink[random_int(0, count($hardLink)-1)];
                    ?>
                    <img src=<?php echo e($rentable->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset($link)); ?>  alt="image doesnt exist">
                </a>
            </div>
            
            <div class = "listing-details">
                <a href="/rentables/<?php echo e($rentable->id); ?>"><?php echo e($rentable->rental_title); ?></a>
                <h4>$<?php echo e($rentable->rental_charging); ?> / <?php echo e($rentable->rental_duration); ?></h4>
                <h5><?php echo e($rentable->city); ?>, <?php echo e($rentable->state); ?></h5> 
            </div>
            <div class="rentable-type">
                <h5>For Rent</h5>
            </div>
        </div>
    <?php else: ?>
         <div <?php echo e($attributes->merge(['class'=> 'slide single-post-cont '])); ?>>
            
            
            <div class="slide-img">
                <?php if($sublease->status =='Available'): ?>
                    <div class="status green">
                    </div>
                <?php else: ?>
                    <div class="status">
                    </div>
                <?php endif; ?>
                <a href="/subleases/<?php echo e($sublease->id); ?>">
                    <?php
                    $imgLinks = null;
                        if(isset($sublease->image_uploads)){
                            //decode the json object
                            $imgLinks = json_decode($sublease->image_uploads);
                            if(is_array($imgLinks)){
                                $imgLinks = $imgLinks[0];
                            }
                        }
                    ?>
                    
                    <?php
                        $hardLink=['/images/rotunda.jpg', '/images/old-cabell.jpg', '/images/cavalier-horse.jpg'];
                        $link = $hardLink[random_int(0, count($hardLink)-1)];
                    ?>
                    <img src=<?php echo e($sublease->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset($link)); ?>  alt="image doesnt exist">
                </a>
            </div>
            
            <div class = "listing-details">
                <a href="/subleases/<?php echo e($sublease->id); ?>"><?php echo e($sublease->sublease_title); ?></a>
                <h4>$<?php echo e($sublease->rent); ?> / Mo | <?php echo e($sublease->negotiable); ?></h4>
                <h5><?php echo e($sublease->location); ?></h5> 
            </div>
            <div class="lease-type">
                <h5>For Lease</h5>
            </div>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\COLLEGE_MARKETPLACE\resources\views/components/carousel-card.blade.php ENDPATH**/ ?>