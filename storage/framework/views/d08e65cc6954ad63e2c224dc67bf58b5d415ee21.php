<?php if($slideHome && count($slideHome->slides) > 0): ?>
<div class="banner">

    <div class="slider-home owl-carousel">
        <?php $__currentLoopData = $slideHome->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $title = explode('-', $slide->title); ?>
            <div class="item">
                <a href=""><img src="<?php echo e(asset($slide->src)); ?>" alt="<?php echo e($slide->title); ?>" /></a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>
<?php endif; ?>
<?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/slide.blade.php ENDPATH**/ ?>