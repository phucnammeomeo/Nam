   <?php
    $asideCategory = Cache::remember('asideCategory', 600, function () {
        $asideCategory = \App\Models\CategoryProduct::select('id', 'title', 'slug')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return $asideCategory;
    });
    $asideBlogNews = Cache::remember('asideBlogNews', 600, function () {
        $asideBlogNews = \App\Models\CategoryArticle::select('id', 'title', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->with(['posts' => function ($query) {
                $query->limit(5);
            }])
            ->first();
        return $asideBlogNews;
    });
    $OurFeatures = Cache::remember('OurFeatures', 600, function () {
        $OurFeatures = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'OurFeatures'])->with('slides')->first();
        return $OurFeatures;
    });
    $asideTags = Cache::remember('asideTags', 600, function () {
        $asideTags = \App\Models\Tag::select('title', 'id', 'slug')->where(['alanguage' => config('app.locale'), 'publish' => 0])->get();
        return $asideTags;
    });
    ?>
   <div id="widget-area" class="widget-area sidebar-blog">
       <div id="search-3" class="widget widget_search">
           <form role="search" method="get" class="search-form" action="<?php echo e(route('homepage.search2')); ?>">
               <input class="search-field" placeholder="Tìm kiếm bài viết…" value="<?php echo e(request()->get('keyword')); ?>" name="keyword" type="search">
               <button type="submit" class="search-submit"><span class="fa fa-search" aria-hidden="true"></span></button>
           </form>
       </div>
       <?php if(!$asideCategory->isEmpty()): ?>
       <div id="categories-3" class="widget widget_categories">
           <h2 class="widgettitle">Danh mục sản phẩm<span class="arrow"></span></h2>
           <ul>
               <?php $__currentLoopData = $asideCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li class="cat-item cat-item-51"><a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>"><?php echo e($item->title); ?></a>
               </li>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </ul>
       </div>
       <?php endif; ?>
       <?php if($asideBlogNews): ?>
       <?php if(count($asideBlogNews->posts) > 0): ?>
       <div id="widget_furgan_post-2" class="widget widget-furgan-post">
           <h2 class="widgettitle"><?php echo e($asideBlogNews->title); ?><span class="arrow"></span></h2>
           <div class="furgan-posts">
               <?php $__currentLoopData = $asideBlogNews->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <article class="post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                   <div class="post-item-inner">
                       <div class="post-thumb">
                           <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" tabindex="0">
                               <img src="<?php echo e(getImageUrl('articles', $item['image'], 'small')); ?>" class="img-responsive attachment-83x83 size-83x83" alt="<?php echo e($item->title); ?>" style="width:83px;height: 83px;">
                           </a>
                       </div>
                       <div class="post-info">
                           <div class="block-title">
                               <h2 class="post-title"><a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>"><?php echo e($item->title); ?></a></h2>
                           </div>
                           <div class="date"><?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('M')); ?> <?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('d')); ?>, <?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('Y')); ?></div>
                       </div>
                   </div>
               </article>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </div>
       </div>
       <?php endif; ?>
       <?php endif; ?>

       <div id="widget_furgan_socials-2" class="widget widget-furgan-socials">
           <h2 class="widgettitle"><?php echo e($fcSystem['title_13']); ?><span class="arrow"></span></h2>
           <div class="content-socials">
               <ul class="socials-list">
                   <li>
                       <a href="<?php echo e($fcSystem['social_facebook']); ?>" target="_blank">
                           <span class="fa fa-facebook"></span>
                       </a>
                   </li>
                   <li>
                       <a href="<?php echo e($fcSystem['social_instagram']); ?>" target="_blank">
                           <span class="fa fa-instagram"></span>
                       </a>
                   </li>
                   <li>
                       <a href="<?php echo e($fcSystem['social_twitter']); ?>" target="_blank">
                           <span class="fa fa-twitter"></span>
                       </a>
                   </li>
                   <li>
                       <a href="<?php echo e($fcSystem['social_pinterest']); ?>" target="_blank">
                           <span class="fa fa-pinterest-p"></span>
                       </a>
                   </li>
               </ul>
           </div>
       </div>
       <?php if($OurFeatures && count($OurFeatures->slides) > 0): ?>
       <div id="widget_furgan_instagram-3" class="widget widget-furgan-instagram">
           <h2 class="widgettitle"><?php echo e($OurFeatures->title); ?><span class="arrow"></span></h2>
           <div class="content-instagram">
               <?php $__currentLoopData = $OurFeatures->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <a target="_blank" href="<?php echo e(url($slide->link)); ?>" class="item">
                   <img class="img-responsive" src="<?php echo e(asset($slide->src)); ?>" alt="hình ảnh <?php echo e($key); ?>">
               </a>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </div>
       </div>
       <?php endif; ?>

       <?php if(!$asideTags->isEmpty()): ?>
       <div id="tag_cloud-3" class="widget widget_tag_cloud">
           <h2 class="widgettitle">Tags<span class="arrow"></span></h2>
           <div class="tagcloud">
               <?php $__currentLoopData = $asideTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <a href="<?php echo e(route('tagURL',['slug' => $item->slug])); ?>" class="tag-cloud-link tag-link-46 tag-link-position-1"><?php echo e($item->title); ?></a>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

           </div>
       </div>
       <?php endif; ?>


   </div><!-- .widget-area --><?php /**PATH D:\xampp\htdocs\food.local\resources\views/article/frontend/aside.blade.php ENDPATH**/ ?>