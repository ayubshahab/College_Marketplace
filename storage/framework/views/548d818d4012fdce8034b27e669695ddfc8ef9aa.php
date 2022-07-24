



<link rel="stylesheet" types="text/css" href="/css/footer.css">

<footer>
    <div class = "footer-container">
      <div class = "row">
        <div class="col">
          <img src="" alt="" class = "footer-logo">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt corrupti esse sed culpa omnis voluptatibus facere maiores eveniet repudiandae ducimus?</p>
        </div>
        <div class="col">
          <h3>Office <div class="underline"><span></span></div></h3>
          <p>Street Address</p>
          <p>City, State</p>
          <p>Country, Postcode</p>
          <p class="email-id">as9qp@gmail.com </p>
          <p>Cell: 999-999-9999</p>
        </div>
        <div class="col ">
          <h3>Links <div class="underline"><span></span></div></h3>
          <li class = "footer-links">
            <a href="">Home</a>
          </li>
          
          
          <li class = "footer-links"><a href="/features">Features</a></li>
          <?php if(auth()->guard()->guest()): ?>
            <li class = "footer-links"><a href="/login">Login</a></li>
          <?php endif; ?>
          <?php if(auth()->guard()->check()): ?>
            <li class = "footer-links"><a href="<?php echo e(Request::fullUrl()); ?>">Login</a></li>  
          <?php endif; ?>
        </div>
        <div class="col">
          <h3>Newsletter <div class="underline"><span></span></div></h3>
          <form action="/newsletter" method="POST" class="newsletter-form">
            <?php echo csrf_field(); ?>
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name = "email" placeholder="Enter your email id" required>
            <button type="submit">
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </form>
          <div class="social-icons">
              <a href=""><i class="fa-brands fa-facebook-f"></i></a>
              <a href=""><i class="fa-brands fa-twitter"></i></a>
              <a href=""><i class="fa-brands fa-discord"></i></a>
              <a href=""><i class="fa-brands fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <hr>
      <p class="copyright"> College Marketplace © 2022 - All Rights Reserved</p>
    </div>
</footer><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/partials/_footer.blade.php ENDPATH**/ ?>