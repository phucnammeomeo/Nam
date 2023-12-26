<div class="mt-5 space-y-2 scrollbar px-3" style="max-height:400px">
    <?php if(!$products->isEmpty()): ?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="border-b pb-2">
        <?php if(count($item->product_versions) > 0): ?>
        <div class="pl-0 lg:space-y-3 text-sm lg:text-base">
            <?php $__currentLoopData = $item->product_versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $title_version = collect(json_decode($val->title_version))->join(' - ', '');
            $price = !empty($val->price_import_version) ? $val->price_import_version : (!empty($item->price_import) ? $item->price_import : 0);
            $image = File::exists(base_path($val->image_version)) ? (!empty($val->image_version) ? asset($val->image_version) : (File::exists(base_path($item->image)) ? (!empty($item->image) ? asset($item->image) : asset('images/404.png')) : asset('images/404.png'))) : asset('images/404.png');
            ?>
            <div data-unit="<?php echo e($item->unit); ?>" data-image="<?php echo e($image); ?>" data-price="<?php echo e($price); ?>" data-id="<?php echo e($item->id); ?>" data-title-version="<?php echo e($title_version); ?>" data-id-version="<?php echo e($val->id_version); ?>" data-type="variable" class="text-sm lg:text-base grid space-x-2 lg:space-x-0 grid-cols-4 lg:grid-cols-12 items-center cursor-pointer js_handleSelectProducts">
                <div class="lg:col-span-1">
                    <img alt="<?php echo e($item->title); ?>" style="height:50px;width: 50px;object-fit: cover;" class="object-cover border" src="<?php echo e($image); ?>">
                </div>
                <div class="lg:col-span-6 ">
                    <span class="font-semibold"><?php echo e($item->title); ?></span><br>(<?php echo e($title_version); ?>)
                </div>
                <div class="lg:col-span-5 text-right">
                    <span class="text-danger font-semibold"><?php echo e(number_format($price,'0',',','.')); ?> đ</span><br>
                    <b>Số lượng:</b> <?php echo e($val->_stock); ?>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div data-unit="<?php echo e($item->unit); ?>" data-image="<?php echo e(asset($item->image)); ?>" data-price="<?php echo e($item->price_import); ?>" data-id="<?php echo e($item->id); ?>" data-type="simple" class="text-sm lg:text-base grid space-x-2 lg:space-x-0 grid-cols-4 lg:grid-cols-12 items-center cursor-pointer js_handleSelectProducts">
            <div class="lg:col-span-1">
                <img alt="<?php echo e($item->title); ?>" style="height:50px;width: 50px;object-fit: cover;" class="object-cover border" src="<?php echo e(File::exists(base_path($item->image)) ? (!empty($item->image)?asset($item->image): asset('images/404.png')) : asset('images/404.png')); ?>">
            </div>
            <div class="lg:col-span-6 font-semibold">
                <?php echo e($item->title); ?>

            </div>
            <div class="lg:col-span-5 text-right">
                <span class="text-danger font-semibold"><?php echo e(number_format($item->price_import,'0',',','.')); ?> đ</span><br>
                <b>Số lượng: </b><?php echo e($item->inventoryQuantity); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center paginationProducts">
    <?php echo e($products->links()); ?>

</div>
<?php $__env->startPush('javascript'); ?>
<!--START: script xử lí sản phẩm và cart -->
<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
    $(".js_search_products").focus(function() {
        $("#loadDataProducts").show()
    });
    var resultsSelected = false;
    $("#loadDataProducts").hover(
        function() {
            resultsSelected = true;
        },
        function() {
            resultsSelected = false;
        }
    );
    $(".js_search_products").blur(function() {
        if (!resultsSelected) { //if you click on anything other than the results
            $("#loadDataProducts").hide(); //hide the results
        }
    })
    $(document).on('click', '.js_close_listProduct', function() {
        $("#loadDataProducts").hide();
    })
    $(document).on('click', '.paginationProducts .pagination a', function(event) {
        event.preventDefault();
        console.log(1);
        var page = $(this).attr('href').split('page=')[1];
        getObjectProducts(page);
    });

    $('.js_search_products').keyup(delay(function(e) {
        e.preventDefault();
        getObjectProducts();
    }, 500));

    function getObjectProducts(page = 1) {
        let keyword = $('.js_search_products').val();
        $.post("<?php echo route('product_purchases.ajaxListProducts') ?>", {
                keyword: keyword,
                page: page,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                $('#loadDataProducts').html(data);
            });
    }
    $(document).on('click', '.js_handleSelectProducts', function(event) {
        event.preventDefault();
        $.post("<?php echo route('product_purchases.addToCartPurchases') ?>", {
                id: $(this).attr('data-id'),
                type: $(this).attr('data-type'),
                id_version: $(this).attr('data-id-version'),
                title_version: $(this).attr('data-title-version'),
                price: $(this).attr('data-price'),
                image: $(this).attr('data-image'),
                unit: $(this).attr('data-unit'),
                discountValue: $('input[name="discount[value]"]').val(),
                discountType: $('input[name="discount[type]"]').val(),
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if ($.isEmptyObject(data.error)) {
                    loadDataCartTP(data)
                } else {
                    swal({
                        title: "Thông báo!",
                        text: data.error,
                        type: "error"
                    });
                }
            });
    });


    function loadDataCartTP(data) {
        $('.js_totalPriceCart').html(numberWithCommas(data.total) + 'đ');
        $('.js_html_VAT').html('').html(data.htmlVAT);
        $('#listItemCart').html(data.html);
        $('.js_quantity_purchases').html(data.quantity);
        $('.js_provisional_purchases').html(numberWithCommas(data.provisional) + 'đ');

        $('.js_priceDiscount').html(numberWithCommas(data.priceDiscount) + 'đ')

        $("#loadDataProducts").hide();
    }
    $(document).on('change keyup', '.js_updateCartPurchase', function() {
        $.post("<?php echo route('product_purchases.ajaxUpdateCartPurchases') ?>", {
                type: "update",
                quantity: $(this).val(),
                rowid: $(this).attr('data-rowid'),
                discountValue: $('input[name="discount[value]"]').val(),
                discountType: $('input[name="discount[type]"]').val(),
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if ($.isEmptyObject(data.error)) {
                    loadDataCartTP(data)
                } else {
                    swal({
                        title: "Thông báo!",
                        text: data.error,
                        type: "error"
                    });
                }
            });
    })
    $(document).on('change', '.js_updateCartPricePurchase', function() {
        $.post("<?php echo route('product_purchases.ajaxUpdateCartPurchases') ?>", {
                type: "updatePrice",
                price: $(this).val(),
                rowid: $(this).attr('data-rowid'),
                discountValue: $('input[name="discount[value]"]').val(),
                discountType: $('input[name="discount[type]"]').val(),
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if ($.isEmptyObject(data.error)) {
                    loadDataCartTP(data)
                } else {
                    swal({
                        title: "Thông báo!",
                        text: data.error,
                        type: "error"
                    });
                }
            });
    })
    $(document).on('click', '.js_removeCartPurchase', function(e) {
        $.post("<?php echo route('product_purchases.ajaxUpdateCartPurchases') ?>", {
                type: "delete",
                rowid: $(this).attr('data-rowid'),
                discountValue: $('input[name="discount[value]"]').val(),
                discountType: $('input[name="discount[type]"]').val(),
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if ($.isEmptyObject(data.error)) {
                    loadDataCartTP(data)
                } else {
                    swal({
                        title: "Thông báo!",
                        text: data.error,
                        type: "error"
                    });
                }
            });
    })
    $(document).on('change', '.js_valueDiscountTP', function() {
        $.post("<?php echo route('product_purchases.addDiscount') ?>", {
                value: $(this).val(),
                type: $(this).attr('data-type'),
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if ($.isEmptyObject(data.error)) {
                    $('.js_priceDiscount').html(numberWithCommas(data.priceDiscount) + 'đ')
                    $('.js_totalPriceCart').html(numberWithCommas(data.total) + 'đ')
                    $('input[name="discount[value]"]').val(data.value);
                    $('input[name="discount[type]"]').val(data.type);
                    $('input[name="discount[price]"]').val(data.priceDiscount);
                    $(".js_htmlDiscount").hide();
                } else {
                    swal({
                        title: "Thông báo!",
                        text: data.error,
                        type: "error"
                    });
                }
            });
    })
    /*Xóa giỏ hàng */
</script>
<style>
    .lg\:pl-20 {
        padding-left: 5rem;
    }

    .pb-2 {
        padding-bottom: 0.5rem;
    }

    .cursor-no-drop {
        cursor: no-drop;
    }

    .hover\:text-white:hover {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
    }

    .hover\:bg-global:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(214 28 31 / var(--tw-bg-opacity));
    }

    .space-y-2> :not([hidden])~ :not([hidden]) {
        --tw-space-y-reverse: 0;
        margin-top: calc(0.5rem * calc(1 - var(--tw-space-y-reverse)));
        margin-bottom: calc(0.5rem * var(--tw-space-y-reverse));
    }

    .space-x-2> :not([hidden])~ :not([hidden]) {
        --tw-space-x-reverse: 0;
        margin-right: calc(0.5rem * var(--tw-space-x-reverse));
        margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
    }

    .stardust-icon {
        color: #ee4d2d;
    }

    .list_shipping_item {
        display: flex;
        flex: 1;
        background-color: #fafafa;
        box-shadow: inset 4px 0 0 #ee4d2d;
    }

    .list_shipping_item .priceA {
        color: #ee4d2d;
    }

    .scrollbar {
        overflow-y: overlay;
    }

    .scrollbar::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    .scrollbar::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    .scrollbar::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #D62929;
    }
</style>
<!--END script xử lí sản phẩm và cart -->

<?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/product/backend/purchases/products.blade.php ENDPATH**/ ?>