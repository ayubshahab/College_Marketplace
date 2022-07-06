
<link rel="stylesheet" types='text/css' href="/css/yardSales.css">
<div class="container">
    <section class="yard-sale-wrapper">
        <div class = "yard-sale-info">
            <h1>See what other students are  selling & even <span>host your own!</span></h1>
            <br>
            <h3>What better way to find hidden treasures than attending a Yard Sale!</h3>

            <div class = "yard-sales-buttons" style="position: relative; z-index:10;">
                <a href="/yardsales/create" class="host button1 bouncy">Host Yard Sale</a>
                <a href="#" class="find button1 bouncy">Find Yard Sales</a>
            </div>
        </div>
        <div class = "yard-sale-cont">
            <h1>Yard Sales Near Me:</h1>
            <?php if(count($yardSales) > 0): ?>
            
                <?php $__currentLoopData = $yardSales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yardSale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/yardsales/<?php echo e($yardSale->id); ?>">
                        <div class="mySlides">
                            
                            <?php
                                if(isset($yardSale->image_uploads)){
                                    //decode the json object
                                    $imgLinks = json_decode($yardSale->image_uploads);
                                    $titleImage = null;
                                    if(is_array($imgLinks)){
                                        $titleImage = $imgLinks[0];
                                    }
                                }
                            ?>
                            <div class="yard-header-img">
                                <div class="numbertext"><?php echo e($yardSale->yard_sale_title); ?></div>
                                <img src=<?php echo e($yardSale->image_uploads ? asset('storage/'.$titleImage) : asset('/images/rotunda.jpg')); ?> id = "expandedImg" alt="image doesnt exist"
                                href="/yardsales/<?php echo e($yardSale->id); ?>">
                            </div>
                            <div class='stackable-images'>
                                <?php if(is_array($imgLinks)): ?>
                                    <?php if(isset($imgLinks[1])): ?>
                                        <img src=<?php echo e($yardSale->image_uploads ? asset('storage/'.$imgLinks[1]) : asset('/images/rotunda.jpg')); ?> id = "expandedImg" alt="image doesnt exist">
                                    <?php else: ?>
                                        <img src=<?php echo e(asset('/images/old-cabell.jpg')); ?> id = "expandedImg" alt="image doesnt exist">
                                    <?php endif; ?>
                                    <?php if(isset($imgLinks[2])): ?>
                                        <img src=<?php echo e($yardSale->image_uploads ? asset('storage/'.$imgLinks[2]) : asset('/images/rotunda.jpg')); ?> id = "expandedImg" alt="image doesnt exist">
                                    <?php else: ?>
                                        <img src=<?php echo e(asset('/images/cavalier-horse.jpg')); ?> id = "expandedImg" alt="image doesnt exist">
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
            <?php else: ?>
                <div class="mySlides">
                    
                    <div class="yard-header-img">
                        <img src="/images/rotunda.jpg" alt="">
                         <div class="no-yard-sales">
                            <h1>There are currently no yard sales nearby!</h1>
                            <h4>Make one to get started!</h4>
                        </div>
                    </div>
                    <div class="stackable-images">
                        <img src="/images/old-cabell.jpg" alt="">
                        <img src="/images/cavalier-horse.jpg" alt="">
                    </div>
                </div>
            <?php endif; ?>
            <!-- Next and previous buttons -->
            <a class="prevB" onclick="plusSlides(-1)">&#10094;</a>
            <a class="nextB" onclick="plusSlides(1)">&#10095;</a>
        </div>
    </section>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        let captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "flex";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
        }
    </script>
</div>  

<?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/partials/_yardSales.blade.php ENDPATH**/ ?>