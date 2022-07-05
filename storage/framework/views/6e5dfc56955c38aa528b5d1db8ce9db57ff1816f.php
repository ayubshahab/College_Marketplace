<?php foreach($attributes->onlyProps(['tags']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['tags']); ?>
<?php foreach (array_filter((['tags']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<ul class = "unordered-tags-list">
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="tags-list-item">
            <a href="/shop/all?tag=<?php echo e($tag); ?>">
                <?php echo e($tag); ?>

            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul> <?php /**PATH C:\xampp\htdocs\COLLEGE_MARKETPLACE\resources\views/components/listing-tags.blade.php ENDPATH**/ ?>