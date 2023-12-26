<?php $__env->startSection('content'); ?>
<?php
$teams = [];
$contents = [];
$jsonData = !empty($page->postmetasMany) ? json_decode($page->postmetasMany, TRUE) : [];
if (!empty($jsonData)) {
    foreach ($jsonData as $item) {
        if ($item['meta_key'] == 'config_colums_json_teams') {
            $teams = !empty($item['meta_value']) ? json_decode($item['meta_value']) : [];
        }
        if ($item['meta_key'] == 'config_colums_json_aboutus') {
            $contents = !empty($item['meta_value']) ? json_decode($item['meta_value']) : [];
        }
    }
}
?>
<div class="banner-wrapper has_background">
    <img src="<?php echo e(asset($page['image'])); ?>" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
    <div class="banner-wrapper-inner">
        <h1 class="page-title"><?php echo e($page->title); ?></h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo e(url('')); ?>"><span>Trang chủ</span></a></li>
                <li class="trail-item trail-end active"><span>Liên hệ</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="site-main  main-container no-sidebar">
    <?php if(!empty($contents) && !empty($contents->title) && !empty($contents->title[0])): ?>
    <?php $__currentLoopData = $contents->title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="section-037">
        <div class="container">
            <div class="furgan-popupvideo style-01">
                <div class="popupvideo-inner">
                    <div class="icon">
                        <img src="<?php echo !empty($contents->image[$key]) ? $contents->image[$key] : '' ?>" class="attachment-full size-full" alt="<?php echo e($item); ?>">
                        <?php /*<div class="product-video-button hidden">
                            <a class="buttonvideo" href="#" data-videosite="vimeo" data-videoid="88824488" tabindex="0">
                                <div class="videobox_animation circle_1"></div>
                                <div class="videobox_animation circle_2"></div>
                                <div class="videobox_animation circle_3"></div>
                            </a>
                        </div>*/ ?>
                    </div>
                    <div class="popupvideo-wrap">
                        <h4 class="title"><?php echo e($item); ?></h4>
                        <div>
                            <?php echo !empty($contents->content[$key]) ? $contents->content[$key] : '' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if(!empty($teams) && !empty($teams->title) && !empty($teams->title[0])): ?>
    <div class="section-001">
        <div class="container">
            <div class="furgan-heading style-01">
                <div class="heading-inner">
                    <h3 class="title"> <?php echo $fcSystem['title_9'] ?></h3>
                    <div class="subtitle">
                        <?php echo $fcSystem['title_10'] ?>
                    </div>
                </div>
            </div>
            <div class="furgan-slide">
                <div class="owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:3,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php $__currentLoopData = $teams->title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="furgan-team style-01">
                        <div class="team-inner">
                            <div class="thumb-avatar">
                                <a href="javascript:void(0)" target="_self" tabindex="0">
                                    <img src="<?php echo !empty($teams->image[$key]) ? $teams->image[$key] : '' ?>" class="attachment-full size-full" alt="img"></a>
                                <div class="list-social">
                                    <a href="<?php echo !empty($teams->facebook[$key]) ? $teams->facebook[$key] : '' ?>" target="_blank" tabindex="0"><i class="az_tta-icon fa fa-facebook"></i></a>
                                    <a href="<?php echo !empty($teams->twitter[$key]) ? $teams->twitter[$key] : '' ?>" target="_blank" tabindex="0"><i class="az_tta-icon fa fa-twitter"></i></a>
                                    <a href="<?php echo !empty($teams->instagram[$key]) ? $teams->instagram[$key] : '' ?>" target="_blank" tabindex="0"><i class="az_tta-icon fa fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="content-team">
                                <h3 class="name">
                                    <a href="javascript:void(0)" target="_self" tabindex="0"><?php echo e($item); ?></a>
                                </h3>
                                <p class="positions"><?php echo !empty($teams->description[$key]) ? $teams->description[$key] : '' ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($partners && count($partners->slides) > 0): ?>

    <div class="section-039 section-001">
        <div class="container">
            <div class="furgan-slide">
                <div class="owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:60,&quot;dots&quot;:false,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:5,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;30&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;40&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;50&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesMargin&quot;:&quot;60&quot;}}]">

                    <?php $__currentLoopData = $partners->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="dreaming_single_image dreaming_content_element az_align_center">
                        <figure class="dreaming_wrapper az_figure">
                            <div class="az_single_image-wrapper  az_box_border_grey effect bounce-in ">
                                <img src="<?php echo e(asset($slide->src)); ?>" class="az_single_image-img attachment-full" alt="<?php echo e($slide->title); ?>">
                            </div>
                        </figure>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php if($OurFeatures && count($OurFeatures->slides) > 0): ?>
    <div class="section-040">
        <div class="furgan-heading style-01">
            <div class="heading-inner">
                <h3 class="title"><?php echo e($fcSystem['title_11']); ?></h3>
                <div class="subtitle">
                    <?php echo e($fcSystem['title_12']); ?>

                </div>
            </div>
        </div>
        <div class="furgan-instagram style-01">
            <div class="instagram-owl owl-slick" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:0,&quot;dots&quot;:false,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:6,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:6,&quot;slidesMargin&quot;:&quot;0&quot;}}]">
                <?php $__currentLoopData = $OurFeatures->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rows-space-0">
                    <a target="_blank" href="<?php echo e(url($slide->link)); ?>" class="item" tabindex="-1">
                        <img class="img-responsive lazy" src="<?php echo e(asset($slide->src)); ?>" alt="hình ảnh <?php echo e($key); ?>">
                        <span class="instagram-info">
                            <span class="social-wrap">
                                <span class="social-info">
                                    <svg style="width: 24px;height: 24px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                    </svg>
                                </span>
                            </span>
                        </span>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/globalmat/domains/globalmat.vn/public_html/resources/views/page/frontend/aboutus.blade.php ENDPATH**/ ?>