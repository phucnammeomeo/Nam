<?php if($slideHome && count($slideHome->slides) > 0): ?>
<div class="w-full lg:w-4/5 px-0 md:px-[5px]">
    <div class="content-right">
        <div class="banner">
            <div class="slider-home owl-carousel">
                <?php $__currentLoopData = $slideHome->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <a href="<?php echo e($slide->link); ?>"><img src="<?php echo e(asset($slide->src)); ?>" alt="<?php echo e($slide->title); ?>" /></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<div class="w-1/5 px-[5px]" style="display: none">
    <div class="ads-right-1">
        <div class="img hover-zoom">
            <a href=""><img src="img/ads-1.png" alt=""/></a>
        </div>
        <div class="img hover-zoom">
            <a href=""><img src="img/ads-2.png" alt=""/></a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH /home/vuong/domains/vuong.tamphat.edu.vn/public_html/resources/views/homepage/common/slide.blade.php ENDPATH**/ ?>