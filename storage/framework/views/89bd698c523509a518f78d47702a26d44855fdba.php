<?php $__env->startSection('content'); ?>
<div class="banner-wrapper has_background">
    <img style="width: 100%;" src="<?php echo e(asset($fcSystem['banner_3'])); ?>" alt="Tag:
                            <?php echo e($detail->title); ?>" class="img-responsive attachment-1920x447 size-1920x447">
    <div class="banner-wrapper-inner">
        <h1 class="page-title">Tag:
            <?php echo e($detail->title); ?>

        </h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo url('') ?>">Trang chủ</a></li>
                <li><a href="javascript:void(0)" class="trail-item trail-end active">Tag:
                        <?php echo e($detail->title); ?></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="main-container right-sidebar has-sidebar">
    <!-- POST LAYOUT -->
    <div class="container">
        <div class="row">
            <?php if($data): ?>
            <div class="main-content col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="blog-standard content-post">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="post-item post-standard post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                        <div class="post-thumb">
                            <a href="<?php echo e(route('routerURL',['slug' => $item->article->slug])); ?>"><img src="<?php echo e(asset($item->article->image)); ?>" class="img-responsive attachment-1170x768 size-1170x768" alt="<?php echo e($item->article->title); ?>" width="1170" height="768" style="width: 100%;"></a>
                        </div>
                        <div class="post-info">
                            <h2 class="post-title"><a href="<?php echo e(route('routerURL',['slug' => $item->article->slug])); ?>"><?php echo e($item->article->title); ?></a></h2>
                            <div class="post-meta">
                                <div class="date">
                                    <a href="javascript:void(0)"><?php echo e(\Carbon\Carbon::parse($item->article->created_at)->format('M')); ?> <?php echo e(\Carbon\Carbon::parse($item->article->created_at)->format('d')); ?>, <?php echo e(\Carbon\Carbon::parse($item->article->created_at)->format('Y')); ?> </a>
                                </div>
                                <?php if(!empty($item->article->name)): ?>
                                <div class="post-author">
                                    By:<a href="javascript:void(0)"> <?php echo e($item->article->name); ?> </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="post-content">
                            <?php echo $item->article->description ?>
                        </div>
                        <a href="<?php echo e(route('routerURL',['slug' => $item->article->slug])); ?>" class="readmore">Xem chi tiết</a>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <?php echo $data->links() ?>
            </div>
            <?php endif; ?>

            <div class="sidebar furgan_sidebar col-xl-3 col-lg-4 col-md-12 col-sm-12">
                <?php echo $__env->make('article.frontend.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/tag/frontend/article.blade.php ENDPATH**/ ?>