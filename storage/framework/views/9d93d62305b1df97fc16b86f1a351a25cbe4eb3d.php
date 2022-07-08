
<link rel="stylesheet" types ="text/css" href="/css/carousel.css">

<section id="slider">
    <div class="container">
        <div class="subcontainer">
            <div class="slider-wrapper">
                <div id="<?php echo e($carouselControls); ?>">
                        <button class = "<?php echo e($carouselP); ?>">
                            <i   class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class = "<?php echo e($carouselN); ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                <div class="controller">
                    <div> 
                        <h2><?php echo e($message); ?>: <?php echo count($listings) ?></h2>
                    </div>
                </div>
                <br>
                <div class="my-slider <?php echo e($carouselClass); ?>">
                    <?php if (! (count($listings) == 0)): ?>
                        <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.carousel-card','data' => ['listing' => $listing]] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('carousel-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['listing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($listing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php else: ?>
                            <p>No Listings Found!</p>
                        <?php endif; ?>
                      
                </div>
            </div>
        </div>
    </div>
    <script>

        tns({
            container: ".my-slider",
            "slideBy":1,
            "speed":400,
            "nav":false,
            controlsContainer:"#controls",
            prevButton:".previous1",
            nextButton:".next1",
            responsive:{
                1500:{
                    items: 5,
                    gutter: 5
                },
                1200:{
                    items: 4,
                    gutter: 10
                },
                // 1100:{
                //     items: 3,
                //     gutter: 15
                // },
                1024:{
                    items: 3,
                    gutter: 15
                },
                768:{
                    items: 2,
                    gutter: 20
                },
                480:{
                    items: 1
                }
            }
        })

    </script>
</section><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/partials/_listingCarousel.blade.php ENDPATH**/ ?>