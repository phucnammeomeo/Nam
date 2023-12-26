
<?php $__env->startSection('content'); ?>

<input type="hidden" value="<?php echo $detail->id ?>" id="detailProductID">
<div class="banner-wrapper no_background">
    <div class="banner-wrapper-inner">
        <nav class="furgan-breadcrumb">
            <a href="<?php echo url('') ?>">Trang chủ</a>
            <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <i class="fa fa-angle-right"></i>
            <a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>"><?php echo e($v->title); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <i class="fa fa-angle-right"></i>
            <?php echo e($detail->title); ?>

        </nav>
    </div>
</div>
<div class="single-thumb-vertical main-container shop-page right-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-xl-9 col-lg-8 col-md-8 col-sm-12 has-sidebar">
                <div class="furgan-notices-wrapper"></div>
                <div id="product-27" class="post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-variable has-default-attributes">
                    <div class="main-contain-summary">
                        <?php echo $__env->make('product.frontend.product.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="furgan-tabs furgan-tabs-wrapper">
                        <ul class="tabs dreaming-tabs" role="tablist">
                            <li class="description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
                                <a href="#tab-description">Thông tin sản phẩm</a>
                            </li>

                            <li class="reviews_tab" id="tab-title-reviews" role="tab" aria-controls="tab-reviews">
                                <a href="#tab-reviews">Reviews (0)</a>
                            </li>
                        </ul>
                        <div class="furgan-Tabs-panel furgan-Tabs-panel--description panel entry-content furgan-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                            <div class="container-table">
                                <?php echo $detail->content ?>
                            </div>

                        </div>

                        <div class="furgan-Tabs-panel furgan-Tabs-panel--reviews panel entry-content furgan-tab" id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
                            <?php echo $__env->make('product.frontend.product.comment.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar col-xl-3 col-lg-4 col-md-4 col-sm-12">
                <div id="widget-area" class="widget-area shop-sidebar">
                    <?php
                    $ishomeProducts = Cache::remember('ishomeProducts', 600, function () {
                        $ishomeProducts = \App\Models\Product::select('id', 'title', 'slug', 'image', 'price', 'price_sale', 'price_contact', 'isaside')
                            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
                            ->orderBy('order', 'asc')
                            ->orderBy('id', 'desc')
                            ->limit(5)
                            ->get();
                        return $ishomeProducts;
                    });
                    $categories = Cache::remember('categories', 600, function () {
                        $categories = \App\Models\CategoryProduct::select('id', 'title', 'slug')
                            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'parentid' => 0])
                            ->orderBy('order', 'asc')
                            ->orderBy('id', 'desc')
                            ->get();
                        return $categories;
                    });
                    ?>
                    <?php if(!$ishomeProducts->isEmpty()): ?>
                    <div id="furgan_products-2" class="widget furgan widget_products">
                        <h2 class="widgettitle"><?php echo e($fcSystem['title_2']); ?><span class="arrow"></span></h2>
                        <ul class="product_list_widget">
                            <?php $__currentLoopData = $ishomeProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
                            $item['price_contact']));
                            $countCmt = $item->comments->count();
                            $sumCmt = $item->comments->sum('rating');
                            $star = 0;
                            if (!empty($countCmt)) {
                                $star = $sumCmt / $countCmt;
                            }
                            ?>
                            <li>
                                <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
                                    <img src="<?php echo e(asset($item->image)); ?>" class="attachment-furgan_thumbnail size-furgan_thumbnail" alt="img" style="height: 81px;">
                                    <span class="product-title"><?php echo e($item->title); ?></span>
                                </a>
                                <div class="rating-wapper nostar">
                                    <div class="star-rating">
                                        <span style="width:<?php echo e($star*20); ?>%">Rated <strong class="rating">0</strong> out of 5</span>
                                    </div>
                                    <span class="review">(0)</span>
                                </div>
                                <span class="furgan-Price-amount amount">

                                    <?php if(!empty($price['price_old'])): ?>
                                    <del><span class="furgan-Price-amount amount"><?php echo e($price['price_old']); ?></span></del>
                                    <?php endif; ?>
                                    <ins><span class="furgan-Price-amount amount"><?php echo e($price['price_final']); ?></ins>
                                </span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if(!$categories->isEmpty()): ?>
                    <div id="furgan_product_categories-2" class="widget furgan widget_product_categories">
                        <h2 class="widgettitle">Danh mục sản phẩm<span class="arrow"></span></h2>
                        <ul class="product-categories">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="cat-item"><a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>"><?php echo e($item->title); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div><!-- .widget-area -->
            </div>


            <?php if(!$productSame->isEmpty()): ?>
            <div class="col-md-12 col-sm-12 dreaming_related-product">
                <div class="block-title">
                    <h2 class="product-grid-title">
                        <span>Sản phẩm liên quan</span>
                    </h2>
                </div>
                <div class="owl-slick owl-products equal-container better-height" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;slidesToShow&quot;:4}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php $__currentLoopData = $productSame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-item style-01 post-22 product type-product status-publish has-post-thumbnail product_cat-table product_cat-bed product_cat-lamp product_tag-table product_tag-hat product_tag-sock first instock featured downloadable shipping-taxable purchasable product-type-simple">
                        <?php echo htmlProduct($k, $item); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            <?php
            $recently_viewed = Session::get('products.recently_viewed');
            if (!empty($recently_viewed)) {
                $recentlyProduct = \App\Models\Product::select('id', 'title', 'slug', 'price', 'price_sale', 'price_contact', 'image')
                    ->where(['alanguage' => config('app.locale'), 'publish' => 0])
                    ->whereIn('id', $recently_viewed)
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'desc')
                    ->with('getTags')
                    ->get();
            }
            ?>
            <?php if(!empty($recentlyProduct)): ?>
            <div class="col-md-12 col-sm-12 furgan_dreaming_upsell-product">
                <div class="block-title">
                    <h2 class="product-grid-title">
                        <span>Sản phẩm đã xem</span>
                    </h2>
                </div>
                <div class="owl-slick owl-products equal-container better-height" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;slidesToShow&quot;:4}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php $__currentLoopData = $recentlyProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="product-item style-01 post-22 product type-product status-publish has-post-thumbnail product_cat-table product_cat-bed product_cat-lamp product_tag-table product_tag-hat product_tag-sock first instock featured downloadable shipping-taxable purchasable product-type-simple">
                        <?php echo htmlProduct($k, $item); ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script>
    $(function($) {
        let url = "<?php echo route('routerURL', ['slug' => $detailCatalogue->slug]) ?>";
        $('.cat-item a').each(function() {
            if (this.href === url) {
                $(this).parent().addClass('current-cat');
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/product/frontend/product/index.blade.php ENDPATH**/ ?>