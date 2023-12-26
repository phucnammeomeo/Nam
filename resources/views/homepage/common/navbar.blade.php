<?php
    $menu_header = getMenus('menu-header');
?>
<div class="main-menu-pr bg-white hidden lg:block">
    <div class="main-menu">
        <ul class="flex lg:flex-grow md:space-x-0 lg:space-x-4 flex-wrap">
            @if (count($menu_header->menu_items) > 0)
                @foreach ($menu_header->menu_items as $item)
                    <li class="group relative">
                        <a href="{{ url($item->slug) }}"
                            class="inline-block px-[5px] lg:px-[8px] py-[10px] text-f15 transition-all hover:text-Pimary_color uppercase">
                            <span class="lg:mt-0 hover:text-blue003">
                                {{ $item->title }}

                            </span>
                        </a>
                        @if (count($item->children) > 0)
                        <span class="text-f11 ml-[5px]"><i class="fa-solid fa-chevron-down"></i></span>
                            <ul
                                class="group-hover:block hidden absolute dropdown left-0 top-full z-30 bg-white submenu shadow">
                                @foreach ($item->children as $item2)
                                    <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                    <li >
                                        <a href="{{ url($item2->slug) }}"
                                            class="hover:text-white text-f15 inline-block py-[10px] px-[15px] hover:bg-Pimary_color w-full"
                                            style="text-transform: uppercase"
                                            <?php echo $_blank_2; ?>>{{ $item2->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>


