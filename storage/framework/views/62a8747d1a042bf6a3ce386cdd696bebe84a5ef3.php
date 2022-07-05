<?php foreach($attributes->onlyProps(['listing', 'displayTags']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['listing', 'displayTags']); ?>
<?php foreach (array_filter((['listing', 'displayTags']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<li class="cards_item" data-aos="zoom-in" data-aos-once="true">
    <div class="card-type">
        <div class="card-type-inner">
            <?php if($listing instanceof \App\Models\Listing): ?>
                <h5>For Sale</h5>
            <?php elseif($listing instanceof \App\Models\Rentable): ?>
                <h5>For Rent</h5>
            <?php else: ?>
                <h5>For Lease</h5>
            <?php endif; ?>
        </div>
    </div>
    <div class="card"> 
        <div class="card_image">
            <?php if($listing instanceof \App\Models\Listing): ?>
            
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
                        $imgLinks = null;
                        if(isset($listing->image_uploads)){
                            $imgLinks = json_decode($listing->image_uploads);
                            if(is_array($imgLinks)){
                                $imgLinks = $imgLinks[0];
                                if(file_exists(public_path('storage/'.$imgLinks))){
                                    $imgLinks = "storage/".$imgLinks;
                                }else{
                                    $imgLinks = "/images/rotunda.jpg";
                                }
                            }else{
                                 $imgLinks = "/images/rotunda.jpg";
                            }
                        }else{
                            $imgLinks = "/images/rotunda.jpg";
                        }
                    ?>
                    
                    <img src=<?php echo e(asset($imgLinks)); ?>  alt="title image">
                </a>
            <?php elseif($listing instanceof \App\Models\Rentable): ?>
            
                <?php if($listing->status =='Available'): ?>
                    <div class="status green">
                    </div>
                <?php else: ?>
                    <div class="status">
                    </div>
                <?php endif; ?>
                <a href="/rentables/<?php echo e($listing->id); ?>">
                    <?php
                    $imgLinks = null;
                        if(isset($listing->image_uploads)){
                            $imgLinks = json_decode($listing->image_uploads);
                            if(is_array($imgLinks)){
                                $imgLinks = $imgLinks[0];
                            }
                        }
                    ?>
                    <img src=<?php echo e($listing->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset('/images/rotunda.jpg')); ?>  alt="image doesnt exist">
                </a>
            <?php else: ?>
                
                <?php if($listing->status =='Available'): ?>
                    <div class="status green">
                    </div>
                <?php else: ?>
                    <div class="status">
                    </div>
                <?php endif; ?>
                <a href="/subleases/<?php echo e($listing->id); ?>">
                    <?php
                    $imgLinks = null;
                        if(isset($listing->image_uploads)){
                            $imgLinks = json_decode($listing->image_uploads);
                            if(is_array($imgLinks)){
                                $imgLinks = $imgLinks[0];
                            }
                        }
                    ?>
                    <img src=<?php echo e($listing->image_uploads ? Storage::disk('s3')->url($imgLinks) : asset('/images/rotunda.jpg')); ?>  alt="image doesnt exist">
                </a>
            <?php endif; ?>
        </div>
        <div class="card_content">
            <?php if($listing instanceof \App\Models\Listing): ?>
                <a href="/listings/<?php echo e($listing->id); ?>">
                <h1 class="card_title"><?php echo e($listing->item_name); ?></h1>
                </a>
                <h4>$<?php echo e($listing->price); ?></h4>
                <h4 class="card_text"><?php echo e($listing->city); ?>, <?php echo e($listing->state); ?></h4>
                <div class="listing-tags">
                    <?php if($displayTags): ?>
                        <?php
                            $tags = explode(", ", $listing->tags);
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
                    <?php endif; ?>
                </div>
            <?php elseif($listing instanceof \App\Models\Rentable): ?>
                <a href="/rentables/<?php echo e($listing->id); ?>">
                <h1 class="card_title"><?php echo e($listing->rental_title); ?></h1>
                </a>
                <h4>$<?php echo e($listing->rental_charging); ?> / <?php echo e($listing->rental_duration); ?></h4>
                <h4 class="card_text"><?php echo e($listing->city); ?>, <?php echo e($listing->state); ?></h4>
                <div class="listing-tags">
                    <?php if($displayTags): ?>
                        <?php
                            $tags = explode(", ", $listing->tags);
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
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <a href="/subleases/<?php echo e($listing->id); ?>">
                <h1 class="card_title"><?php echo e($listing->sublease_title); ?></h1>
                </a>
                <h4>$<?php echo e($listing->rent); ?> | <?php echo e($listing->negotiable); ?></h4>
                <h4 class="card_text"><?php echo e($listing->city); ?>, <?php echo e($listing->state); ?></h4>
                <div class="listing-tags">
                    <?php if($displayTags): ?>
                        <?php
                            $tags = explode(", ", $listing->tags);
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
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div> 
    </div>
</li><?php /**PATH C:\xampp\htdocs\COLLEGE_MARKETPLACE\resources\views/components/gallery-card.blade.php ENDPATH**/ ?>