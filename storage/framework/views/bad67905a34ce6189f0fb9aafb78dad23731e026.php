<?php $__env->startSection('content'); ?>
    <?php
    $services = [];
    $banners = [];
    if (count($page->postmetasMany) > 0) {
        foreach ($page->postmetasMany as $item) {
            if ($item['meta_key'] == 'config_colums_json_count') {
                $services = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
            if ($item['meta_key'] == 'config_colums_json_banners') {
                $banners = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
    }

    ?>

    
    <div class="content-product mt-[30px] bg-white">
        <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
            <a href="<?php echo e(url('/san-pham-khuyen-mai')); ?>" class="text-white font-bold"><?php echo e($fcSystem['title_1']); ?></a>
            <a href="<?php echo e(url('/san-pham-khuyen-mai')); ?>" class="readmore float-right text-white hover:text-yellow-400 transition-all">Xem tất cả<i
                    class="fa-solid fa-angles-right ml-[5px] text-f10"></i></a>
        </div>

        <div class="p-[10px]">
            <?php if(!$ispromotionalProduct->isEmpty()): ?>
                <div class="flex flex-wrap justify-center">


                    <?php $__currentLoopData = $ispromotionalProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-1/2 md:w-1/4">

                            <div class="item border border-gray-100 p-[10px]">
                                <?php echo htmlProduct($key, $item); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="content-product mt-[30px] bg-white">
        <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
            <a href="<?php echo e(url('/thit-ca-trung-hai-san')); ?>" class="text-white font-bold"><?php echo e($fcSystem['title_2']); ?></a>
            <a href="<?php echo e(url('/thit-ca-trung-hai-san')); ?>" class="readmore float-right text-white hover:text-yellow-400 transition-all">Xem tất cả<i
                    class="fa-solid fa-angles-right ml-[5px] text-f10"></i></a>
        </div>
        <div class="p-[10px]">
            <?php if(!$isProduct1->isEmpty()): ?>
                <div class="flex flex-wrap justify-center">


                    <?php $__currentLoopData = $isProduct1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-1/2 md:w-1/4">

                            <div class="item border border-gray-100 p-[10px]">
                                <?php echo htmlProduct($key, $item); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="content-product mt-[30px] bg-white">
        <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
            <a href="<?php echo e(url('/mi-mien-chao-pho')); ?>" class="text-white font-bold"><?php echo e($fcSystem['title_3']); ?></a>
            <a href="<?php echo e(url('/mi-mien-chao-pho')); ?>" class="readmore float-right text-white hover:text-yellow-400 transition-all">Xem tất cả<i
                    class="fa-solid fa-angles-right ml-[5px] text-f10"></i></a>
        </div>
        <div class="p-[10px]">
            <?php if(!$isProduct2->isEmpty()): ?>
                <div class="flex flex-wrap justify-center">


                    <?php $__currentLoopData = $isProduct2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-1/2 md:w-1/4">

                            <div class="item border border-gray-100 p-[10px]">
                                <?php echo htmlProduct($key, $item); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="new-home bg-white mt-[30px]">
        <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
            <a class="text-white font-bold uppercase"><?php echo e($fcSystem['title_4']); ?></a>
            <a href="<?php echo e(url('/tin-tuc')); ?>" class="readmore float-right text-white hover:text-yellow-400 transition-all">Xem tất cả<i
                    class="fa-solid fa-angles-right ml-[5px] text-f10"></i></a>
        </div>
        <div class="nav-new-home p-[10px]">
            <div class="flex flex-wrap justify-between mx-[-10px]">
                <?php if($BlogNews): ?>
                    <?php if(count($BlogNews->posts) > 0): ?>
                    <?php $__currentLoopData = $BlogNews->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-full md:w-1/2 px-[10px]">
                            <div class="item-large">

                                    <div
                                        class="item flex flex-wrap justify-between mx-[-7px] border-b border-gray-100 pb-[10px] mb-[10px]">
                                        <div class="img w-1/3 md:w-1/4 px-[7px] hover-zoom">
                                            <a href="<?php echo e(route('routerURL', ['slug' => $item->slug])); ?>"><img
                                                    src="<?php echo e(getImageUrl('articles', $item['image'], 'small')); ?>"
                                                    alt="" style="height: 70px" class="w-full object-cover" /></a>
                                        </div>
                                        <?php if(!empty($item->name)): ?>
                                            <div class="nav-img w-2/3 md:w-3/4 px-[7px]">
                                                <h3 class="font-bold"
                                                    style="
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        line-height: 22px;
                                                        -webkit-line-clamp: 2;
                                                        height: 44px;
                                                        display: -webkit-box;
                                                        -webkit-box-orient: vertical;
                                                    ">
                                                    <a href="<?php echo e(route('routerURL', ['slug' => $item->slug])); ?>"
                                                        class="hover:text-Pimary_color transition-all"><?php echo e($item->title); ?></a>
                                                </h3>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/home/index.blade.php ENDPATH**/ ?>