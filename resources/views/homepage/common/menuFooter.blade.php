<?php
$menu_footer = getMenus('menu-footer');
?>

<footer class="footer bg-white mt-0 md:mt-[30px]">
    <div class="top-footer p-[10px] border-b border-gray-100">

        <div class="flex flex-wrap justify-between mx-[-10px] items-center logo-footer-1">
            <div class="w-full md:w-1/2 px-[10px] mb-[10px] md:mb-0 ">
                <p class="flex flex-wrap">
                    <span class=""><img src="{{ asset($fcSystem['homepage_logo_footer_1']) }}" alt="Logo" />
                    </span>
                    <span class="pl-[10px]">{{ $fcSystem['title_9'] }} <strong>{{ $fcSystem['title_10'] }}</strong>
                        <br />
                        {{ $fcSystem['title_11'] }}</span>
                </p>
            </div>
            <div class="w-full md:w-1/2 px-[10px]">
                <p class="flex flex-wrap">
                    <span class=""><img src="{{ asset($fcSystem['homepage_logo_footer_2']) }}" alt="Logo" />
                    </span>
                    <span class="pl-[10px]">{{ $fcSystem['title_12'] }} <strong>{{ $fcSystem['title_13'] }}</strong>
                        <br />
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="content-footer p-[10px]">
        <div class="flex flex-wrap justify-between mx-[-10px] mb-\[7px\]">
            <div class="w-full md:w-1/2 px-[10px]">
                <h3 class="text-f16 font-bold uppercase mb-[7px]">
                    {{ $fcSystem['title_5'] }}
                </h3>
                <div class="flex flex-wrap  mt-[10px]">
                    @if (count($menu_footer->menu_items) > 0)
                        @foreach ($menu_footer->menu_items as $item)
                            @if (count($item->children) > 0)
                                <div class="w-1/2 md:w-1/3 px-[5px]">
                                    <ul>
                                        @foreach ($item->children as $item2)
                                            <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                            <li class="text-f15 text-gray-700 mb-[7px]">
                                                <a href="{{ url($item2->slug) }}"
                                                    <?php echo $_blank_2; ?>>{{ $item2->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                    <div class="w-1/2 md:w-1/3 px-[5px]">
                                        <ul>

                                                <?php $_blank_2 = !empty($item->target === '_blank') ? 'target="_blank"' : ''; ?>
                                                <li class="text-f15 text-gray-700 mb-[7px]">
                                                    <a href="{{ url($item->slug) }}"
                                                        <?php echo $_blank_2; ?>>{{ $item->title }}</a>
                                                </li>

                                        </ul>
                                    </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                <h3 class="text-f16 font-bold uppercase mb-[7px] mt-[10px]">
                    {{ $fcSystem['title_14'] }}
                </h3>
                {{-- <div class="flex flex-wrap justify-between mx-[-5px] mt-[10px] logo-footer">
                    @if ($partners && count($partners->slides) > 0)
                        <ul class="flex flex-wrap mt-[10px]">
                            @foreach ($partners->slides as $key => $slide)
                                <li class="mr-[5px]">
                                    <a target="_blank" href="{{ url($slide->link) }}"><img
                                            src="{{ asset($slide->src) }}" alt="Thành viên cùng chủ quản"/></a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div> --}}
            </div>
            <div class="w-full md:w-1/2 px-[10px] mt-[10px] md:mt-0">
                <h3 class="text-f16 font-bold uppercase mb-[7px]">
                    {{ $fcSystem['title_6'] }}
                </h3>

                {{-- phone text-Pimary_color font-bold --}} {{-- class cũ của thẻ p dưới --}}
                <p class="mb-[5px]">
                    <i class="fa-solid fa-headphones mr-[5px]"></i>{{ $fcSystem['title_8'] }}
                    <span class="font-bold">
                        <a
                            href="tel:{{ $fcSystem['contact_hotline'] }}">{{ $fcSystem['contact_hotline'] }}
                        </a>
                    </span>
                </p>

                <p class="mb-[5px]">
                    <i class="fa-solid fa-phone mr-[5px]"></i>{{ $fcSystem['title_15'] }}
                    <span class="font-bold">
                        <a
                            href="tel:{{ $fcSystem['contact_hotline2'] }}">{{ $fcSystem['contact_hotline2'] }}
                        </a>
                    </span>
                </p>

                <p class="mb-[5px]">
                    <i class="fa-solid fa-location-dot mr-[5px]"></i>{{ $fcSystem['title_17'] }}
                    <span class="font-bold">
                        {{ $fcSystem['contact_address'] }}
                    </span>
                </p>

                <p>
                    <i class="fa-solid fa-mail-bulk mr-[5px]"></i>{{ $fcSystem['title_16'] }}
                    <span class="font-bold">
                        <a
                            href="mailto:{{ $fcSystem['contact_email'] }}">{{ $fcSystem['contact_email'] }}
                        </a>
                    </span>
                </p>

                <h4 class="text-f15 font-bold mt-[15px]">
                    {{ $fcSystem['title_7'] }}
                </h4>
                @include('homepage.common.subscribers')
                {{-- @if ($OurFeatures && count($OurFeatures->slides) > 0)
                    <ul class="flex flex-wrap mt-[10px] logo-footer">
                        @foreach ($OurFeatures->slides as $key => $slide)
                            <li class="mr-[5px]">
                                <a target="_blank" href="{{ url($slide->link) }}"><img
                                        src="{{ asset($slide->src) }}" alt="Chứng nhận kinh doanh" /></a>
                            </li>
                        @endforeach
                    </ul>
                @endif --}}
            </div>
        </div>
    </div>
</footer>
