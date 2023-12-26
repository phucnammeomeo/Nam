<?php $__env->startSection('content'); ?>

    <div class="container mx-auto overflow-hidden mt-[20px] ">
        <div class="flex flex-wrap justify-center">
            <div class="w-full px-[10px]">
                <div class=" bg-white py-[10px]  relative inline-block w-full overflow-hidden">
                    <div class="icon absolute top-0 left-0 bg-white  z-10">
                        <img src="<?php echo e(asset('frontend/img/icon-5.gif')); ?>" alt="Icon" style="width: 50px; "
                             class="inline-block float-left mr-[10px] ">
                    </div>
                    <div class="marquee_text">
                        <div class="content-marquee_text">
                            <p class="flex flex-wrap items-center text-f16 font-bold"><?php echo e($fcSystem['homepage_marquee']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-3">
        <?php if( $productHome ): ?>
            <?php $__currentLoopData = $productHome; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if( !$val->data->isEmpty() ): ?>
                    <div class="content-product mt-[30px] ">
                        <div class="title-title p-[10px] text-f18">
                            <a href="<?php echo e(route( 'routerURL', ['slug' => $val->slug] )); ?>" class=" font-bold"><?php echo e($val->title); ?></a>
                        </div>
                        <div class="bg-white">
                            <div class="flex flex-wrap justify-center mx-[-10px] render-data">
                                <?php $__currentLoopData = $val->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyC => $valC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="w-1/2 md:w-1/4 lg:w-1/5 px-[10px]">
                                    <?php echo htmlItemProduct($valC, checkProductIncart($valC->id, $cart['cart'])); ?>

                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php if( count($val->data) == 10 ): ?>
                                <div class="readmore text-center inline-block w-full mt-[10px] mb-[20px]">
                                    <a href="javascript:void(0)" data-id="<?php echo e($val->id); ?>" data-count="10" data-limit="10" class="load-more-product border border-Pimary_color py-[8px] px-[25px] rounded-[5px] text-Pimary_color hover:bg-Pimary_color hover:text-white transition-all">
                                        Xem thêm<i class="fa-solid fa-angles-right text-f12 ml-[5px]"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

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
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sportshop\resources\views/homepage/home/index.blade.php ENDPATH**/ ?>