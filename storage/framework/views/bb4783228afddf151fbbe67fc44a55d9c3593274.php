<?php $__env->startSection('content'); ?>
<div class="banner-wrapper has_background">
    <img style="width: 100%;" src=" <?php echo e(!empty($detail->banner) ? (!empty(File::exists(base_path($detail->banner)))?asset($detail->banner):asset($fcSystem['banner_3'])) : asset($fcSystem['banner_3'])); ?>" alt="<?php echo e($detail->title); ?>" class="img-responsive attachment-1920x447 size-1920x447">
    <div class="banner-wrapper-inner">
        <h1 class="page-title"><?php echo e($detail->title); ?></h1>
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
<div class="main-container shop-page no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="shop-control shop-before-control">
                    <div class="grid-view-mode">
                        <form>
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" class="modes-mode mode-grid display-mode active" value="grid">
                                <span class="button-inner">
                                    Shop Grid
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" class="modes-mode mode-list display-mode " value="list">
                                <span class="button-inner">
                                    Shop List
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                        </form>
                    </div>
                    <form class="furgan-ordering" method="get">
                        <select name="sortBy" class="filter orderby">
                            <option value="">Sắp xếp</option>
                            <option value="id|desc"><?php echo e(trans('index.Latest')); ?></option>
                            <option value="id|asc"><?php echo e(trans('index.Oldest')); ?></option>
                            <option value="title|asc"><?php echo e(trans('index.NameAZ')); ?></option>
                            <option value="title|desc"><?php echo e(trans('index.NameZA')); ?></option>
                            <option value="price|asc"><?php echo e(trans('index.PricesGoUp')); ?></option>
                            <option value="price|desc"><?php echo e(trans('index.PricesGoDown')); ?></option>
                        </select>
                    </form>
                </div>
                <div class="auto-clear equal-container better-height furgan-products">
                    <ul class="row products columns-3" id="js_data_product_filter">
                        <?php if($data): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">
                            <?php echo htmlProduct($key, $item); ?>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php echo $data->links() ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('product.frontend.category.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('javascript'); ?>
<script>
    $(document).on('click', '.modes-mode', function(e) {
        $('.modes-mode').removeClass('active')
        $(this).addClass('active')
        var type = $(this).attr('value');
        if (type == 'grid') {
            $('#js_data_product_filter li').attr('class', '').addClass('grid-item product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes')
        } else if (type == 'list') {
            $('#js_data_product_filter li').attr('class', '').addClass('list-item product-item wow fadeInUp product-item rows-space-30 col-bg-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-ts-12 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes')
        }
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/product/frontend/category/index.blade.php ENDPATH**/ ?>