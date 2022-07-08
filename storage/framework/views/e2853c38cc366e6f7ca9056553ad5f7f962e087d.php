



<?php $__env->startSection('content'); ?>
    
    <?php echo $__env->make('partials._hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <main class = "main-listings-container">
        <div class = "listings-parent-container">
            <?php echo $__env->make('partials._listingCarousel', ['listings' => $listings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        
            

        <div class = "listings-parent-container">
            <?php echo $__env->make('partials._cardGallary', ['listings' => $listings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        
    </main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/listings.blade.php ENDPATH**/ ?>