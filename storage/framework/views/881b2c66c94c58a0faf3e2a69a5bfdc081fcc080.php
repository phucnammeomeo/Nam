<?php $__env->startSection('content'); ?>
    <input type="hidden" value="<?php echo $detail->id; ?>" id="detailProductID">

    <div class="container mx-auto px-0 md:px-3" style="">
        <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">

            <?php echo $__env->make('homepage.common.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="w-full lg:w-4/5 px-0 md:px-[5px]">

                <div class="bg-white p-[10px]">
                    <?php echo $__env->make('homepage.common.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $detail->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('product.frontend.product.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="information-product mt-[10px] md:mt-[30px]  ">
                    <div class="flex flex-wrap justify-between ">
                        <div class="w-full md:w-1/2 ">
                            <h2 class=" py-[10px] px-[15px]  font-bold uppercase text-f18">
                                Thông tin sản phẩm
                            </h2>
                            <div class="p-[15px] bg-white h-full">
                                <div class="content-content">
                                    <?php echo $detail->content; ?>

                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 ">
                            <h2 class=" py-[10px] px-[15px]  font-bold uppercase text-f18">
                                Thông tin
                            </h2>
                            <div class="p-[15px] bg-white h-full">
                                <div class="content-content table">
                                    <?php echo showField($detail->postmetas, 'config_colums_editor_detail_product_info'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <?php if(!$productSame->isEmpty()): ?>
        <div class="other-product mt-[40px]">
            <div class="container mx-auto px-0 md:px-3">
                <div class="content-product mt-[30px] ">
                    <div class="title-title p-[10px] text-f18">
                        <a href="javascript:void(0)" class=" font-bold">Sản phẩm liên quan</a>
                    </div>
                    <div class=" bg-white">
                        <div class="slider-product-related owl-carousel">
                            <?php $__currentLoopData = $productSame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo htmlItemProduct($item, checkProductIncart($item->id, $cart['cart'])); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>
    <script>
        $(function($) {
            let url = "<?php echo route('routerURL', ['slug' => $detailCatalogue->slug]); ?>";
            $('.cat-item a').each(function() {
                if (this.href === url) {
                    $(this).parent().addClass('current-cat');
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>
    <style type="text/css">
        .content-content img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: auto !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vuong/domains/vuong.tamphat.edu.vn/public_html/resources/views/product/frontend/product/index.blade.php ENDPATH**/ ?>