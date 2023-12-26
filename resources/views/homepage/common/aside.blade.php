<?php

$productHighLight = getProductHighLight();

?>

<div class="w-1/5 px-[5px] hidden lg:block">

    @if( isset($showMenu) && ($showMenu == 'hide') )

    @include('homepage.common.menuProduct')

    @push('css')
        <style type="text/css">
            .menu-product-header {
                display: block;
                position: unset;
            }
        </style>
    @endpush

    @endif

    @if($productHighLight)

    <aside class="sidebar ">

        <div class="item-sb rounded-[5px] p-[10px] border border-gray-100 mt-[20px] bg-white">

            <h3 class="text-f15 font-bold uppercase mb-[15px]">

                SẢN PHẨM NỐI BẬT

            </h3>

            <div class="nav-item-sb">

                @foreach( $productHighLight as $key => $val )

                <?php $price = getPrice(array('price' => $val->price, 'price_sale' => $val->price_sale, 'price_contact' => $val->price_contact)); ?>

                <div class="item-1 flex flex-wrap mb-[15px] border-b border-gray-100 pb-[15px]">

                    <div class="img w-1/3 hover-zoom">

                        <a href="{{ route('routerURL', ['slug' => $val->slug]) }}">

                        <img src="{{ asset($val->image!=''?$val->image:'images/404.png') }}" alt="{{ $val->title }}" class="w-full object-cover" style="height: 65px;">

                        </a>

                    </div>

                    <div class="nav-img w-2/3 pl-[10px]">

                        <h3 class="text-f14  mb-[2px] leading-[20px] h-[40px] overflow-hidden">

                            <a href="{{ route('routerURL', ['slug' => $val->slug]) }}" class="hover:text-Pimary_color">{{ $val->title }}</a>

                        </h3>

                        <p class="price text-f14">

                            <span class="text-red-600 font-bold pr-[10px] inline-block">{{$price['price_final']}} </span>

                            <del class="text-gray-400 text-f13">{{$price['price_old']}}</del>

                        </p>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </aside>

    @endif

</div>

