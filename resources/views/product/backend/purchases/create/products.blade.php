<div class="mt-5 space-y-2 scrollbar px-3" style="max-height:400px">
    @if(!$products->isEmpty())
    @foreach($products as $item)
    <div class="border-b pb-2">
        @if(count($item->product_versions) > 0)
        <div class="pl-0 lg:space-y-3 text-sm lg:text-base">
            @foreach ($item->product_versions as $val)
            <?php
            $title_version = collect(json_decode($val->title_version))->join(' - ', '');
            $price = !empty($val->price_import_version) ? $val->price_import_version : (!empty($item->price_import) ? $item->price_import : 0);
            $image = File::exists(base_path($val->image_version)) ? (!empty($val->image_version) ? asset($val->image_version) : (File::exists(base_path($item->image)) ? (!empty($item->image) ? asset($item->image) : asset('images/404.png')) : asset('images/404.png'))) : asset('images/404.png');
            ?>
            <div data-unit="{{$item->unit}}" data-image="{{$image}}" data-price="{{$price}}" data-id="{{$item->id}}" data-title-version="{{$title_version}}" data-id-version="{{$val->id_version}}" data-type="variable" class="text-sm lg:text-base grid space-x-2 lg:space-x-0 grid-cols-4 lg:grid-cols-12 items-center cursor-pointer js_handleSelectProducts">
                <div class="lg:col-span-1">
                    <img alt="{{$item->title}}" style="height:50px;width: 50px;object-fit: cover;" class="object-cover border" src="{{$image}}">
                </div>
                <div class="lg:col-span-6 ">
                    <span class="font-semibold">{{$item->title}}</span><br>({{$title_version}})
                </div>
                <div class="lg:col-span-5 text-right">
                    <span class="text-danger font-semibold">{{number_format($price,'0',',','.')}} đ</span><br>
                    <b>Số lượng:</b> {{$val->_stock}}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div data-unit="{{$item->unit}}" data-image="{{asset($item->image)}}" data-price="{{$item->price_import}}" data-id="{{$item->id}}" data-type="simple" class="text-sm lg:text-base grid space-x-2 lg:space-x-0 grid-cols-4 lg:grid-cols-12 items-center cursor-pointer js_handleSelectProducts">
            <div class="lg:col-span-1">
                <img alt="{{$item->title}}" style="height:50px;width: 50px;object-fit: cover;" class="object-cover border" src="{{File::exists(base_path($item->image)) ? (!empty($item->image)?asset($item->image): asset('images/404.png')) : asset('images/404.png')}}">
            </div>
            <div class="lg:col-span-6 font-semibold">
                {{$item->title}}
            </div>
            <div class="lg:col-span-5 text-right">
                <span class="text-danger font-semibold">{{number_format($item->price_import,'0',',','.')}} đ</span><br>
                <b>Số lượng: </b>{{$item->inventoryQuantity}}
            </div>
        </div>
        @endif
    </div>
    @endforeach
    @endif
</div>
<div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center paginationProducts">
    {{$products->links()}}
</div>
@push('javascript')
<!--START: script xử lí sản phẩm và cart -->
<script>
    /*START: search product none modal */
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
        if (!resultsSelected) {
            $("#loadDataProducts").hide();
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
                type: 'products',
                page: page,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                $('#loadDataProducts').html(data);
            });
    }
    /*END: search product none modal */
    /*START: click item sản phẩm addtocart*/
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
    /*END: click item sản phẩm addtocart*/
    /*START: Submit Thêm vào đơn(modal products) */
    $(document).on('click', '.js_addToCartModalProduct', function(e) {
        var sList = [];
        $('input[name="checkboxItem"]:checked').each(function(i) {
            sList.push($(this).val());
        });
        $.post("<?php echo route('product_purchases.ajaxAddToCartModalPopup') ?>", {
                sList: sList,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if ($.isEmptyObject(data.error)) {
                    loadDataCartTP(data);
                    const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#modal-select-products"));
                    myModal.hide();
                } else {
                    swal({
                        title: "Thông báo!",
                        text: data.error,
                        type: "error"
                    });
                }
            });
    })
    /*END: Submit Thêm vào đơn(modal products) */

    /*START: Cập nhập giỏ hàng theo "Số lượng" */
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
    /*END: Cập nhập giỏ hàng theo "Số lượng" */
    /*START: Cập nhập giỏ hàng theo "Giá" */
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
    /*END: Cập nhập giỏ hàng theo "Giá" */
    /*START: Xóa giỏ hàng */
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
    /*END: Xóa giỏ hàng */
    /*START: Change input chiết khấu */
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
                    $('input[name="price_total"]').html(data.total)
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
    /*END: Change input chiết khấu*/
    /*START: Submit Áp dụng chi phí */
    $(document).on('submit', '#modal-add-surcharge form', function(e) {
        e.preventDefault();
        var sum = 0;
        var title = [];
        var price = [];
        $('input[name="surcharge[price]"]').each(function() {
            sum += Number($(this).val().replace(".", ""));
            price.push($(this).val())
        });
        $('input[name="surcharge[title]"]').each(function() {
            title.push($(this).val())
        });
        $.post("<?php echo route('product_purchases.ajaxSaveSessionSurcharge') ?>", {
                sum: sum,
                title: title,
                price: price,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                if ($.isEmptyObject(data.error)) {
                    loadDataCartTP(data);
                    $('.js_priceSurcharge').html(numberWithCommas(sum) + 'đ')
                    const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#modal-add-surcharge"))
                    myModal.hide()
                } else {
                    console.log(data.error);
                }
            });
    })
    /*END: Submit Áp dụng chi phí */
    function loadDataCartTP(data) {
        $('.js_totalPriceCart').html(numberWithCommas(data.total) + 'đ');
        $('input[name="price_total"]').val(data.total);

        $('input[name="price_suppliers"]').val(numberWithCommas(data.total))
        $('input[name="price_suppliers"]').attr('max', data.total)

        $('.js_html_VAT').html('').html(data.htmlVAT);
        $('#listItemCart').html(data.html);
        $('.js_quantity_purchases').html(data.quantity);
        $('.js_provisional_purchases').html(numberWithCommas(data.provisional) + 'đ');
        $('.js_priceDiscount').html(numberWithCommas(data.priceDiscount) + 'đ')
        $("#loadDataProducts").hide();
    }
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

@endpush