<?php $dropdown = getFunctions(); ?>
<nav class="side-nav">
    <div class="pt-4 mb-4">
        <div class="side-nav__header flex items-center">
            <a href="{{route('admin.dashboard')}}" class=" flex items-center">
                <img alt="Rocketman Tailwind HTML Admin Template" class="side-nav__header__logo" src="{{asset('backend/images/logo.svg')}}">
                <span class="side-nav__header__text text-white pt-0.5 text-lg ml-2.5"> {{env('BE_TITLE_SEO')}} </span>
            </a>
            <a href="javascript:;" class="side-nav__header__toggler hidden xl:block ml-auto text-white text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5">
                <i data-lucide="arrow-left-circle" class="w-5 h-5"></i>
            </a>
            <a href="javascript:;" class="mobile-menu-toggler xl:hidden ml-auto text-white text-opacity-70 hover:text-opacity-100 transition-all duration-300 ease-in-out pr-5">
                <i data-lucide="x-circle" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
    <div class="scrollable">
        <ul class="scrollable__content">
            <li class="side-nav__devider mb-4">START MENU</li>
            <li>
                <a href="{{route('admin.dashboard')}}" class="side-menu {{ activeMenu('dashboard') }}">
                    <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                    <div class="side-menu__title">
                        Dashboard
                    </div>
                </a>
            </li>
            <!-- Start: Quản lý khách hàng -->
            @can('customers_index')
            <?php if (in_array('customers', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'customers' || $module === 'customer_logs'  || $module === 'customer_categories') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý khách hàng
                            <div class="side-menu__sub-icon <?php if ($module === 'customers' || $module === 'customer_logs' || $module === 'customer_categories') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'customers' || $module === 'customer_logs' ||  $module === 'customer_categories') { ?>side-menu__sub-open<?php } ?>">
                        <li>
                            <a href="{{route('customer_categories.index')}}" class="side-menu {{ activeMenu('customer-categories') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Nhóm khách hàng</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('customers.index')}}" class="side-menu {{ activeMenu('customers') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách khách hàng </div>
                            </a>
                        </li>
                        @can('customer_logs_index')
                        <li class="">
                            <a href="{{route('customerLogs.index')}}" class="side-menu {{ activeMenu('customer-logs') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Logs </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý khách hàng -->
            @can('articles_index')
            <?php if (in_array('articles', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu {{ request()->routeIs('articles.index') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Bài viết
                            <div class="side-menu__sub-icon <?php if ($module === 'category_articles' || $module === 'articles') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_articles' || $module === 'articles') { ?>side-menu__sub-open<?php } ?>">
                        @can('category_articles_index')
                        <li>
                            <a href="{{route('category_articles.index')}}" class="side-menu {{ activeMenu('category-articles') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh mục bài viết</div>
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{route('articles.index')}}" class="side-menu {{ activeMenu('articles') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Bài viết </div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý bài viết -->


            <!-- Start: Quản lý từ gợi ký -->
            @can('keywords_index')
                <?php if (in_array('keywords', $dropdown)) { ?>
                <li>
                    <a href="{{route('keywords.index')}}" class="side-menu {{ activeMenu('keywords') }}">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý từ gợi ý </div>
                    </a>
                </li>
                <?php } ?>
            @endcan
            <!-- END: Quản lý từ gợi ý -->


            <!-- Start: Quản lý product -->
            @can('products_index')
            <?php if (in_array('products', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'category_products' || $module === 'products' || $module === 'brands'  || $module === 'product_purchases' ||  $module === 'suppliers' || $module === 'suppliers_categories') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Sản phẩm
                            <div class="side-menu__sub-icon <?php if ($module === 'category_products' || $module === 'products' || $module === 'brands' || $module === 'product_purchases' ||  $module === 'suppliers' || $module === 'suppliers_categories') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_products' || $module === 'products' || $module === 'brands' || $module === 'product_purchases' || $module === 'suppliers' || $module === 'suppliers_categories') { ?>side-menu__sub-open<?php } ?>">
                        @can('category_products_index')
                        <li>
                            <a href="{{route('category_products.index')}}" class="side-menu {{ activeMenu('category-products') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh mục sản phẩm</div>
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{route('products.index')}}" class="side-menu {{ activeMenu('products') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách sản phẩm</div>
                            </a>
                        </li>
                        <?php if (in_array('product_purchases', $dropdown)) { ?>
                            @can('product_purchases_index')
                            <li>
                                <a href="{{route('product_purchases.index')}}" class="side-menu {{ activeMenu('product-purchases') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title">Nhập hàng</div>
                                </a>
                            </li>
                            @endcan
                        <?php } ?>
                        @can('brands_index')
                        <?php if (in_array('brands', $dropdown)) { ?>
                            <li>
                                <a href="{{route('brands.index')}}" class="side-menu {{ activeMenu('brands') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Quản lý Thương hiệu</div>
                                </a>
                            </li>
                        <?php } ?>
                        @endcan
                        @can('suppliers_index')
                        <?php if (in_array('suppliers', $dropdown)) { ?>
                            <li>
                                <a href="{{route('suppliers.index')}}" class="side-menu  {{ activeMenu('suppliers') }} {{ activeMenu('suppliers-categories') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Nhà cung cấp</div>
                                </a>
                            </li>
                        <?php } ?>
                        @endcan
                    </ul>
                </li>
            <?php } ?>
            @endcan
            <?php if (in_array('payment_vouchers', $dropdown) || in_array('receipt_vouchers', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'payment_groups' || $module === 'payment_vouchers' || $module === 'receipt_groups' || $module === 'receipt_vouchers') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Sổ quỹ
                            <div class="side-menu__sub-icon <?php if ($module === 'payment_groups' || $module === 'payment_vouchers' || $module === 'receipt_groups' || $module === 'receipt_vouchers') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'payment_groups' || $module === 'payment_vouchers' || $module === 'receipt_groups' || $module === 'receipt_vouchers') { ?>side-menu__sub-open<?php } ?>">
                        <?php if (in_array('receipt_vouchers', $dropdown) && !empty($module)) { ?>
                            @can('receipt_vouchers_index')
                            <li>
                                <a href="{{route('receipt_vouchers.index')}}" class="side-menu {{ activeMenu('receipt-vouchers') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title">Phiếu thu</div>
                                </a>
                            </li>
                            @endcan
                        <?php } ?>
                        <?php if (in_array('payment_vouchers', $dropdown) && !empty($module)) { ?>
                            @can('payment_vouchers_index')
                            <li>
                                <a href="{{route('payment_vouchers.index')}}" class="side-menu {{ activeMenu('payment-vouchers') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title">Phiếu chi</div>
                                </a>
                            </li>
                            @endcan
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
            @can('orders_index')
            <?php if (in_array('orders', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'orders'  || $module === 'orders_payment' || $module === 'coupons') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Đơn hàng
                            <div class="side-menu__sub-icon <?php if ($module === 'orders'  || $module === 'orders_payment' || $module === 'coupons') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'orders'  || $module === 'orders_payment' || $module === 'coupons') { ?>side-menu__sub-open<?php } ?>">
                        @can('orders_index')
                        <?php if (in_array('orders', $dropdown)) { ?>
                            <li>
                                <a href="{{route('orders.index')}}" class="side-menu {{ activeMenu('orders') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Quản lý Đơn hàng</div>
                                </a>
                            </li>
                            <li class="hidden">
                                <a href="{{route('orders.returns')}}" class="side-menu {{ activeMenu('orders-returns') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Trả/hoàn hàng</div>
                                </a>
                            </li>
                            <?php if (in_array('orders_payment', $dropdown)) { ?>
                                @can('orders_payment_index')
                                <li>
                                    <a href="{{route('orders.payment')}}" class="side-menu {{ activeMenu('orders-payment') }}">
                                        <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                        <div class="side-menu__title"> Lịch sử thanh toán</div>
                                    </a>
                                </li>
                                @endcan
                            <?php } ?>

                        <?php } ?>
                        @endcan
                        @can('coupons_index')
                        <?php if (in_array('coupons', $dropdown)) { ?>
                            <li>
                                <a href="{{route('coupons.index')}}" class="side-menu {{ activeMenu('coupons') }}">
                                    <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                    <div class="side-menu__title"> Quản lý Mã giảm giá</div>
                                </a>
                            </li>
                        <?php } ?>
                        @endcan

                    </ul>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý product -->
            <!-- Start: Quản lý thuộc tính -->
            @can('attributes_index')
            <?php if (in_array('attributes', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'category_attributes' || $module === 'attributes') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Thuộc tính
                            <div class="side-menu__sub-icon <?php if ($module === 'category_attributes' || $module === 'attributes') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_attributes' || $module === 'attributes') { ?>side-menu__sub-open<?php } ?>">
                        @can('category_attributes_index')
                        <li>
                            <a href="{{route('category_attributes.index')}}" class="side-menu {{ activeMenu('category-attributes') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Nhóm thuộc tính</div>
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{route('attributes.index')}}" class="side-menu {{ activeMenu('attributes') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách </div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý thuộc tính -->
            <!-- Start: Quản lý media -->
            @can('media_index')
            <?php if (in_array('media', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'category_media' || $module === 'media') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Media
                            <div class="side-menu__sub-icon <?php if ($module === 'category_media' || $module === 'media') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'category_media' || $module === 'media') { ?>side-menu__sub-open<?php } ?>">
                        @can('category_media_index')
                        <li>
                            <a href="{{route('category_media.index')}}" class="side-menu {{ activeMenu('category-media') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh mục media</div>
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{route('media.index')}}" class="side-menu {{ activeMenu('media') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Danh sách </div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý media -->

            <!-- Start: Quản lý Trang -->
            @can('pages_index')
            <?php if (in_array('pages', $dropdown)) { ?>
                <li>
                    <a href="{{route('pages.index')}}" class="side-menu {{ activeMenu('pages') }}">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Trang </div>
                    </a>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý Trang -->
            <!-- Start: Quản lý Liên hệ -->
            @can('contacts_index')
            <?php if (in_array('contacts', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'contacts') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý Liên hệ
                            <div class="side-menu__sub-icon <?php if ($module === 'contacts') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'contacts') { ?>side-menu__sub-open<?php } ?>">
                        <li>
                            <a href="{{route('contacts.index')}}" class="side-menu {{ activeMenu('contacts') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Quản lý Liên hệ</div>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{route('subscribers.index')}}" class="side-menu {{ activeMenu('subscribers') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Đăng ký gửi email </div>
                            </a>
                        </li>
                        <li class="hidden">
                            <a href="{{route('books.index')}}" class="side-menu {{ activeMenu('books') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Yêu cầu báo giá</div>
                            </a>
                        </li>
                        <li class="hidden">
                            <a href="{{route('machining.index')}}" class="side-menu {{ activeMenu('machining') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Gia công</div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý Liên hệ -->
            <!-- Start: Quản lý Tag -->
            @can('tags_index')
            <?php if (in_array('tags', $dropdown)) { ?>
                <li>
                    <a href="{{route('tags.index')}}" class="side-menu {{ activeMenu('tags') }}">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Tag </div>
                    </a>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý Tag -->
            <!-- Start: Quản lý Comment -->
            @can('comments_index')
            <?php if (in_array('comments', $dropdown)) { ?>
                <li>
                    <a href="{{route('comments.index')}}" class="side-menu {{ activeMenu('comments') }}">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Comment </div>
                    </a>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý Comment -->
            <!-- Start: Quản lý slide -->
            @can('slides_index')
            <?php if (in_array('slides', $dropdown)) { ?>
                <li>
                    <a href="{{route('slides.index')}}" class="side-menu {{ activeMenu('slides') }}">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Banner & Slide </div>
                    </a>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý slide -->
            <!-- Start: Quản lý Menu -->
            @can('menus_index')
            <?php if (in_array('menus', $dropdown)) { ?>
                <li>
                    <a href="{{route('menus.index')}}" class="side-menu {{ activeMenu('menus') }}">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title"> Quản lý Menu </div>
                    </a>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý Menu -->
            <!-- Start: Cấu hình hệ thống -->
            <li>
                <a href="{{route('generals.index')}}" class="side-menu {{ activeMenu('generals') }} {{ activeMenu('customer-socials') }} {{ activeMenu('orders-config') }} {{ activeMenu('taxes') }} {{ activeMenu('addresses') }} {{ activeMenu('config-emails') }} {{ activeMenu('ships') }} {{ activeMenu('config-images') }}">
                    <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                    <div class="side-menu__title">
                        Cấu hình
                    </div>
                </a>
            </li>
            <!-- END: Cấu hình hệ thống -->
            <!-- Start: Quản lý thành viên -->
            @can('users_index')
            <?php if (in_array('users', $dropdown) && !empty($module)) { ?>
                <li>
                    <a href="javascript:void(0)" class="side-menu <?php if ($module === 'users' || $module === 'roles') { ?>side-menu--active<?php } ?>">
                        <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="side-menu__title">
                            Quản lý thành viên
                            <div class="side-menu__sub-icon <?php if ($module === 'users' || $module === 'roles') { ?>transform rotate-180<?php } ?>">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="<?php if ($module === 'users' || $module === 'roles') { ?>side-menu__sub-open<?php } ?>">
                        <li>
                            <a href="{{route('roles.index')}}" class="side-menu {{ activeMenu('roles') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Nhóm thành viên</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('users.index')}}" class="side-menu {{ activeMenu('users') }}">
                                <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                                <div class="side-menu__title"> Thành viên </div>
                            </a>
                        </li>

                    </ul>
                </li>
            <?php } ?>
            @endcan
            <!-- END: Quản lý thành viên -->
            
            @if(env('APP_ENV') == "local" && !empty($module))
            <li>
                <a href="javascript:void(0)" class="side-menu <?php if ($module === 'order_logs' || $module === 'permissions' || $module === 'configis' || $module === 'config_colums') { ?>side-menu--active<?php } ?>">
                    <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                    <div class="side-menu__title">
                        Development
                        <div class="side-menu__sub-icon <?php if ($module === 'order_logs' || $module === 'permissions' || $module === 'configis' || $module === 'config_colums') { ?>transform rotate-180<?php } ?>">
                            <i data-lucide="chevron-down"></i>
                        </div>
                    </div>
                </a>
                <ul class="<?php if ($module === 'order_logs' || $module === 'permissions' ||  $module === 'configis' || $module === 'config_colums') { ?>side-menu__sub-open<?php } ?>">
                    @can('users_index')
                    <li>
                        <a href="{{route('permissions.index')}}" class="side-menu {{ activeMenu('permissions') }}">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">Quản lý phân quyền</div>
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a href="{{route('configIs.index')}}" class="side-menu {{ activeMenu('config-is') }}">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">Cấu hình hiển thị</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('config_colums.index')}}" class="side-menu {{ activeMenu('config-colums') }}">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">Custom field</div>
                        </a>
                    </li>
                    @can('order_logs_index')
                    <li>
                        <a href="{{route('orderLogs.index')}}" class="side-menu {{ activeMenu('order-logs') }}">
                            <div class="side-menu__icon"> <i data-lucide="aperture"></i> </div>
                            <div class="side-menu__title">Logs đơn hàng</div>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif
            <li class="">
                <a href="{{route('sitemap')}}" class="side-menu" target="_blank">
                    <div class="side-menu__icon">
                        <i data-lucide="box"></i>
                    </div>
                    <div class="side-menu__title">Cập nhập sitemap</div>
                </a>
            </li>
            @can('websites_index')
            <?php if (in_array('websites', $dropdown) && !empty($module) && (env('APP_ENV') == "local")) { ?>
                <li class="">
                    <a href="{{route('websites.index')}}" class="side-menu" class="side-menu {{ activeMenu('websites') }}">
                        <div class="side-menu__icon">
                            <i data-lucide="box"></i>
                        </div>
                        <div class="side-menu__title">Giao diện website</div>
                    </a>
                </li>
            <?php } ?>
            @endcan
        </ul>
    </div>
</nav>
