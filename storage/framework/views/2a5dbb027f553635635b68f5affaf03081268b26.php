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
<div class="fullwidth-template">
    <?php if($slideHome && count($slideHome->slides) > 0): ?>
    <div class="slide-home-01">
        <div class="response-product product-list-owl owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:0,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:1,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}}]">
            <?php $__currentLoopData = $slideHome->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $title = explode("-", $slide->title); ?>
            <div class="slide-wrap">
                <img src="<?php echo e(asset($slide->src)); ?>" alt="<?php echo e($slide->title); ?>">
                <div class="slide-info">
                    <div class="container">
                        <div class="slide-inner">
                            <h5><?php echo e(!empty($title[0]) ?$title[0]:""); ?></h5>
                            <h1><?php echo $slide->description ?></h1>
                            <h2><?php echo e(!empty($title[1]) ?$title[1]:""); ?></h2>
                            <a href="<?php echo e($slide->link); ?>"><?php echo e($fcSystem['title_1']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($services) && !empty($services->title)): ?>
    <div class="section-002">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $services->title; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12 col-lg-4">
                    <div class="furgan-iconbox style-01">
                        <div class="iconbox-inner">
                            <div class="icon">
                                <?php if($key == 0): ?>
                                <span class="flaticon-startup"></span>
                                <span class="flaticon-startup"></span>
                                <?php endif; ?>
                                <?php if($key==1): ?>
                                <span class="flaticon-padlock"></span>
                                <span class="flaticon-padlock"></span>
                                <?php endif; ?>
                                <?php if($key==2): ?>
                                <span class="flaticon-recycle"></span>
                                <span class="flaticon-recycle"></span>
                                <?php endif; ?>
                            </div>
                            <div class="content">
                                <h4 class="title"><?php echo e($item); ?></h4>
                                <div class="desc"><?php echo e(!empty($services->content[$key])?$services->content[$key]:''); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!$highlightCP->isEmpty()): ?>
    <div class="section-003">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <?php $__currentLoopData = $highlightCP; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="furgan-banner style-01 <?php if($key==0): ?> left-center <?php endif; ?> <?php if($key==1): ?> right-top <?php endif; ?> <?php if($key==2): ?> left-bottom <?php endif; ?>">
                        <div class="banner-inner">
                            <figure class="banner-thumb">
                                <a target="_self" href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>"><img src="<?php echo e(asset($item->image)); ?>" class="attachment-full size-full" alt="<?php echo e($item->title); ?>"></a>
                            </figure>
                            <div class="banner-info ">
                                <div class="banner-content">
                                    <div class="title-wrap">
                                        <h6 class="title">
                                            <a target="_self" href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>"><?php echo e($item->title); ?></a>
                                        </h6>
                                    </div>
                                    <div class="button-wrap">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($key==0): ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!$ishomeProduct->isEmpty()): ?>
    <div class="section-001">
        <div class="container">
            <div class="furgan-heading style-01">
                <div class="heading-inner">
                    <h3 class="title"><?php echo e($fcSystem['title_2']); ?></h3>
                    <div class="subtitle"><?php echo e($fcSystem['title_3']); ?></div>
                </div>
            </div>
            <div class="furgan-products style-02">
                <div class="response-product product-list-owl owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:2}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php $__currentLoopData = $ishomeProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-item featured_products style-02 rows-space-30 post-34 product type-product status-publish has-post-thumbnail product_cat-light product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock sale featured shipping-taxable product-type-grouped">
                        <?php echo htmlProduct2($key, $item) ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!empty($banners) && !empty($banners->image) && !empty($banners->image[0])): ?>
    <div>
        <div class="furgan-banner style-02 left-center">
            <div class="banner-inner">
                <figure class="banner-thumb">
                    <img src="<?php echo e(asset($banners->image[0])); ?>" class="attachment-full size-full" alt="img">
                </figure>
                <div class="banner-info container">
                    <div class="banner-content">
                        <?php echo !empty($banners->content[0]) ? $banners->content[0] : '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(!$highlightProduct->isEmpty()): ?>
    <div class="section-001">
        <div class="container">
            <div class="furgan-heading style-01">
                <div class="heading-inner">
                    <h3 class="title"><?php echo e($fcSystem['title_4']); ?></h3>
                    <div class="subtitle">
                        <?php echo e($fcSystem['title_5']); ?>

                    </div>
                </div>
            </div>
            <div class="furgan-products style-01">
                <div class="response-product product-list-owl owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php $__currentLoopData = $highlightProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-item recent-product style-01 rows-space-0 post-34 product type-product status-publish has-post-thumbnail product_cat-light product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock last instock sale featured shipping-taxable product-type-grouped">
                        <?php echo htmlProduct($key, $item) ?>

                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(!empty($banners) && !empty($banners->image) && !empty($banners->image[1])): ?>
    <div class="section-038">
        <div class="furgan-banner style-07 left-center">
            <div class="banner-inner">
                <figure class="banner-thumb">
                    <img src="<?php echo e(asset($banners->image[1])); ?>" class="attachment-full size-full" alt="img">
                </figure>
                <div class="banner-info container">
                    <div class="banner-content">
                        <?php echo !empty($banners->content[1]) ? $banners->content[1] : '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if($BlogNews): ?>
    <?php if(count($BlogNews->posts) > 0): ?>
    <div class="section-001">
        <div class="container">
            <div class="furgan-heading style-01">
                <div class="heading-inner">
                    <h3 class="title"><?php echo e($BlogNews->title); ?></h3>
                    <div class="subtitle">
                        <?php echo $BlogNews->description ?>
                    </div>
                </div>
            </div>
            <div class="furgan-blog style-01">
                <div class="blog-list-owl owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:3,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php $__currentLoopData = $BlogNews->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="post-item post-grid rows-space-0 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                        <div class="post-inner blog-grid">
                            <div class="post-thumb">
                                <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" tabindex="0">
                                    <img src="<?php echo e(getImageUrl('articles', $item['image'], 'small')); ?>" class="img-responsive attachment-370x330 size-370x330" alt="<?php echo e($item->title); ?>" width="370" height="330">
                                </a>
                                <a class="datebox" href="javascript:void(0)" tabindex="0">
                                    <span><?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('d')); ?></span>
                                    <span><?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('M')); ?></span>
                                </a>
                            </div>
                            <div class="post-content">
                                <?php if(!empty($item->name)): ?>
                                <div class="post-meta">
                                    <div class="post-author">
                                        By: <a href="javascript:void(0)" tabindex="0"><?php echo e($item->name); ?> </a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="post-info equal-elem">
                                    <h2 class="post-title">
                                        <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" tabindex="0"><?php echo e($item->title); ?></a>
                                    </h2>
                                    <?php echo $item->description ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <?php if($partners && count($partners->slides) > 0): ?>
    <div class="section-001 section-006">
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

    <div class="section-008">
        <div class="furgan-instagram style-01">
            <div class="instagram-owl owl-slick" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:15,&quot;dots&quot;:false,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:5,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;15&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;15&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesMargin&quot;:&quot;15&quot;}}]">
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
<?php $__env->startPush('javascript'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/globalmat/domains/globalmat.vn/public_html/resources/views/homepage/home/index.blade.php ENDPATH**/ ?>