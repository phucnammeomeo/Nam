<?php

$mainMenu = getMenus('menu-header');

?>

<div class="top-content border-b border-gray-300 bg-white">

    <div class="container mx-auto px-3">

        <div class="flex flex-wrap justify-between mx-[-5px]">

            <div class="w-1/5 px-[5px]">

                <h3 class="text-f15  py-[10px] px-[15px] h-full cursor-pointer open-menu-category" style="border-radius: 5px 5px 0 0 ">

                    <i class="fa-solid fa-bars mr-[8px]"></i>Danh mục sản phẩm

                </h3>

            </div>

            <div class="w-4/5 px-[5px]">

                <div class="main-menu-pr hidden lg:block">

                    <div class="main-menu">

                        @if( $mainMenu )

                        <ul class="flex lg:flex-grow md:space-x-0 lg:space-x-4 flex-wrap">

                            @foreach( $mainMenu->menu_items as $key => $val )

                            <li class="group relative">

                                <a href="{{ url($val->slug) }}" class="inline-block px-[5px] lg:px-[6px] py-[10px] text-f15 transition-all hover:text-Pimary_color">

                                    <span class="lg:mt-0 hover:text-blue003">

                                        @if( $val->image != '' )

                                        <span class="mr-[3px]"><img src="{{ $val->image }}" alt="{{ $val->title }}" style="display: inline-block;width: 20px;height: 20px;object-fit: contain;position: relative;top: -1px"></span>

                                        @endif

                                        {{ $val->title }}

                                        @if( !$val->children->isEmpty() )

                                        <span class="text-f11 ml-[5px]"><i class="fa-solid fa-chevron-down"></i></span>

                                        @endif

                                    </span>

                                </a>

                                @if( !$val->children->isEmpty() )

                                <ul class="group-hover:block hidden absolute dropdown left-0 top-full z-30 bg-white submenu shadow">

                                    @foreach( $val->children as $keyC => $valC )

                                    <li>

                                        <a href="{{ url($valC->slug) }}" class="hover:text-white text-f15 inline-block py-[10px] px-[15px] hover:bg-Pimary_color w-full">{{ $valC->title }}</a>

                                    </li>

                                    @endforeach

                                </ul>

                                @endif

                            </li>

                            @endforeach

                        </ul>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="container mx-auto px-0 md:px-3">

    <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">

        <div class="w-1/5 px-[5px] hidden lg:block">

            @if( !isset($showMenu) || ($showMenu != 'hide') )

            @include('homepage.common.menuProduct')

            @endif

        </div>

        @if( isset($view) && $view == 'home' )

        @include('homepage.common.slide')

        @endif

    </div>

</div>
