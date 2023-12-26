
<?php $__env->startSection('content'); ?>
<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_70" data-parallax-bg-image="<?php echo e(!empty($page->image) ? (!empty(File::exists(base_path($page->image)))?asset($page->image):asset($fcSystem['banner_6'])) : asset($fcSystem['banner_6'])); ?>">
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
<?php echo $__env->make('homepage.common.formCart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- START SECTION FEATURES -->
<section class="parallax_bg overlay_bg_80" data-parallax-bg-image="<?php echo e(asset($fcSystem['banner_8'])); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center book_table_online text_white animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div>
                        <?php echo $fcSystem['title_9'] ?>
                    </div>
                    <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>" class="btn btn-default btn-radius btn-big mt-2"><img src="<?php echo e(asset('frontend/assets/images/mobile_icon.png')); ?>" alt="mobile_icon" /><?php echo e($fcSystem['contact_hotline']); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION FEATURES -->

<!-- START SECTION ABOUT -->
<section class="pb-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="box_shadow1">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <div class="h-100 background_bg overlay_bg2 sm-height-300 animation" data-animation="fadeInLeft" data-animation-delay="0.02s" data-img-src="<?php echo e(asset($fcSystem['banner_7'])); ?>"></div>
                        </div>
                        <div class="col-md-8">
                            <div class="content_info animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                                <div class="heading_s1">
                                    <h2><?php echo e($fcSystem['title_7']); ?></h2>
                                </div>
                                <p><?php echo $fcSystem['title_8'] ?></p>
                                <ul class="contact_info pt-1 contact_info_light list_none">
                                    <li>
                                        <span class="fas fa-phone"></span>
                                        <p><?php echo e($fcSystem['contact_hotline']); ?></p>
                                    </li>
                                    <li>
                                        <span class="fa fa-envelope"></span>
                                        <a href="mailto:<?php echo e($fcSystem['contact_email']); ?>"><?php echo e($fcSystem['contact_email']); ?></a>
                                    </li>
                                    <li>
                                        <span class="fa fa-map-marker-alt"></span>
                                        <address><?php echo e($fcSystem['contact_address']); ?></address>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION ABOUT -->
<?php echo $__env->make('homepage.common.subscribers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
    #formCart.overlay_bg_dark_80::before {
        display: none
    }

    #formCart.background_bg {
        background-image: none !important;
    }

    #formCart .overlay_bg_50::before {
        background-color: #2f303c !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/page/frontend/bookTable.blade.php ENDPATH**/ ?>