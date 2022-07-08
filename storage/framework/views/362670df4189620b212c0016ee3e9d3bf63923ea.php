

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>College Marketplace</title>
        
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
        

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

         
        <link rel="stylesheet" types ="text/css" href="/css/navigation.css" />
        
        <link rel="stylesheet" types ="text/css" href="/css/carousel.css">
        
        <link rel="stylesheet" types ="text/css" href="/css/styles.css" />
        
        <link rel="stylesheet" types="text/css" href="/css/footer.css">
        
        <link rel="stylesheet" types="text/css" href="/css/listingGallary.css">
        
        

        
        <link rel="stylesheet" type="text/css" href="/css/listing.css">
        
        <link rel="stylesheet" type="text/css" href="/css/loginSignup.css">
        
    </head>
    <body>
        <header>
            
            <?php echo $__env->make('partials._navigationBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </header>

        
        <?php echo $__env->yieldContent('content'); ?>
        
        
        <?php echo $__env->make('partials._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </body>
</html>
<?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/layout.blade.php ENDPATH**/ ?>