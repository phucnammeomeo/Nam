<?php
$partners = getSlide('partners');
?>
<?php if( $partners ): ?>
    <div class="partner-section p-[10px] bg-white mt-[20px]">
        <div class="title-title p-[10px] text-f20 text-center uppercase">
            <a href="javascript:void(0)" class=" font-bold"><?php echo e($partners->title); ?></a>
        </div>
        <div class="content-partner-section mt-[20px]">
            <div class="owl-carousel slider-partner-2">
                <?php $__currentLoopData = $partners->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $valC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <a href="<?php echo e($valC->slug!=''?url($valC->slug):'javascript:void(0)'); ?>"><img src="<?php echo e($valC->src); ?>" alt="<?php echo e($valC->title); ?>"></a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH /home/khangdien3/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/partner.blade.php ENDPATH**/ ?>