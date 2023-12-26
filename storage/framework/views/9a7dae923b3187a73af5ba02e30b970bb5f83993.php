<?php $__env->startSection('content'); ?>
    <input type="hidden" value="<?php echo $detail->id; ?>" id="detailProductID">

    <div class="bg-white p-[10px] mt-[20px]">
        <?php echo $__env->make('product.frontend.product.data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="information-product mt-[10px] md:mt-[30px] border border-gray-100">
            <h2 class="border-l-[2px] border-Pimary_color border-b  py-[10px] px-[15px]  font-bold uppercase text-f18">
                Thông tin sản phẩm
            </h2>
            <div class="p-[15px]">
                <div class="content-content">
                    <p>
                        <?php echo $detail->content; ?>
                    </p>
                </div>
            </div>
        </div>


        <?php if(!$productSame->isEmpty()): ?>
            <div class="product-other mt-[30px]">
                <h2 class="border-l-[2px] border-Pimary_color border-b  py-[10px] px-[15px]  font-bold uppercase text-f18">
                    Sản phẩm tương tự
                </h2>

                <div class="slider-raleted-product owl-carousel mt-[20px]">
                    <?php $__currentLoopData = $productSame; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item border border-gray-100 p-[10px]">
                            <?php echo htmlProduct($key, $item); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>
        <?php endif; ?>


    </div>
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

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/product/frontend/product/index.blade.php ENDPATH**/ ?>