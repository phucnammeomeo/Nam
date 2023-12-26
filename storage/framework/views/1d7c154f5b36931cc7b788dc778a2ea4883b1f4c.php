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

<?php $__env->startPush('css'); ?>

    <style type="text/css">

        .banner img{
            width: 995px;
            height: 350px;
            object-fit: inherit;
        }

    </style>

<?php $__env->stopPush(); ?>
<?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/homepage/common/slide.blade.php ENDPATH**/ ?>