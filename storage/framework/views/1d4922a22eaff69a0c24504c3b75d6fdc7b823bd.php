


 
<link rel="stylesheet" types="text/css" href="/css/listingGallary.css">
<section class="container" style="border: none !important"> 
    <div class="subcontainer">
        <div class="controller">
            <h2><?php echo e($heading); ?></h2>
        </div>
    
        
        <ul class="cards">
            <?php if (! (count($listings) == 0)): ?>
                <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.gallery-card','data' => ['listing' => $listing,'displayTags' => $displayTags]] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('gallery-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing),'displayTags' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($displayTags)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="empty-gallary-message">NO Listings Found!</p>
            <?php endif; ?>
            
        </ul>
        
        <div class="pagination-container">
            <?php if($listings instanceof \Illuminate\Pagination\Paginator ||
            $listings instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                
                <?php if($listings->currentPage() > 1): ?>
                    
                    <a class="button1 paginate-previous" href="<?php echo e($listings->appends(request()->query())->previousPageUrl()); ?>">Previous</a>
                <?php elseif($listings->hasPages()): ?>
                    
                    <a class="button1 paginate-previous">First Page</a>
                <?php endif; ?>
                <?php if($listings->hasMorePages()): ?>
                    
                    <a class="button1 paginate-next" href="<?php echo e($listings->appends(request()->query())->nextPageUrl()); ?>">Next</a>
                <?php elseif($listings->hasPages()): ?>
                    
                    <a class ="button1 paginate-next" >Last Page</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/partials/_cardGallary.blade.php ENDPATH**/ ?>