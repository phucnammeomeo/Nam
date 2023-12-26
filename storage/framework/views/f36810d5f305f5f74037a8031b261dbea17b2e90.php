<?php $__env->startSection('content'); ?>
<div class="banner-wrapper has_background">
    <img style="width: 100%;" src="<?php echo e(asset($fcSystem['banner_3'])); ?>" alt="Kết quả tìm kiếm" class="img-responsive attachment-1920x447 size-1920x447">
    <div class="banner-wrapper-inner">
        <h1 class="page-title">Kết quả tìm kiếm</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo url('') ?>">Trang chủ</a></li>
                <li><a href="javascript:void(0)" class="trail-item trail-end active">Kết quả tìm kiếm</a></li>
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
                        <select name="sortBy" class="SortBy orderby">
                            <option value="">Sắp xếp</option>
                            <option value="id|desc" <?php echo !empty(request()->get('sort') == 'id|desc"') ? 'selected' : '' ?>><?php echo e(trans('index.Latest')); ?></option>
                            <option value="id|asc" <?php echo !empty(request()->get('sort') == 'id|asc') ? 'selected' : '' ?>><?php echo e(trans('index.Oldest')); ?></option>
                            <option value="title|asc" <?php echo !empty(request()->get('sort') == 'title|asc') ? 'selected' : '' ?>><?php echo e(trans('index.NameAZ')); ?></option>
                            <option value="title|desc" <?php echo !empty(request()->get('sort') == 'title|desc') ? 'selected' : '' ?>><?php echo e(trans('index.NameZA')); ?></option>
                            <option value="price|asc" <?php echo !empty(request()->get('sort') == 'price|asc') ? 'selected' : '' ?>><?php echo e(trans('index.PricesGoUp')); ?></option>
                            <option value="price|desc" <?php echo !empty(request()->get('sort') == 'price|desc') ? 'selected' : '' ?>><?php echo e(trans('index.PricesGoDown')); ?></option>
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
    $(document).ready(function() {
        $(function() {
            $(document).on('change', '.SortBy', function() {
                var sort_by = $(this).val();
                window.location.href =
                    "<?php echo $seo['canonical'] ?>?keyword=<?php echo request()->get('keyword') ?>&category_id=<?php echo request()->get('category_id') ?>&sort=" +
                    sort_by;
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/product/frontend/search/index.blade.php ENDPATH**/ ?>