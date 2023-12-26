<?php
$menu_header = getMenus('menu-header');
?>

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

            #top-nav .sub-menu li>a:hover,
            #top-nav .sub-menu li.selected>a {
                background: #000f1d;
                color: #fff;
            }

            #primary-nav li a {
                color: #fff;
                padding: 10px;
            }

            #primary-nav li.active>a,
            #primary-nav li>a:hover,
            #primary-nav li.selected>a {
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

            #primary-nav.mobile li.selected>a {
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
            <a href="/" class="logo"><img src="{{ asset($fcSystem['homepage_logo']) }}" alt=""
                    class="inline-block" /></a>

                <a id="primary-nav-button1" href="{{ route('cart.index') }}"
                    class="text-f14 items-center mobile">
                    <span class="cart relative inline-block w-[45px]">
                        <i class="fa-solid fa-cart-shopping text-f20 mr-[5px]"></i>
                        <span
                            class="stt w-[20px] h-[20px] bg-red rounded-full text-white text-f12 inline-block text-center leading-[20px] top-[-7px] left-[19px] absolute count cart-quantity quantity">{{ $cart['quantity'] }}</span>
                    </span></a>
            <form action="{{ route('homepage.search') }}" method="get" class="mt-1">
                <input type="text" placeholder="Tìm kiếm" name="keyword" value="<?php echo request()->get('keyword'); ?>" style="width: 98%; border-radius: 10px"/>
            </form>
        </div>

        <nav id="primary-nav" class="dropdown cf mobile" style="display: none">

            @if (count($menu_header->menu_items) > 0)
                <ul class="dropdown menu">
                    <li>
                        @if(Auth::guard('customer')->user())
                            <a href="{{ route('customer.orders') }}">Tài khoản của bạn</a>
                        @else
                            <a href="{{ route('customer.login') }}">Đăng nhập</a>
                        @endif
                    </li>
                    @foreach ($menu_header->menu_items as $item)
                        <li>
                            <a href="{{ url($item->slug) }}">{{ $item->title }}</a>

                            @if (count($item->children) > 0)
                                <span class="downarrow"></span>
                                <ul class="sub-menu">
                                    @foreach ($item->children as $item2)
                                        <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                        <li style="margin-left: 30px">
                                            <a href="{{ url($item2->slug) }}" <?php echo $_blank_2; ?>>{{ $item2->title }}
                                            </a>
                                        </li>
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

</header>
