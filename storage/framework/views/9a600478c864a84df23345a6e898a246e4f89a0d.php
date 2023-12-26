<?php $__env->startSection('content'); ?>

    <?php
    $data = getDataJson($page->postmetasMany, 'config_colums_json_aboutus');
    ?>

    <div class="container mx-auto px-0 md:px-3">

        <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">

            <?php echo $__env->make('homepage.common.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="w-full lg:w-4/5 px-0 md:px-[5px]">

                <div class="content-info  bg-white p-[10px]">

                    <?php echo $__env->make('homepage.common.breadcrumb', ['breadcrumb' => '', 'title' => $page->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <h2 class="text-f25 font-bold text-Pimary_color mb-[20px]"><?php echo e(showField($page->postmetasMany, 'config_colums_input_title')); ?></h2>

                    <?php if( isset($data->image) ): ?>
                        <?php $__currentLoopData = $data->image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item-info flex flex-wrap justify-between mx-[-10px] items-center mb-[20px]">
                                <div class="img w-full md:w-1/2 px-[10px] hover-zoom order-1 md:order-<?php echo e($key%2==0?'1':'2'); ?>">
                                    <img src="<?php echo e($val); ?>" alt="<?php echo e($page->title); ?>"/>
                                </div>
                                <div class="nav-img w-full md:w-1/2 px-10px order-2 md:order-<?php echo e($key%2==0?'2':'1'); ?>">
                                    <div class="content-content">
                                        <?php echo $data->content[$key]; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style type="text/css">
        .content-content img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: auto !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vuong/domains/vuong.tamphat.edu.vn/public_html/resources/views/page/frontend/aboutus.blade.php ENDPATH**/ ?>