<?php $__env->startSection('content'); ?>
    <?php
    $contents = [];
    $jsonData = !empty($page->postmetasMany) ? json_decode($page->postmetasMany, true) : [];
    if (!empty($jsonData)) {
        foreach ($jsonData as $item) {
            if ($item['meta_key'] == 'config_colums_json_aboutus') {
                $contents = !empty($item['meta_value']) ? json_decode($item['meta_value']) : [];
            }
        }
    }
    ?>

<?php if(!empty($contents) && !empty($contents->title) && !empty($contents->title[0])): ?>
<?php $__currentLoopData = $contents->title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="content-info pt-[30px] bg-white p-[10px]">
        <h2 class="text-f25 font-bold text-Pimary_color mb-[20px]">
            <?php echo e($item); ?>

        </h2>
        <div class="item-info flex flex-wrap justify-between mx-[-10px] items-center mb-[20px]">

            <div class="nav-img w-full px-10px">
                <div class="content-content">
                    <?php echo !empty($contents->content[$key]) ? $contents->content[$key] : '' ?>
                </div>
            </div>
        </div>

    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style type="text/css">
        .content-content img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: auto !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/page/frontend/aboutus.blade.php ENDPATH**/ ?>