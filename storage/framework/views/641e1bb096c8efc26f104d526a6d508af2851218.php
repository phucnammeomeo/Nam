<?php $__env->startSection('content'); ?>
    <?php $cart = Session::get('cart'); ?>
    
    <div class="container mx-auto px-0 md:px-3">
        <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">
            <?php echo $__env->make('homepage.common.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="w-full lg:w-4/5 px-0 md:px-[5px]">
                <div class="content-product  ">
                    <?php echo $__env->make('homepage.common.breadcrumb', ['breadcrumb' => '', 'title' => $page->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="title-title p-[10px] text-f18">
                        <a href="javascript:void(0)" class=" font-bold"><?php echo e($page->title); ?></a>
                    </div>
                    <div class=" bg-white">
                        <?php if(!empty($data)): ?>
                            <div class="flex flex-wrap justify-center mx-[-10px]">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="w-1/2 md:w-1/4 px-[10px]">
                                        <?php echo htmlItemProduct($item, checkProductIncart($item->id, $cart)); ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="pagenavi wow fadeInUp mt-[20px] pb-[20px]">
                                
                                <?php echo $data->links(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .content-product .breadcrumb {
            margin: 10px 0;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien3/domains/khangdien.tamphat.edu.vn/public_html/resources/views/page/frontend/products.blade.php ENDPATH**/ ?>