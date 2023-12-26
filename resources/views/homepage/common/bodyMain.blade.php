<div id="main" class="sitemap">
    <div class="main-content">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-5px]">
                @include('homepage.common.menuProduct')
                <div class="w-full px-[5px]">
                    <div class="content-right">

{{--                        @include('homepage.common.navbar')--}}

{{--                        @include('homepage.common.slide')--}}

                        @yield('content')

                        @include('homepage.common.menuFooter')

                        @include('homepage.common.copyright')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

