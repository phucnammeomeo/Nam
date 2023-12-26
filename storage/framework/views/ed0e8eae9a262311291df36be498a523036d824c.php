<?php

$footerUp = getSlide('footer-up');

?>

<?php if( $footerUp ): ?>

    <div class="icon-box-content border-t-[3px] border-Pimary_color mt-[20px] md:mt-[50px] py-[30px]">

        <div class="container mx-auto px-3">

            <div class="flex flex-wrap justify-center mx-[-10px]">

                <?php $__currentLoopData = $footerUp->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="w-1/2 md:w-1/4 px-[10px]">

                        <div class="item text-center mb-[10px] md:mb-0">

                            <a href="<?php echo e($val->link!=''?url($val->link):'javacript:void(0)'); ?>">

                                <div class="icon">

                                    <img src="<?php echo e(asset($val->src)); ?>" alt="<?php echo e($val->title); ?>" class="inline-block">

                                </div>

                                <h3 class="title-2 mt-[10px]"><?php echo e($val->title); ?></h3>

                            </a>

                        </div>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </div>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\khangdien\resources\views/homepage/common/footerup.blade.php ENDPATH**/ ?>