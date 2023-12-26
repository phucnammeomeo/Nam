@extends('dashboard.layout.dashboard')
@section('title')
<title>Tạo đơn nhập hàng</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách đơn nhập hàng",
        "src" => route('product_purchases.index'),
    ],
    [
        "title" => "Tạo đơn nhập hàng",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<div class="content">
    <div class=" flex items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Tạo đơn nhập hàng
        </h1>
    </div>
    <form id="formPurchases" class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('product_purchases.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="col-span-12 lg:col-span-8 space-y-3">
            <div class="hidden">
                <input type="text" class="" value="" placeholder="" name="suppliers_id">
            </div>
            <!-- BEGIN: Form Layout -->
            <div class="">
                @include('components.alert-error')
                @csrf
                <div class="alert alert-danger-soft show flex items-center mb-2 print-error-msg" role="alert" style="display: none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="alert-octagon" data-lucide="alert-octagon" class="lucide lucide-alert-octagon w-6 h-6 mr-2">
                        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span></span>
                </div>
            </div>
            <!-- START: Tìm kiếm nhà cung cấp -->
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin nhà cung cấp
                    </h2>
                </div>
                <div class="p-5 grid ">
                    <div class="relative">
                        <input autocomplete="off" class="form-control js_search_suppliers w-full" placeholder="Tìm kiếm nhà cung cấp theo SĐT, tên, mã nhà cung cấp, ..." type="text">
                        <div class="absolute top-10 left-0 w-full border shadow bg-white z-10" id="loadDataSuppliers" style="display: none;">
                            @include('product.backend.purchases.create.suppliers')
                        </div>
                    </div>
                    <!-- Thông tin chi tiết nhà cung cấp -->
                    <div class="mt-3" id="loadDataInfoSuppliers">
                    </div>
                    <!-- END-->
                </div>
            </div>
            <!-- END: Tìm kiếm nhà cung cấp -->
            <!-- START: Thông tin sản phẩm-->
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin sản phẩm
                    </h2>
                </div>
                <div class="p-5 grid ">
                    <div class="relative">
                        <div class="flex space-x-2">
                            <input autocomplete="off" class="form-control js_search_products w-full" placeholder="Tìm kiếm nhà cung cấp theo tên, mã sản phẩm, ..." type="text">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary w-24" data-tw-toggle="modal" data-tw-target="#modal-select-products">Chọn nhiều</a>
                        </div>
                        <div class="absolute top-10 left-0 w-full border shadow bg-white z-10" id="loadDataProducts" style="display: none;">
                            @include('product.backend.purchases.create.products')
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">Mã sản phẩm</th>
                                    <th class="whitespace-nowrap">Tên sản phẩm</th>
                                    <th class="text-center whitespace-nowrap">Đơn vị</th>
                                    <th class="text-center whitespace-nowrap">Số lượng </th>
                                    <th class="text-center whitespace-nowrap">Giá nhập</th>
                                    <th class="text-center whitespace-nowrap">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody id="listItemCart">

                            </tbody>

                        </table>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between p-4">
                        <span class="font-bold flex-1" style="text-align: right;border:0px">Số lượng</span>
                        <span style="text-align: center;;border:0px;width: 200px;" class="js_quantity_purchases">0</span>
                    </div>
                    <div class="flex justify-between p-4">
                        <span class="font-bold flex-1" style="text-align: right;;border:0px">Tổng tiền</span>
                        <span style="text-align: center;;border:0px;width: 200px;" class="js_provisional_purchases">0</span>
                    </div>
                    @include('product.backend.purchases.create.discount')
                    <div class="js_html_VAT">

                    </div>
                    @include('product.backend.purchases.create.surcharge')
                    <div class="flex justify-between p-4">
                        <div style="text-align: right;;border:0px" class="text-danger font-bold flex-1">Tiền cần trả</div>
                        <div style="text-align: center;;border:0px;width: 200px;" class="js_totalPriceCart">0</div>
                    </div>
                </div>
            </div>
            <!-- END: Thông tin sản phẩm-->
            <!-- START: THANH TOÁN -->
            <div class="box">
                <div class="flex flex-col sm:flex-row items-start md:items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400 gap-3">
                    <h2 class="font-medium text-base mr-auto">
                        THANH TOÁN
                    </h2>
                    <div class="label">
                        <input type="checkbox" class="js_handle_financialStatusValue" id="financialStatusValue" name="financialStatusValue" value="1">
                        <label for="financialStatusValue" class="cursor-pointer">
                            Thanh toán với nhà cung cấp
                        </label>
                    </div>
                </div>
                <div class="p-5 grid grid-cols-2 gap-3 hidden js_html_financialStatusValue">
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <label class="form-label text-base font-semibold">Hình thức thanh toán</label>
                            <?php echo Form::select('financialInfo[method]', $paymentMethod, '', ['class' => 'form-control']); ?>
                        </div>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <div>
                            <label class="form-label text-base font-semibold">Số tiền thanh toán</label>
                            <?php echo Form::text('price_suppliers', !empty(old('price_suppliers')) ? old('price_suppliers') : 0, ['class' => 'form-control float']); ?>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div>
                            <label class="form-label text-base font-semibold">Tham chiếu</label>
                            <?php echo Form::text('financialInfo[reference]', '', ['class' => 'form-control', 'placeholder' => 'Ví dụ: mã giao dịch ngân hàng,...']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: THANH TOÁN -->
            <!-- START: NHẬP KHO -->
            <div class="box">
                <div class="flex flex-col sm:flex-row items-start md:items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400 gap-3">
                    <h2 class="font-medium text-base mr-auto">
                        NHẬP KHO
                    </h2>
                    <div class="label">
                        <label class="cursor-pointer">
                            <input type="checkbox" value="1" name="receiveStatusValue">
                            Nhập hàng vào kho
                        </label>
                    </div>
                </div>
            </div>
            <!-- END: NHẬP KHO -->
            <!-- END: Form Layout -->
            <div class="hidden md:flex justify-end">
                <button type="submit" class="btn btn-primary js_submitStorePurchases">Đặt hàng và duyệt</button>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4">
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin đơn nhập hàng
                    </h2>
                </div>
                <div class="p-5 space-y-3">
                    <div>
                        <label class="form-label text-base font-semibold">Mã đơn nhập hàng</label>
                        <?php echo Form::text('code', !empty(old('code')) ? old('code') : CodeRender('purchases'), ['class' => 'form-control']); ?>
                    </div>
                    <div>
                        <label class="form-label text-base font-semibold">Chi nhánh</label>
                        <select class="tom-select tom-select-custom w-full tomselected" data-placeholder="Tìm kiếm chi nhánh..." name="address_id" id="tomselect-1" tabindex="-1" hidden="hidden">
                            <?php if (in_array('addresses', $dropdown)) { ?>
                                @if(!empty($listAddress))
                                @foreach($listAddress as $item)
                                <option value="{{$item->id}}" @if($item->active ==1) selected @endif>{{$item->title}}</option>
                                @endforeach
                                @endif
                            <?php } ?>
                        </select>
                    </div>
                    <div class="">
                        <label class="form-label text-base font-semibold">Ghi chú</label>
                        <?php echo Form::textarea('note', old('note'), ['class' => 'form-control w-full', 'placeholder' => '']); ?>
                    </div>
                    <div>
                        <label class="form-label text-base font-semibold">Tham chiếu</label>
                        <?php echo Form::text('reference', old('reference'), ['class' => 'form-control w-full', 'placeholder' => '']); ?>
                    </div>
                    <div class="">
                        <label class="form-label text-base font-semibold">Ngày hẹn giao</label>
                        <?php echo Form::text('dueOn', !empty(old('dueOn')) ? old('dueOn') : date('Y-m-d'), ['class' => 'form-control w-full datetimepicker', 'placeholder' => '']); ?>
                    </div>
                    <div class="flex md:hidden text-right">
                        <button type="submit" class="btn btn-primary js_submitStorePurchases">Đặt hàng và duyệt</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('javascript')
<!-- STARt: Modal select product -->
@include('product.backend.purchases.create.modalProduct')
<!-- END: Modal select product -->
<style>
    .table-report:not(.table-report--bordered):not(.table-report--tabulator) td:first-child {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
        text-align: center;
    }

    .table-report:not(.table-report--bordered):not(.table-report--tabulator) td:first-child {
        border-left-width: 0px;
    }

    .table-report:not(.table-report--bordered):not(.table-report--tabulator) td:last-child {
        border-right-width: 0px;
    }

    .table-report:not(.table-report--bordered):not(.table-report--tabulator) td:last-child {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    @media (min-width: 767px) {
        .md\:hidden {
            display: none;
        }
    }

    .pagination .page-item.active .page-link {
        font-weight: 500;
        background: rgb(var(--color-primary) / var(--tw-bg-opacity));
        color: #fff;
    }
</style>
<script type="text/javascript" src="{{asset('library/datetimepicker/jquery.datetimepicker.full.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('library/datetimepicker/jquery.datetimepicker.min.css')}}" />
<script type="text/javascript">
    $.datetimepicker.setLocale('vi');
    $('.datetimepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        minDate: 0
    });
</script>
<!-- START: Nhà cung cấp -->
<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    $(".js_search_suppliers").focus(function() {
        $("#loadDataSuppliers").show()
    });
    var resultsSelected = false;
    $("#loadDataSuppliers").hover(
        function() {
            resultsSelected = true;
        },
        function() {
            resultsSelected = false;
        }
    );
    $(".js_search_suppliers").blur(function() {
        if (!resultsSelected) { //if you click on anything other than the results
            $("#loadDataSuppliers").hide(); //hide the results
        }
    })
    $(document).on('click', '.js_handle_suppliers', function() {
        $("#loadDataSuppliers").hide();
        var id = $(this).attr('data-id');
        let data = $(this).attr('data-info');
        data = window.atob(data); //decode base64
        let json = JSON.parse(data);
        var item = '';
        item = item + ' <div class="flex items-center justify-between">';
        item = item + '<div class="item flex items-center hover:text-danger cursor-pointer js_handleCloseInfoSuppliers">';
        item = item + '<div class="w-10 h-10 rounded-full">';
        item = item + '<img src="https://ui-avatars.com/api/?name=' + json.title + '" class="rounded-full w-full">';
        item = item + '</div>';
        item = item + '<div class="flex items-center">';
        item = item + '<span class="mx-2 font-bold text-danger">';
        item = item + json.title;
        item = item + '</span>';
        item = item + '<span class=" ml-2 font-bold text-danger">';
        item = item + '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>';
        item = item + '</span>';
        item = item + '</div>';
        item = item + '</div>';
        item = item + '<div>';
        item = item + 'Công nợ: <b>' + numberWithCommas(json.debt) + '₫</b>';
        item = item + '</div>';
        item = item + '</div>';
        item = item + '<div class="mt-3 border-t pt-3">';
        item = item + '<h2 class="font-medium text-base mr-auto">';
        item = item + 'Thông tin chi tiết:';
        item = item + '</h2>';
        item = item + '<div>';
        item = item + '<p>Mã nhà cung cấp: ' + json.code + '</p>';
        item = item + '<p> Số điện thoại: ' + json.phone + '</p>';
        item = item + '<p>Email: ' + json.email + '</p>';
        item = item + '<p>Địa chỉ: ' + json.address + '</p>';
        item = item + '</div>';
        item = item + '</div>';
        setTimeout(function() {
            $('.js_search_suppliers').hide();
            $('#loadDataInfoSuppliers').html(item);
            $('input[name="suppliers_id"]').val(id);
        }, 100); //sau 100ms thì mới thực hiện
    })
    $(document).on('click', '.js_handleCloseInfoSuppliers', function(event) {
        $('#loadDataInfoSuppliers').html('');
        $('.js_search_suppliers').show();
        $('input[name="suppliers_id"]').val('');

    });
    $(document).on('click', '.paginationSuppliers .pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getObjectSuppliers(page);
    });

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
    $('.js_search_suppliers').keyup(delay(function(e) {
        e.preventDefault();
        getObjectSuppliers();
    }, 500));

    function getObjectSuppliers(page = 1) {
        let keyword = $('.js_search_suppliers').val();
        let ajaxUrl = "<?php echo route('product_purchases.ajaxListSuppliers') ?>";
        $.post(ajaxUrl, {
                keyword: keyword,
                page: page,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                $('#loadDataSuppliers').html(data);
            });
    }
</script>
<!-- END: Nhà cung cấp -->
<!-- START: Click "THANH TOÁN" show to div -->
<script>
    $(document).on('change', '.js_handle_financialStatusValue', function(event) {
        event.preventDefault();
        var value = $('input[name="financialStatusValue"]:checked').val();
        if (value == 1) {
            $('.js_html_financialStatusValue').removeClass('hidden')
        } else {
            $('.js_html_financialStatusValue').addClass('hidden')
        }
    });
</script>
<!-- END: Click "THANH TOÁN" -->
<!-- START: keyup price_suppliers check-->
<script>
    $(document).on('keyup', 'input[name="price_suppliers"]', function(event) {
        event.preventDefault();
        var value = $(this).val().replace('.', "");
        var max = Number($(this).attr('max'));
        if (value > max) {
            $(this).val(numberWithCommas(max));
        } else {
            $(this).val(numberWithCommas(value));
        }
    });
</script>
<div id="warning-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="x-circle" data-lucide="x-circle" class="lucide lucide-x-circle w-16 h-16 text-danger mx-auto mt-3">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                    <div class="text-3xl mt-5">Lỗi...</div>
                    <div class="text-slate-500 mt-2 print-error-msg text-lg"></div>
                </div>
                <div class="px-5 pb-8 text-center"> <button type="button" data-tw-dismiss="modal" class="btn w-24 btn-primary">Đóng</button> </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".js_submitStorePurchases").click(function(e) {
        $.ajax({
            url: "<?php echo route('product_purchases.validateForm') ?>",
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                suppliers_id: $("input[name='suppliers_id']").val(),
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    $('#formPurchases').submit();
                } else {
                    $("#warning-modal-preview .print-error-msg").html(data.error);
                    const myModalError = tailwind.Modal.getOrCreateInstance(document.querySelector("#warning-modal-preview"));
                    myModalError.show();
                    return false;
                }
            }
        });
        return false;
    });
</script>
<!-- END: keyup price_suppliers check-->

@endpush