
<?php $__env->startSection('content'); ?>
<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_70" data-parallax-bg-image="<?php echo e(asset($fcSystem['banner_9'])); ?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title">
                    <h1><?php echo e($page->title); ?></h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-sm-end">
                        <li class="breadcrumb-item"><a href="<?php echo e(url('')); ?>">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($page->title); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BREADCRUMB -->
<?php if(!$categoryProduct->isEmpty()): ?>
<!-- START SECTION OUR MENU -->
<section class="pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="heading_s1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <h2>THỰC ĐƠN</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="menu_content">
                    <ul class="nav nav-tabs justify-content-center animation" data-animation="fadeInUp" data-animation-delay="0.03s" role="tablist">
                        <?php $__currentLoopData = $categoryProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if($key == 0): ?> active <?php endif; ?>" id="home-<?php echo e($key); ?>-tab1" data-toggle="tab" href="#home-<?php echo e($key); ?>" role="tab" aria-controls="home-<?php echo e($key); ?>" aria-selected="true"><?php echo e($item->title); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <div class="tab-content">
                        <?php $__currentLoopData = $categoryProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade  <?php if($key == 0): ?> show active <?php endif; ?>" id="home-<?php echo e($key); ?>" role="tabpanel">
                            <ul class="list_none menu_list list_border animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                                <?php if(count($item->posts) > 0): ?>
                                <?php $__currentLoopData = $item->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $price = getPrice(array('price' => $val->getProduct->price, 'price_sale' => $val->getProduct->price_sale, 'price_contact' =>
                                $val->getProduct->price_contact));
                                ?>
                                <li>
                                    <div class="single_menu_product">
                                        <div class="menu_product_img">
                                            <img src="<?php echo e(asset($val->getProduct->image)); ?>" alt="<?php echo e($val->getProduct->title); ?>" />
                                        </div>
                                        <div class="menu_product_info">
                                            <div class="menu_title_price">
                                                <div class="menu_title">
                                                    <h6><?php echo e($val->getProduct->title); ?></h6>
                                                </div>
                                                <div class="menu_price">
                                                    <span><?php echo e($price['price_final']); ?> VNĐ</span>
                                                </div>
                                            </div>
                                            <p>
                                                <?php echo $val->getProduct->description; ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- START SECTION OUR MENU -->
<?php endif; ?>

<?php echo $__env->make('homepage.common.subscribers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    .menu_list li:nth-child(3) {
        clear: both;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/page/frontend/menus.blade.php ENDPATH**/ ?>