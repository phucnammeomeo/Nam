<?php $menuProduct = getMenus('menu-danh-muc-san-pham'); ?>

<aside class="sidebar menu-product-header {{ (!isset($view) || $view != 'home')?'hidden not-home':'' }}">

    <div class="item-sb bg-white relative">

        <div class="py-[5px]">

            @if( $menuProduct )

                @foreach( $menuProduct->menu_items as $key => $val )

                    <div class="acc__card border-gray-100">

                        <div class="acc__title text-f15 font-bold">

                            <a href="{{ url($val->slug) }}" class="hover:text-Pimary_color transition-all" style="display: block">

                                <span style="width: 95%;display: inline-block">{{ $val->title }}</span>

                                @if( !$val->children->isEmpty() )

                                <span class="text-f11 float-right" style="width: 5%;display: inline-block"><i class="fa-solid fa-angles-right"></i></span>

                                @endif

                            </a>

                        </div>

                        @if( !$val->children->isEmpty() )

                        <div class="submenu-category">

                            <div class="flex flex-wrap justify-between mx-[-10px]">

                                <div class="w-1/2 px-[10px]">

                                    <ul>

                                        @foreach( $val->children as $keyC => $valC )

                                        <li class="mb-[5px] font-bold">

                                            <a href="{{ url($valC->slug) }}" class="hover:text-Pimary_color transition-all">{{ $valC->title }}</a>

                                        </li>

                                        @endforeach

                                    </ul>

                                </div>

                                <div class="w-1/2 px-[10px]">

                                    @if( $val->image != '' )

                                    <div class="img">

                                        <img src="{{ $val->image }}" alt="{{ $val->title }}" class="w-full">

                                    </div>

                                    @endif

                                </div>

                            </div>

                        </div>

                        @endif

                    </div>

                @endforeach

            @endif

        </div>

    </div>

</aside>
