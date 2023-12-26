<?php
$menu_header = getMenus('menu-header');
?>
{{--Header--}}
<header class="hidden md:block">
    <div class="top-header bg-Pimary_color">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-5px]">
                <div class="w-1/5 px-[5px]">
                    <div class="main-logo" style="height: 126px">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset($fcSystem['homepage_logo']) }}" alt="{{ $fcSystem['homepage_company'] }}" style="height: 100% ; margin:auto"/>
                        </a>
                    </div>
                </div>
                <div class="w-3/5 px-[5px]" style="margin: auto">
                    <div class="flex flex-wrap justify-between mx-[-15px]">
                        <div class="w-3/5 px-[15px]">
                            <div class="main-search relative">
                                <form action="<?php echo route('homepage.search') ?>">
                                    @csrf
                                    <div class="relative inline-block w-full mt-[4px] click-search cursor-pointer">
                                        <input type="text" name="keyword" value="{{ request()->keyword }}" placeholder="{{ $fcSystem['title_1'] }}" style="height: 40px" class="search-keyword text-f13 border border-gray-100 rounded-[20px] w-full pl-[35px] cursor-pointer"/>
                                        <button type="submit" class="absolute top-[10px] left-[13px]">
                                            <i class="fa-solid fa-magnifying-glass text-f13 text-gray-400"></i>
                                        </button>
                                    </div>
                                    @include('homepage.common.advanceSearch')
                                </form>
                            </div>
                        </div>
                        <div class="w-2/5 px-[15px]">
                            <div class="main-search cursor-pointer">
                                <div class="relative inline-block w-full mt-[4px] modal-toggle">
                                 <span class="text-f14 border border-gray-100 rounded-[20px] w-full inline-block h-[40px] leading-[40px] text-Pimary_color bg-white pl-[35px]">Giao hàng</span>
                                    <button class="absolute top-[10px] left-[13px]">
                                        <i class="fa-solid fa-location-dot text-f15 text-Pimary_color"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-1/5 px-[5px]">
                    <div class="cart-header flex flex-wrap justify-end items-center h-full">
                        @include('homepage.common.headerCart')
                        <a href="{{ (!empty(Auth::guard('customer')->user()->id)) ? route('customer.dashboard') : route('customer.login') }}" class="text-f14 text-white flex items-center">
                            <i class="fa-solid fa-user text-f18 mr-[5px]"></i>
                            <span class="text-f14 title-span">Đăng nhập</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Modal toggle -->
<header class="block md:hidden header-mobile">
    <div class="relative flex justify-center px-2 py-[10px] header-22">
        <style>
            /* Micro Clearfix */
            .cf:before,
            .cf:after {
                content: "";
                display: table;
                visibility: hidden;
            }

            .cf:after {
                clear: both;
            }

            .cf {
                *zoom: 1;
            }

            .wrap {
                text-align: center;
            }

            .menu li {
                float: left;
                margin-right: 10px;
                position: relative;
            }

            .menu li:last-child {
                margin-right: 0;
            }

            .menu .sub-menu li {
                width: 100%;
            }

            .menu li a {
                display: block;
                text-decoration: none;
            }

            #top-nav li a {
                color: rgba(51, 51, 51, 0.9);
                padding: 5px 0;
            }

            #top-nav .sub-menu {
                background: #fff;
            }

            #top-nav .sub-menu li a {
                padding: 5px;
            }

            #top-nav .sub-menu li > a:hover,
            #top-nav .sub-menu li.selected > a {
                background: #000f1d;
                color: #fff;
            }

            #primary-nav li a {
                color: #fff;
                padding: 10px;
            }

            #primary-nav li.active > a,
            #primary-nav li > a:hover,
            #primary-nav li.selected > a {
                background: #000f1d;
                color: #fff;
            }

            .downarrow {
                background: none;
                display: inline-block;
                padding: 0;
                text-align: center;
                min-width: 3px;
            }

            .sub-menu .downarrow {
                position: absolute;
                right: 0;
                padding-right: 10px;
            }

            .downarrow:before {
                content: "\25be";
                color: inherit;
                display: block;
                font-family: sans-serif;
                font-size: 1em;
                line-height: 1.1;
                width: 1em;
                height: 1em;
            }

            .menu .sub-menu {
                display: none;
                position: absolute;
                left: 0;
                max-height: 1000px;
            }

            .menu .sub-menu.hide {
                display: none;
            }

            #primary-nav .sub-menu {
                background: #000f1d;
                min-width: 150px;
                z-index: 200;
            }

            #primary-nav.mobile ul {
                width: 100%;
            }

            #primary-nav .sub-menu li {
                border-bottom: 1px solid rgba(51, 51, 51, 0.9);
            }

            #primary-nav .sub-menu li:last-child {
                border-bottom: 0;
            }

            #primary-nav .sub-menu .downarrow:before {
                content: "\25b8";
            }

            #primary-nav.mobile {
                display: none;
                position: absolute;
                top: 100%;
                background: #000f1d;
                width: 100%;
                z-index: 999;
            }

            #primary-nav.mobile li {
                width: 100%;
                margin: 0;
                border-bottom: 1px solid rgba(51, 51, 51, 0.9);
            }

            #primary-nav.mobile li.selected > a {
                border-bottom: 1px solid rgba(51, 51, 51, 0.9);
            }

            #primary-nav.mobile li:last-child {
                border: none;
            }

            #primary-nav.mobile li a {
                padding: 5%;
            }

            #primary-nav.mobile .sub-menu li a {
                padding-left: 7%;
            }

            #primary-nav.mobile .sub-menu .submenu li a {
                padding-left: 9%;
            }

            #primary-nav.mobile .sub-menu .sub-menu .sub-menu li a {
                padding-left: 11%;
            }

            #primary-nav.mobile .sub-menu {
                float: left;
                position: relative;
                width: 100%;
            }

            .mobile .downarrow,
            .mobile .sub-menu .downarrow {
                position: absolute;
                right: 0;
                padding-right: 5%;
            }

            #primary-nav.mobile .sub-menu .downarrow:before {
                content: "\25be";
            }

            #primary-nav-button.mobile {
                display: inline-block;
            }
        </style>
        <div class="w-full text-center">
            <button id="primary-nav-button" type="button" class="mobile float-right mt-[13px]">
                <span><i class="fa-solid fa-bars"></i></span>
            </button>
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ $fcSystem['homepage_logo'] }}" alt="{{ $fcSystem['homepage_company'] }}" class="inline-block"/>
            </a>
        </div>
        <nav id="primary-nav" class="dropdown cf mobile" style="display: none">
            @if( $menu_header )
                <ul class="dropdown menu">
                    @foreach( $menu_header->menu_items as $key => $val )
                        <li>
                            <a href="{{ url($val->slug) }}">
                                {{ $val->title }}
                                @if( !$val->children->isEmpty() )
                                    <span class="downarrow"></span>
                                @endif
                            </a>
                            @if( !$val->children->isEmpty() )
                                <ul class="sub-menu">
                                    @foreach( $val->children as $keyC => $valC )
                                        <li><a href="{{ url($valC->slug) }}">{{ $valC->title }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </nav>
        <!-- / #primary-nav -->
    </div>
    <div class="px-[10px]"></div>

    <div class="pb-[10px]">
        <div class="main-search relative px-[10px]">
            <form action="<?php echo route('homepage.search') ?>">
                <div class="relative inline-block w-full mt-[4px] click-search cursor-pointer">
                    @csrf
                    <input type="text" placeholder="{{ $fcSystem['title_1'] }}" style="height: 40px" class="search-keyword text-f13 border border-gray-100 rounded-[20px] w-full pl-[35px] cursor-pointer"/>
                    <button class="absolute top-[10px] left-[13px]">
                        <i class="fa-solid fa-magnifying-glass text-f13 text-gray-400"></i>
                    </button>
                </div>
                @include('homepage.common.advanceSearch')
            </form>
        </div>

        <div class="main-search px-[10px] ">
            <div class="relative inline-block w-full mt-[4px] modal-toggle">
                 <span class="text-f14 border border-gray-100 rounded-[20px] w-full inline-block h-[40px] leading-[40px] text-Pimary_color bg-white pl-[35px]">Giao hàng</span>
                <button class="absolute top-[10px] left-[13px]">
                    <i class="fa-solid fa-location-dot text-f15 text-Pimary_color"></i>
                </button>
            </div>
        </div>
    </div>
</header>
