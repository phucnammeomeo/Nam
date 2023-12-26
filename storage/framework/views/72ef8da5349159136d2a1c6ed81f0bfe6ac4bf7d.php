<?php $__env->startSection('content'); ?>
<div class="banner-wrapper has_background">
    <img src="<?php echo e(!empty($detailCatalog->banner) ? (!empty(File::exists(base_path($detailCatalog->banner)))?asset($detailCatalog->banner):asset($fcSystem['banner_3'])) : asset($fcSystem['banner_3'])); ?>" alt="<?php echo e($detailCatalog->title); ?>" class="img-responsive attachment-1920x447 size-1920x447" style="width: 100%;">
    <div class="banner-wrapper-inner">
        <h2 class="page-title"><?php echo e($detailCatalog->title); ?></h2>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo url('') ?>">Trang chủ</a></li>
                <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>" class="trail-item trail-end active"><?php echo e($v->title); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<div class="main-container right-sidebar has-sidebar">
    <!-- POST LAYOUT -->
    <div class="container">
        <div class="row">
            <div class="main-content col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <article class="post-item post-single post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                    <div class="single-post-thumb">
                        <div class="post-thumb">
                            <img src="<?php echo e(asset($detail->image)); ?>" class="attachment-full size-full wp-post-image" alt="<?php echo e($detail->title); ?>">
                        </div>
                    </div>
                    <div class="single-post-info">
                        <h1 class="post-title"><a href="javascript:void(0)"><?php echo e($detail->title); ?></a></h1>
                        <div class="post-meta">
                            <div class="date">
                                <a href="javascript:void(0)"><?php echo \Carbon\Carbon::parse($detail->created_at)->format('M'); ?> <?php echo \Carbon\Carbon::parse($detail->created_at)->format('d'); ?>, <?php echo \Carbon\Carbon::parse($detail->created_at)->format('Y'); ?> </a>
                            </div>
                            <?php if(!empty($detail->user->name)): ?>
                            <div class="post-author">
                                By:<a href="javascript:void(0)"> <?php echo e($detail->user->name); ?> </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="post-content box_content">
                        <?php echo $detail->content ?>
                    </div>
                    <?php if(count($detail->tags) > 0): ?>
                    <div class="tags">
                        <?php $__currentLoopData = $detail->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('tagURL',['slug' => $item->slug])); ?>" rel="tag"><?php echo e($item->title); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="post-footer">
                        <div class="furgan-share-socials">
                            <h5 class="social-heading">Share: </h5>
                            <a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $seo['canonical'] ?>">
                                <i class="fa fa-facebook-f"></i>
                            </a>
                            <a target="_blank" class="twitter" href="https://twitter.com/intent/tweet?url=<?php echo $seo['canonical'] ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a target="_blank" class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo $seo['canonical'] ?>">
                                <i class="fa fa-pinterest"></i>
                            </a>
                            <a target="_blank" class="googleplus" href="https://plus.google.com/share?url=<?php echo $seo['canonical'] ?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                        <?php if(count($detail->relationships) > 0): ?>
                        <div class="categories">
                            <span>Danh mục: </span>
                            <?php $__currentLoopData = $detail->relationships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kc=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo !empty($kc > 0) ? ', ' : '' ?><a href="<?php echo e(route('routerURL',['slug' => $c->slug])); ?>"><?php echo e($c->title); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="single-post-info" style="margin-top:30px">
                        <h2 class="post-title"><a href="javascript:void(0)">Bài viết liên quan</a></h2>
                        <div class="furgan-blog style-01">
                            <div class="blog-list-owl owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:3,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                                <?php $__currentLoopData = $sameArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article class="post-item post-grid rows-space-0 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                                    <div class="post-inner blog-grid">
                                        <div class="post-thumb">
                                            <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" tabindex="0">
                                                <img src="<?php echo e(getImageUrl('articles', $item['image'], 'small')); ?>" class="img-responsive attachment-370x330 size-370x330" alt="<?php echo e($item->title); ?>" width="370" height="240" style="height:240px">
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
                </article>
            </div>
            <div class="sidebar furgan_sidebar col-xl-3 col-lg-4 col-md-12 col-sm-12">
                <?php echo $__env->make('article.frontend.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
<style>
    .box_content img {
        margin: 10px auto;
        max-width: 100%;
        height: auto !important;
    }

    .box_content ul {
        list-style: disc;
        padding-left: 20px;
        margin-bottom: 10px;
    }

    .box_content p {
        margin-bottom: 10px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/article/frontend/article/index.blade.php ENDPATH**/ ?>