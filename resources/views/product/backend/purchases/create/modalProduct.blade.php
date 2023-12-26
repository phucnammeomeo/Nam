<div id="modal-select-products" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header flex items-center justify-between">
                <h2 class="font-medium text-base mr-auto">
                    Chọn nhiều sản phẩm
                </h2>
                <button type="button" data-tw-dismiss="modal" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body space-y-3">
                <div class="">
                    <input type="text" class="form-control js_searchProductModal" placeholder="Tìm kiếm sản phẩm">
                </div>
                <div id="loadDataModalProducts">
                    @include('product.backend.purchases.create.ajaxProductModal')
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Thoát</button>
                <button type="button" class="btn btn-primary js_addToCartModalProduct">Thêm vào đơn</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.js_handleSelectModalProduct', function() {
        var checkBoxes = $(this).parent().find('input');
        checkBoxes.prop("checked", !checkBoxes.prop("checked"))
    })

    $(document).on('keyup', '.js_searchProductModal', function() {
        getObjectModalProducts();
    })
    $(document).on('click', '.paginationModalProducts .pagination a', function(event) {
        event.preventDefault();
        console.log(1);
        var page = $(this).attr('href').split('page=')[1];
        getObjectModalProducts(page);
    });

    function getObjectModalProducts(page = 1) {
        let keyword = $('.js_searchProductModal').val();
        $.post("<?php echo route('product_purchases.ajaxListProducts') ?>", {
                keyword: keyword,
                type: 'ajaxProductModal',
                page: page,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                $('#loadDataModalProducts').html(data);
            });
    }
</script>