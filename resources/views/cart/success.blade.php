@extends('homepage.layout.home')
@section('content')
<main class="contact-btottom  bg-white p-[10px] mt-[20px]">
    <div class=" container mx-auto">
        <h1 class="uppercase w-full text-center font-bold text-2xl md:text-4xl py-4">{{$page->title}}</h1>
        <div class="text-center py-4">
            <?php echo $fcSystem['cart_1'] ?>
        </div>
        <div class=" text-center flex justify-center py-4 space-x-2">
            <a href="{{url('/san-pham')}}" class=" bg-red-600 text-white rounded-full px-6 py-2 w-auto">{{trans('index.ContinueShopping')}}</a>
            <a href="javascript:void(0)" onclick="PrintElem()" class="bg-blue-700 text-white rounded-full px-6 py-2 w-auto">{{trans('index.PrintOrder')}}</a>
        </div>
        <?php $cart = json_decode($detail->cart, TRUE); ?>
        <?php $coupon = json_decode($detail->coupon, TRUE); ?>

        <div class="main-contact">
            <div class="py-4 main-left">

                <div class="rounded-xl p-4 md:w-[736px] mx-auto">

                    <h2 class="text-xl font-medium w-full text-center mb-6">{{trans('index.DeliveryInformation')}}</h2>

                    <p>
                        {{trans('index.Fullname')}}: <strong>{{$detail->fullname}}</strong>
                    </p>
                    <p>
                        Email: <strong>{{$detail->email}}</strong>
                    </p>
                    <p>
                        {{trans('index.Phone')}}: <strong>{{$detail->phone}}</strong>
                    </p>
                    <p>
                        {{trans('index.Payments')}}: <strong>{{config('cart')['payment'][$detail->payment]}}</strong>
                    </p>
                    <p>
                        {{trans('index.DeliveryAddress')}}: <strong>{{$detail->address}}</strong>
                    </p>
                    <p>
                        {{trans('index.Ward')}}: <strong>{{!empty($detail->ward_name)?$detail->ward_name->name:''}}</strong>
                    </p>
                    <p>
                        {{trans('index.District')}}: <strong>{{!empty($detail->district_name)?$detail->district_name->name:''}}</strong>
                    </p>
                    <p>
                        {{trans('index.City')}}: <strong>{{!empty($detail->city_name)?$detail->city_name->name:''}}</strong>
                    </p>


                </div>

            </div>

            <div class="py-4 main-right">

                <div class="rounded-xl p-4 md:w-[736px] mx-auto">
                    <h2 class="text-xl font-medium w-full text-center mb-6">{{trans('index.InformationLine')}}</h2>

                    <div class="items-center">
                        <div class="col-start-3 col-span-3 mb-1" style="display: flex;width: 100%; border: solid 1px silver;">
                            <div class="p-2 text-center" style="width: 50%; border-right: solid 1px silver">
                                {{trans('index.ProductCode')}} #{{$detail->code}}
                            </div>

                            <div class="p-2 text-center" style="width: 50%;border-left: none">
                                {{trans('index.BookingDate')}} {{$detail->created_at}}
                            </div>
                        </div>

                        <div class="col-start-1 col-end-8 overflow-x-auto">
                            <table class="table table-aut">
                                <thead>
                                    <tr>
                                        <th>{{trans('index.ImageProduct')}}</th>
                                        <th>{{trans('index.TitleProduct')}}</th>
                                        <th>{{trans('index.Amount')}}</th>
                                        <th>{{trans('index.Price')}}</th>
                                        <th>{{trans('index.intomoney')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @if($cart)
                                    @foreach( $cart as $k=>$v)
                                    <?php
                                    $slug = !empty($v['slug']) ? route('routerURL', ['slug' => $v['slug']]) : 'javascript:void(0)';
                                    $options = !empty($v['options']) ? (!empty($v['options']['title_version']) ? $v['options']['title_version'] : '') : '';
                                    $unit = !empty($v['unit']) ? $v['unit'] : '';

                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{$slug}}" target="_blank"><img src="{{url($v['image'])}}" alt="{{$v['title']}}"></a><br>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{$slug}}" target="_blank">{{$v['title']}}</a><br>
                                            @if(!empty($options))
                                            <p>{{trans('index.Classify')}}: {{$options}} </p>
                                            @endif
                                        </td>
                                        <td class="text-center">{{$v['quantity']}}</td>
                                        <td class="text-center">{{number_format( $v['price'],0,'.',',')}}₫</td>

                                        <td class="text-center">{{number_format($v['quantity'] * $v['price'],0,'.',',')}}₫</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            {{trans('index.Provisional')}}
                                        </td>
                                        <td colspan="2" class="text-right">
                                            {{ number_format($detail->total_price) }}₫
                                        </td>
                                    </tr>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            {{trans('index.ShippingUnit')}}
                                        </td>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            {{ $detail->title_ship }}
                                        </td>
                                    </tr>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            {{trans('index.TransportFee')}}
                                        </td>
                                        <td colspan="2" class="text-right">
                                            {{ number_format($detail->fee_ship) }}₫
                                        </td>
                                    </tr>
                                    @if (isset($coupon))
                                    @foreach ($coupon as $v)
                                    <tr>
                                        <td colspan="3">{{trans('index.Discount')}}</span>
                                        </td>
                                        <td colspan="2" class="text-right">-<span class="amount cart-coupon-price">{{number_format($v['price'])}}₫</span></td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    @if($detail->payment == 'wallet')
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            {{trans('index.TotalAmount')}}
                                        </td>
                                        <td colspan="2" class="text-right">
                                            {{ number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship) }}₫
                                        </td>
                                    </tr>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            {{trans('index.Paid')}}
                                        </td>
                                        <td colspan="2" class="text-right">
                                            {{ number_format($detail->wallet) }}₫
                                        </td>
                                    </tr>
                                    @endif
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            {{trans('index.TotalMoneyPayment')}}
                                        </td>
                                        <td colspan="2" class="text-right font-bold text-red-600">
                                            {{ number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship-$detail->wallet) }}₫
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<style>

    .table {
        width: 100%;
        border-collapse:collapse;
        background: white;
        border:1px solid #ccc;
        table-layout: fixed;
    }

    .thank-box .table {
        margin: 1rem 0;
    }

    .table td,
    .table th {
        padding: 10px 20px !important;
        border:1px solid #ccc;
    }

    .table thead>tr th {
        background:white;
        font-weight: 700;
        border:1px solid #ccc;
    }

    .table tfoot{
        border-top: solid 1px silver;
    }


    .text--left {
        text-align: left;
    }

    /* .table tbody tr:nth-child(2n) td {
        background-color: #eee;
    } */

    .table tfoot td {
        /*color: #fff;
        background-color: #2f5acf;*/
        font-weight: 700;
    }

    .main-contact{
        display: flex;
        box-shadow: 0 0 6px 0 #00000026;
    }

    .main-left{
        width: 30%;
        margin-right:5px;
    }

    .main-right{
        width: 70%;
    }

    .rounded-xl{
        opacity: 0.8;
    }

    /*.rounded-xl strong{
        color: blue;
        opacity: 0.6;
    }*/

</style>


<div id="GFG" style="background-color: green;" class="hidden">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" dir="ltr" align="center" style="background-color:#fff;font-size:16px">
        <tb>
            <tr>
                <td align="left" valign="top" style="margin:0;padding:0">
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="720" bgcolor="#ffffff">
                        <tbody>
                            <tr>
                                <td>
                                    <div style="border:2px solid #2f5acf;padding:8px 16px;border-radius:16px;margin-top:16px">
                                        <p style="margin:10px 0 20px;font-weight:bold;font-size:20px;text-decoration: uppercase;">
                                            {{trans('index.InformationLine')}}
                                            <a href="javascript:void(0)">
                                                #{{$detail->code}}
                                            </a>
                                            <span style="font-weight:normal">({{$detail->created_at}})</span>
                                        </p>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td valign="top">
                                                        <p style="margin:10px 0;font-weight:bold">
                                                            <b>{{trans('index.BillingInformation')}}</b>
                                                        </p>
                                                        <p style="margin:10px 0">
                                                            <b>{{trans('index.Fullname')}}:</b> {{$detail->fullname}}
                                                        </p>
                                                        @if($detail->email)
                                                        <p style="margin:10px 0">
                                                            <b>Email:</b> <a href="mailto:{{$detail->email}}" target="_blank">{{$detail->email}}</a>
                                                        </p>
                                                        @endif
                                                        <p style="margin:10px 0">
                                                            <b>{{trans('index.Phone')}}:</b> {{$detail->phone}}
                                                        </p>
                                                    </td>
                                                    <td valign="top">
                                                        <p style="margin:10px 0;font-weight:bold">
                                                            <b>{{trans('index.DeliveryAddress2')}}</b>
                                                        </p>
                                                        <p style="margin:10px 0">
                                                            <b>{{trans('index.Fullname')}}:</b> {{$detail->fullname}}
                                                        </p>
                                                        @if($detail->email)
                                                        <p style="margin:10px 0">
                                                            <b>Email:</b> <a href="mailto:{{$detail->email}}" target="_blank">{{$detail->email}}</a>
                                                        </p>
                                                        @endif
                                                        <p style="margin:10px 0">
                                                            <b>{{trans('index.Phone')}}:</b> {{$detail->phone}}
                                                        </p>
                                                        <p style="margin:10px 0">
                                                            <b>{{trans('index.Address')}}:</b> {{$detail->address}}
                                                        </p>
                                                        @if(!empty($detail->ward_name))
                                                        <p>
                                                            <b>{{trans('index.Ward')}}:</b>
                                                            {{!empty($detail->ward_name)?$detail->ward_name->name:''}}
                                                        </p>
                                                        @endif
                                                        @if(!empty($detail->district_name))
                                                        <p>
                                                            <b>{{trans('index.District')}}:</b>
                                                            {{!empty($detail->district_name)?$detail->district_name->name:''}}
                                                        </p>
                                                        @endif
                                                        @if(!empty($detail->city_name))
                                                        <p>
                                                            <b>{{trans('index.City')}}:</b>
                                                            {{!empty($detail->city_name)?$detail->city_name->name:''}}
                                                        </p>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <p style="margin:10px 0">
                                                            <b>{{trans('index.PaymentMethods')}}:</b>
                                                            {{config('cart')['payment'][$detail->payment]}}
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <?php $cart = json_decode($detail->cart, TRUE); ?>
                            <?php $coupon = json_decode($detail->coupon, TRUE); ?>
                            <tr>
                                <td>
                                    <div style="border:2px solid #2f5acf;padding:8px 16px;border-radius:16px;margin-top:16px">
                                        <p style="margin:10px 0 20px;font-weight:bold;font-size:20px">
                                            {{trans('index.OrderDetails')}}
                                        </p>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size:14px">
                                            <thead>
                                                <tr>
                                                    <th width="150px" style="text-align:left">{{trans('index.TitleProduct')}}</th>
                                                    <th>{{trans('index.Amount')}}</th>
                                                    <th width="150px">{{trans('index.Price')}}</th>
                                                    <th style="text-align:right">{{trans('index.intomoney')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($cart)
                                                @foreach( $cart as $k=>$v)
                                                <?php
                                                $unit = !empty($v['unit']) ? $v['unit'] : '';
                                                $slug = !empty($v['slug']) ? route('routerURL', ['slug' => $v['slug']]) : 'javascript:void(0)';
                                                $options = !empty($v['options']) ? (!empty($v['options']['title_version']) ? $v['options']['title_version'] : '') : '';
                                                ?>
                                                <tr>
                                                    <td style="text-align:left">
                                                        <p style="margin:5px 0 0">
                                                            <a href="{{$slug}}" target="_blank">{{$v['title']}}</a>
                                                        </p>
                                                        @if(!empty($options))
                                                        <p style="margin-top:3px">
                                                            <span style="font-size:12px;display:block">
                                                                {{$options}}
                                                            </span>
                                                        </p>
                                                        @endif
                                                    </td>
                                                    <td style="text-align:center">
                                                        {{$v['quantity']}} {{$unit}}
                                                    </td>
                                                    <td style="text-align:center">
                                                        <b>
                                                            {{number_format( $v['price'],0,'.',',')}}₫
                                                        </b>

                                                    </td>
                                                    <td style="text-align:right">
                                                        {{number_format($v['quantity'] * $v['price'],0,'.',',')}}₫
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        <b>{{trans('index.Provisional')}}</b>
                                                    </td>
                                                    <td style="text-align:right">
                                                        {{ number_format($detail->total_price) }}₫
                                                    </td>
                                                </tr>
                                                @if (isset($coupon))
                                                @foreach ($coupon as $v)
                                                <tr>
                                                    <td colspan="3">
                                                        <b>{{trans('index.Discount')}}</b>
                                                    </td>
                                                    <td style="text-align:right">
                                                        - {{number_format($v['price'])}}₫
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                                <tr>
                                                    <td colspan="3"><b>{{trans('index.ShippingUnit')}}</b></td>
                                                    <td style="text-align:right">
                                                        {{ $detail->title_ship }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b>{{trans('index.TransportFee')}}</b></td>
                                                    <td style="text-align:right">
                                                        {{ number_format($detail->fee_ship) }}₫
                                                    </td>
                                                </tr>
                                                @if($detail->payment == 'wallet')
                                                <tr>
                                                    <td colspan="3"><b>{{trans('index.TotalAmount')}}</b></td>
                                                    <td style="text-align:right">
                                                        {{ number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship) }}₫
                                                    </td>
                                                </tr>

                                                <tr class="total_payment">
                                                    <td colspan="3">
                                                        {{trans('index.Paid')}}
                                                    </td>
                                                    <td colspan="2" class="text-right">
                                                        {{ number_format($detail->wallet) }}₫
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr class="total_payment">
                                                    <td colspan="3">
                                                        {{trans('index.TotalMoneyPayment')}}
                                                    </td>
                                                    <td colspan="2" class="text-right font-bold text-red-600">
                                                        {{ number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship-$detail->wallet) }}₫
                                                    </td>
                                                </tr>

                                            </tfoot>
                                        </table>

                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection

@push('javascript')
<script type="text/javascript">
    function PrintElem(elem) {
        const printContents = document.getElementById('GFG').innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endpush

@push('css')
{{-- <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet"> --}}
<style>
    .cartIndex button,
    .cartIndex input {
        padding: 0px !important;
        margin: 0 !important;
        background: transparent !important;
        border: 0px !important;
        color: #000;
        height: auto;
    }
</style>
@endpush
