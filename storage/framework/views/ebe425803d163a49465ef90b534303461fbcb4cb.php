<?php if(session()->has('message')): ?>
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="flash-message">
        <p>
            <?php echo e(session('message')); ?>

        </p>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\College_Marketplace\resources\views/components/flash-message.blade.php ENDPATH**/ ?>