@extends('homepage.layout.home')
@section('content')
<div class="py-9 bg-white px-4 cartIndex">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 -mx-4 header-table">
            <div class="col-span-12 lg:col-span-3 px-4 order-last mt-8 lg:mt-0 header-table-cart">
                <div class="mt-4 lg:mt-0 header-table-cart-price flex" style="margin: 10px 0; border:solid 1px silver">
                    <div class="bg-slate-100 p-2 header-cart-price" style="width: 80%; margin-top: 10px;">
                        <ul class="flex flex-wrap items-center justify-between">
                            <li class="text-base font-semibold">{{trans('index.TotalNumberOfProducts')}}</li>
                            <li class="text-base font-semibold cart-quantity"><?php echo $cart['quantity'] ?>
                            </li>
                        </ul>
                        <?php $price_coupon = 0; ?>

                        <?php $price_coupon += !empty($v['price']) ? $v['price'] : 0; ?>
                        <input type="hidden" name="fee_ship" value="0">

                        <div class="cart-coupon-html">
                            @if (isset($coupon))
                            @foreach ($coupon as $v)
                            <?php $price_coupon += !empty($v['price']) ? $v['price'] : 0; ?>
                            <table>
                                <tr>
                                    <th>{{trans('index.DiscountCode')}} : <span class="cart-coupon-name">{{$v['name']}}</span></th>
                                    <td>-<span class="amount cart-coupon-price"><?php echo number_format($v['price'], 0, ',', '.') . '₫' ?></span>
                                        <a href="javascript:void(0)" data-id="{{$v['id']}}" class="remove-coupon text-global font-bold">[{{trans('index.Delete')}}]</a>
                                    </td>
                                </tr>
                            </table>
                            @endforeach
                            @endif
                        </div>

                        <div class="border-t  border-white py-5 mt-5">

                            <ul class="flex flex-wrap items-center justify-between">
                                <li class="text-base font-semibold">{{trans('index.TotalPrice')}}</li>
                                <li class="text-base font-semibold text-orange cart-total-final" style="color:#EE0033">
                                    <?php echo number_format($cart['total'] - $price_coupon, 0, ',', '.') . '₫' ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php if (in_array('coupons', $dropdown)) { ?>
                        <!-- START: mã giảm giá -->
                        {{-- <div class="mt-3 ">
                            <h3 class="text-md font-semibold capitalize mb-2">{{trans('index.EnterDiscountCode')}}</h3>
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative message-danger mb-2 hidden">
                                <strong class="font-bold">ERROR!</strong>
                                <span class="block sm:inline danger-title"></span>
                            </div>
                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md message-success mb-2 hidden">
                                <div class="flex">
                                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold success-title"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="relative">
                                <input id="coupon_code" class="border border-solid border-gray-300 w-full px-5 mb-5 placeholder-current text-dark h-12 focus:outline-none text-base" placeholder="" type="text">
                                <button type="button" id="apply_coupon" class="absolute top-0 right-0 h-12 inline-block bg-global leading-none py-4 px-2 text-sm text-white transition-all hover:bg-orange uppercase font-semibold hover:text-white">{{trans('index.Apply')}}</button>
                            </div>
                        </div> --}}
                    <?php } ?>

                    <!-- END: mã giảm giá -->

                    <div class="mt-3 mobi-full" style="width: 16%; margin: auto; height: 100%;">
                        <a href="{{url('/san-pham')}}" class="bg-ColorPrimary w-full text-center inline-block bg-dark leading-none py-4 px-5 md:px-8 text-sm text-white transition-all hover:bg-orange uppercase font-semibold hover:text-white bg-Pimary_color" style="height: 50%; line-height: 1.5; margin-bottom:10px; border-radius: 50px">{{trans('index.ContinueShopping')}}</a>

                            <a href="{{route('cart.checkout')}}"  class="bg-ColorPrimary w-full text-center inline-block bg-dark leading-none py-4 px-5 md:px-8 text-sm text-white transition-all hover:bg-orange uppercase font-semibold hover:text-white bg-Pimary_color btn-pay" style="height: 50%; line-height: 1.5; margin-bottom:10px; border-radius: 50px">{{trans('index.Pay')}}</a>

                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-9 px-4 table-product">
                <div class="overflow-x-auto relative" style="margin-bottom: 5px">
                    <table class="w-full min-w-max table-aut">
                        <thead>
                            <tr>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    {{trans('index.ImageProduct')}}
                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize" style="width:200px">
                                    {{trans('index.TitleProduct')}}
                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    {{trans('index.Price')}}
                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    {{trans('index.Amount')}}
                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    {{trans('index.intomoney')}}
                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    {{trans('index.Delete')}}
                                </th>
                            </tr>
                        </thead>
                        @if (!empty($cartController))
                            <tbody class="cart-html-cart">
                                @foreach($cartController as $k=>$item)
                                <?php
                                    echo htmlItemCart($k, $item);
                                ?>
                                @endforeach
                            </tbody>
                        @endif
                        @if (empty($cartController))
                            @push('css')
                            <style>
                                .btn-pay{
                                    pointer-events: none;
                                    opacity: 0.6;
                                }
                            </style>
                            @endpush
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

@endsection

