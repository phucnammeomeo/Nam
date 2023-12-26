<?php $__env->startSection('content'); ?>
<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_70" data-parallax-bg-image="<?php echo e(!empty($detail->image) ? (!empty(File::exists(base_path($detail->image)))?asset($detail->image):asset($fcSystem['banner_6'])) : asset($fcSystem['banner_6'])); ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h1><?php echo e($detail->title); ?></h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('')); ?>">Trang chủ</a></li>
                        <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($v->title); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BREADCRUMB -->
<?php if($data): ?>
<!-- START SECTION GALLERY -->
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="grid_container gutter_medium grid_col4 animation" data-animation="fadeInUp" data-animation-delay="0.03s">
                    <li class="grid-sizer"></li>

                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $image_json = json_decode($item->image_json, TRUE);
                    ?>
                    <!-- START PORTFOLIO ITEM -->
                    <li class="grid_item">
                        <div class="radius_all_10 gallery_item_custom" style="overflow: hidden;position: relative;">
                            <a href="<?php echo e(asset($item->image)); ?>" class="" data-fancybox="images" rel="group<?php echo e($key+1); ?>">
                                <img src="<?php echo asset($item->image); ?>" alt="<?php echo e($item->title); ?>" style="height: 278px;object-fit: cover;">
                            </a>
                            <div class="gallery_content">
                                <div class="link_container">
                                    <a href="<?php echo e(asset($item->image)); ?>" data-fancybox="images" rel="group<?php echo e($key+1); ?>"><span class="image_icon"><i class="ion-image"></i></span></a>
                                </div>
                            </div>
                            <?php if(!empty($image_json)): ?>
                            <?php $__currentLoopData = $image_json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(asset($val)); ?>" class="hidden" data-fancybox="images" rel="group<?php echo e($key+1); ?>" style="display: none">
                                <img src="<?php echo e(asset($val)); ?>" alt="<?php echo e($item->title); ?>">
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </li>
                    <!-- END PORTFOLIO ITEM -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
                <div class="medium_divider"></div>
                <?php echo $data->links() ?>
            </div>
        </div>
    </div>
</section>
<!-- START SECTION GALLERY -->
<?php endif; ?>
<?php echo $__env->make('homepage.common.subscribers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>
    <?php foreach ($data as $key => $item) { ?>
        $('a[rel="group<?php echo $key + 1 ?>"]').fancybox({
            thumbs: {
                autoStart: true
            },
            buttons: [
                'zoom',
                'close'
            ]
        });
    <?php } ?>
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/media/frontend/category/index.blade.php ENDPATH**/ ?>