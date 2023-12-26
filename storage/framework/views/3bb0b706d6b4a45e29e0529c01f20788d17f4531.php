<?php

$productHighLight = getProductHighLight();

?>

<div class="w-1/5 px-[5px] hidden lg:block">

    <?php if( isset($showMenu) && ($showMenu == 'hide') ): ?>

    <?php echo $__env->make('homepage.common.menuProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $__env->startPush('css'); ?>
        <style type="text/css">
            .menu-product-header {
                display: block;
                position: unset;
            }
        </style>
    <?php $__env->stopPush(); ?>

    <?php endif; ?>

    <?php if($productHighLight): ?>

    <aside class="sidebar ">

        <div class="item-sb rounded-[5px] p-[10px] border border-gray-100 mt-[20px] bg-white">

            <h3 class="text-f15 font-bold uppercase mb-[15px]">

                SẢN PHẨM NỐI BẬT

            </h3>

            <div class="nav-item-sb">

                <?php $__currentLoopData = $productHighLight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php $price = getPrice(array('price' => $val->price, 'price_sale' => $val->price_sale, 'price_contact' => $val->price_contact)); ?>

                <div class="item-1 flex flex-wrap mb-[15px] border-b border-gray-100 pb-[15px]">

                    <div class="img w-1/3 hover-zoom">

                        <a href="<?php echo e(route('routerURL', ['slug' => $val->slug])); ?>">

                        <img src="<?php echo e(asset($val->image!=''?$val->image:'images/404.png')); ?>" alt="<?php echo e($val->title); ?>" class="w-full object-cover" style="height: 65px;">

                        </a>

                    </div>

                    <div class="nav-img w-2/3 pl-[10px]">

                        <h3 class="text-f14  mb-[2px] leading-[20px] h-[40px] overflow-hidden">

                            <a href="<?php echo e(route('routerURL', ['slug' => $val->slug])); ?>" class="hover:text-Pimary_color"><?php echo e($val->title); ?></a>

                        </h3>

                        <p class="price text-f14">

                            <span class="text-red-600 font-bold pr-[10px] inline-block"><?php echo e($price['price_final']); ?> </span>

                            <del class="text-gray-400 text-f13"><?php echo e($price['price_old']); ?></del>

                        </p>

                    </div>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

    </aside>

    <?php endif; ?>

</div>

<?php /**PATH /home/vuong/domains/vuong.tamphat.edu.vn/public_html/resources/views/homepage/common/aside.blade.php ENDPATH**/ ?>