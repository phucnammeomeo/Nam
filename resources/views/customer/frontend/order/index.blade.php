@extends('homepage.layout.home')
@section('content')
<?php
$today = \Carbon\Carbon::now();
if (config('app.locale') == 'en') {
    $_status = config('cart.status_en');
    $_payment = config('cart.payment_en');
} else if (config('app.locale') == 'tl') {
    $_status = config('cart.status_tl');
    $_payment = config('cart.payment_tl');
} else if (config('app.locale') == 'gm') {
    $_status = config('cart.status_gm');
    $_payment = config('cart.payment_gm');
} else {
    $_status = config('cart.status');
    $_payment = config('cart.payment');
}

?>
<div class="bg-amber-500 bg-sky-500 bg-green-500 bg-red-500 bg-orange-600 hidden"></div>

<main class="bg-white main-tttk">
    <div class="container px-4 mx-auto">
        <div class="flex flex-col md:flex-row items-start md:space-x-4 pt-10 pb-10 mb-pd-customer">
            @include('customer/frontend/auth/common/sidebar')
            <div class="flex-1 w-full md:w-auto order-1 md:order-1">
                <div class="overflow-x-hidden  rounded-xl  space-y-4">
                    <div class=" bg-white">
                        <h1 class="text-black font-bold text-xl">{{trans('index.PurchaseHistory')}}</h1>
                        <!-- Slider main container -->
                        @if($data)
                        <div class="mt-5 space-y-2">
                            <div class="flex flex-wrap md:flex-nowrap mb-10" style="border-bottom: solid 1px">
                                <a href="{{route('customer.orders')}}" class="menu_order flex-auto text-center font-medium hover:text-red-500 mb-5 mr-5 md:mb-0 md:mr-0">{{trans('index.All')}}</a>
                                @foreach(config('cart.status') as $key=>$val)
                                <a href="{{route('customer.orders',['status' => $key])}}" class="menu_order flex-auto text-center font-medium hover:text-red-500 mb-5 mr-5 md:mb-0 md:mr-0 @if(request()->get('status') == $key) active @endif">
                                    <?php echo $_status[$key] ?>
                                </a>
                                @endforeach
                            </div>
                            {{-- <div class="">
                                <form method="GET" action="" class="relative flex space-x-2">
                                    <input class="rounded-lg border h-11 flex-1 px-3 focus:outline-none hover:outline-none" placeholder="" name="date" value="{{request()->get('date')}}">
                                    <input class="hidden" type="hidden" value="{{request()->get('status')}}" name="status">
                                    <button type="submit" class="w-[100px] h-11 bg-red-600 text-white px-3 rounded-lg">
                                        {{trans('index.Search')}}
                                    </button>
                                </form>
                            </div> --}}
                            <div class="body-order">
                                <div class="table-product">
                                    <tr>
                                        <span>Mã đơn hàng</span>
                                        <span>Tổng tiền</span>
                                        <span>Ngày đặt hàng</span>
                                        <span>Phương thức thanh toán</span>
                                        <span>Trạng thái đơn hàng</span>
                                        <span>Xem</span>
                                    </tr>
                                </div>
                                <div class="listItem">
                                    @foreach($data as $item)
                                    <?php $edited_at =  Carbon\Carbon::parse($item->edited_at); ?>
                                    <?php $cart = json_decode($item->cart, TRUE); ?>
                                    <div class="itemCart mb-5 shadow p-2">

                                        <div class="flex md:items-center flex-col md:flex-row pb-2 ">
                                            <div>
                                                <b>#{{$item->code}}</b>
                                            </div>
                                        </div>

                                        <div class="flex md:items-center flex-col md:flex-row pb-2">
                                            @if($item->payment == 'wallet')
                                            <div class="flex">
                                                {{trans('index.TotalAmount')}}:
                                                <span class=""><?php echo number_format($item->total_price - $item->total_price_coupon + $item->fee_ship); ?>₫</span>
                                            </div>
                                            <div class="flex">
                                                {{trans('index.Paid')}}:<span class=""><?php echo number_format($item->wallet); ?>₫</span>
                                            </div>
                                            @endif
                                            <div class="flex">
                                                <span class="text-red-500 font-bold"><?php echo number_format($item->total_price - $item->total_price_coupon + $item->fee_ship - $item->wallet); ?>₫</span>
                                            </div>
                                        </div>

                                        <div class="flex md:items-center flex-col md:flex-row pb-2">
                                            <span class="text-xs">{{$item->created_at}}</span>
                                        </div>

                                        <div class="flex md:items-center flex-col md:flex-row pb-2">
                                            <div class="text-sm">{{$_payment[$item->payment]}}</div>
                                        </div>

                                        <div class="flex md:items-center flex-col md:flex-row pb-2">
                                            <span class=" font-bold rounded-xl p-1 text-f14 <?php echo config('cart.class')[$item->status] ?>">
                                                #{{$_status[$item->status]}}
                                            </span>
                                            @if($item->status == 'returns')
                                            @if(!empty($item->order_returns->status) == 1)
                                            <span class=" font-bold rounded-xl p-1 text-f14 bg-green-500">
                                                #{{trans('index.SuccessApproved')}}
                                            </span>
                                            @else
                                            <span class=" font-bold rounded-xl p-1 text-f14 bg-red-500">
                                                #{{trans('index.PendingApproved')}}
                                            </span>
                                            @endif
                                            @endif
                                        </div>

                                        <div class="flex md:items-center flex-col md:flex-row pb-2 " >
                                            <a href="{{route('customer.detailOrder',['id' => $item->id])}}" class="text-xs float-right font-bold h-9 leading-9  text-black bg-gray-300 cursor-pointer items-center rounded-md px-3" title="Xem chi tiết đơn hàng"><i class="fa fa-eye font-some"></i></a>
                                            {{-- <a href="{{route('customer.copyOrder',['id' => $item->id])}}" class="text-xs float-right font-bold h-9 leading-9  text-white bg-green-600 cursor-pointer items-center rounded-md px-3" title="Mua lại đơn hàng"><i class="fa fa-cart-arrow-down font-some"></i></a>
                                            <?php if ($today >= $item->created_at && $today < $edited_at && $item->status == 'wait') { ?>
                                                <a href="{{route('customer.editOrder',['id' => $item->id])}}" class="text-xs float-right font-bold h-9 leading-9  text-white bg-orange-400 cursor-pointer items-center rounded-md px-3" title="Chỉnh sửa đơn hàng"><i class="fa fa-edit font-some"></i></a>
                                                <a href="javascript:void(0)" class="text-xs float-right font-bold h-9 leading-9  text-white bg-global cursor-pointer items-center rounded-md px-3 js_delete_customer_cart" data-id="{{$item->id}}" title="Hủy đơn hàng"><i class="fa fa-ban font-some"></i></a>
                                            <?php } ?>
                                            @if($item->status == 'completed')
                                            <a href="javascript:void(0)" onclick="showModalOrderReturn({{$item->id}})" class="text-xs float-right font-bold h-9 leading-9  text-white bg-orange-400 cursor-pointer items-center rounded-md px-3">{{trans('index.ToReturn')}}</a>
                                            @endif --}}
                                        </div>


                                        {{-- <div class="mt-3 main-order">
                                            <?php $total = 0 ?>
                                            @if($cart)
                                            @foreach($cart as $k=>$val)
                                            <?php
                                            $slug = !empty($val['slug']) ? $val['slug'] : '';
                                            $options = !empty($val['options']['title_version']) ?  $val['options']['title_version'] : '';
                                            $unit = !empty($val['unit']) ? $val['unit'] : '';
                                            ?>
                                            <div class="grid grid-cols-5 mb-3 items-center">
                                                <div class="col-span-4">
                                                    <div class="fix-order">
                                                        <div class="image-product-order">
                                                            <a href="{{route('routerURL',['slug' => $slug])}}" target="_blank"><img src="{{asset($val['image'])}}" alt="{{$val['title']}}" class="w-20 h-20 object-cover img-product-order"></a>
                                                        </div>

                                                        <div class="ml-3 test-order">
                                                            <p><a class="font-semibold text-blue-500" href="{{route('routerURL',['slug' => $slug])}}" target="_blank">{{$val['title']}}</a></p>
                                                        </div>

                                                        <div class="col-span-1 flex justify-end test-order">
                                                            <span class="font-bold">{{number_format($val['price'],0,',','.')}}₫</span>
                                                        </div>

                                                        <div class="test-order">
                                                            @if($options)
                                                            <p class="text-sm">{{trans('index.Classify')}}: {{$options}}</p>
                                                            @endif
                                                            <p class="text-sm">{{$val['quantity']}}</p>
                                                        </div>

                                                    </div>
                                                    <div class="clear-both"></div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div> --}}

                                        <div class="clear-both"></div>
                                    </div>

                                    @endforeach
                                    <div class="flex justify-center">
                                        <?php echo $data->links() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="flex flex-col items-center ml-4  bg-white  rounded-xl mt-4 space-y-3">
                            <div class="bg-gray-100 rounded-full flex items-center justify-center w-[50px] h-[50px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-global" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <strong class="font-bold mb-2">{{trans('index.NoOrdersYet')}}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection
@push('javascript')
<script type="text/javascript" src="{{asset('library/daterangepicker/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('library/daterangepicker/daterangepicker.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('library/daterangepicker/daterangepicker.css')}}">
<script type="text/javascript">
    $(function() {
        $('input[name="date"]').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                separator: " to "
            }
        });
    });
</script>
<link href="{{asset('library/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('library/sweetalert/sweetalert.min.js')}}"></script>
<style>
    .menu_order.active {
        color: red;
        font-weight: bold;
    }
    .itemCart{
        display: flex;
        justify-content: space-between;
        flex-flow: row wrap;
        /*margin: 0 13px;*/
        border: unset;
        box-shadow: unset;
    }

    .iteamCart .flex-col{
        flex: 1 0;
    }

    .table-product{
        text-align: left;
        border-bottom: solid 1px;
    }

    .table-product span{
        margin: 0 3px 0 12px;
    }

    .body-order{
        border: solid 1px;
    }
    @media( max-width: 767px ){
        .mb-pd-customer{
            padding: 10px 0!important;
        }
    }
</style>
<script>
    var aurl = window.location.href; // Get the absolute url
    $('.menu_order').filter(function() {
        return $(this).prop('href') === aurl;
    }).addClass('active');
    $(".menu_item_auth:eq(2)").addClass('active');
    $(document).on('click', '.js_delete_customer_cart', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        swal({
                title: "<?php echo trans('index.AreYouSure') ?>",
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "<?php echo trans('index.Perform') ?>",
                cancelButtonText: "<?php echo trans('index.Cancel') ?>",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    let formURL = "<?php echo route('customer.deleteOrder') ?>";
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        url: formURL,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data.status === 200) {
                                swal({
                                    title: "<?php echo trans('index.DeleteSuccessfully') ?>",
                                    text: "<?php echo trans('index.DeleteSuccessfullyInfo') ?>",
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "<?php echo trans('index.DeleteSuccessfullyInfo2') ?>",
                                    text: "<?php echo trans('index.DeleteSuccessfullyInfo3') ?>",
                                    type: "error"
                                }, function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(jqXhr, json, errorThrown) {
                            var errors = jqXhr.responseJSON;
                            var errorsHtml = "";
                            $.each(errors["errors"], function(index, value) {
                                errorsHtml += value + "/ ";
                            });
                            console.log(errorsHtml)
                        },
                    });
                } else {
                    swal({
                        title: "<?php echo trans('index.Cancel') ?>",
                        text: "<?php echo trans('index.CancelInfo') ?>",
                        type: "error"
                    }, function() {
                        location.reload();
                    });
                }
            }
        );
    })
</script>
@include('customer.frontend.order.return')
@endpush
