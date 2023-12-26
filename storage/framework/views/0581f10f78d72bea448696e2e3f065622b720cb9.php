<?php
$menu_header = getMenus('menu-header');
$searchCategory = Cache::remember('searchCategory', 600, function () {
    $searchCategory = \App\Models\CategoryProduct::select('id', 'title')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
        ->orderBy('order', 'asc')
        ->orderBy('id', 'desc')
        ->get();
    return $searchCategory;
});
?>
<header id="header" class="<?php if(!empty($page) && !empty($page['page']) && !empty($page['page'] == 'index')): ?> header style-01 header-dark header-transparent header-sticky <?php else: ?> header style-02 header-dark <?php endif; ?>">
    <div class="header-wrap-stick">
        <div class="header-position">
            <div class="header-middle">
                <div class="furgan-menu-wapper"></div>
                <div class="header-middle-inner">
                    <div class="header-search-menu">
                    </div>
                    <div class="header-logo-nav">
                        <div class="header-logo">
                            <a href="<?php echo e(url('')); ?>">
                                <img alt="logo" src="<?php echo e(asset($fcSystem['homepage_logo'])); ?>" class="logo">
                            </a>
                        </div>
                        <div class="box-header-nav menu-center">
                            <ul id="menu-primary-menu" class="clone-main-menu furgan-clone-mobile-menu furgan-nav main-menu">
                                <?php if(count($menu_header->menu_items) > 0): ?>
                                <?php $__currentLoopData = $menu_header->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-996 parent parent-megamenu item-megamenu <?php if(count($item->children) > 0): ?> menu-item-has-children clone-menu-item <?php endif; ?>">
                                    <a class="furgan-menu-item-title" title="<?php echo e($item->title); ?>" href="<?php echo e(url($item->slug)); ?>"><?php echo e($item->title); ?></a>
                                    <?php if(count($item->children) > 0): ?>
                                    <span class="toggle-submenu"></span>
                                    <ul role="menu" class="submenu">
                                        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                        <li class="menu-item ">
                                            <a href="<?php echo e(url($item2->slug)); ?>" <?php echo $_blank_2 ?>><?php echo e($item2->title); ?></a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="header-control">
                        <div class="header-control-inner">
                            <div class="meta-dreaming">
                                <div class="header-search furgan-dropdown">
                                    <div class="header-search-inner" data-furgan="furgan-dropdown">
                                        <a href="#" class="link-dropdown block-link">
                                            <span class="flaticon-magnifying-glass-1"></span>
                                        </a>
                                    </div>
                                    <div class="block-search">
                                        <form role="search" action="<?php echo e(route('homepage.search')); ?>" method="get" class="form-search block-search-form furgan-live-search-form">
                                            <div class="form-content search-box results-search">
                                                <div class="inner">
                                                    <input autocomplete="off" class="searchfield txt-livesearch input" name="keyword" value="<?php echo e(request()->get('keyword')); ?>" placeholder="Nhập từ khóa tìm kiếm..." type="text">
                                                </div>
                                            </div>
                                            <?php if(!$searchCategory->isEmpty()): ?>
                                            <div class="category">
                                                <select name="category_id" class="category-search-option">
                                                    <option value="0">Danh mục sản phẩm</option>
                                                    <?php $__currentLoopData = $searchCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option class="level-0" value="<?php echo e($item->id); ?>" <?php if(request()->get('category_id') == $item->id): ?> selected <?php endif; ?>><?php echo e($item->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <?php endif; ?>

                                            <button type="submit" class="btn-submit">
                                                <span class="flaticon-magnifying-glass-1"></span>
                                            </button>
                                        </form><!-- block search -->
                                    </div>
                                </div>
                                <div class="furgan-dropdown-close">x</div>
                                <div class="block-minicart block-dreaming furgan-mini-cart furgan-dropdown">
                                    <div class="shopcart-dropdown block-cart-link" data-furgan="furgan-dropdown">
                                        <a class="block-link link-dropdown" href="javascript:void(0)">
                                            <span class="flaticon-cart"></span>
                                            <span class="count cart-quantity"><?php echo e($cart['quantity']); ?></span>
                                        </a>
                                    </div>
                                    <div class="widget furgan widget_shopping_cart">
                                        <div class="widget_shopping_cart_content">
                                            <ul class="furgan-mini-cart cart_list product_list_widget cart-html-header">
                                                <?php if(isset($cart['cart']) && is_array($cart['cart']) && count($cart['cart']) > 0 ): ?>
                                                <?php $__currentLoopData = $cart['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                echo htmlItemCartHeader($k, $item);
                                                ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                            <p class="furgan-mini-cart__total total"><strong>Tổng tiền:</strong>
                                                <span class="furgan-Price-amount amount"><span class="furgan-Price-currencySymbol">₫</span><?php echo !empty($cart['total']) ? number_format($cart['total'], 0, ',', '.')  : '' ?></span>
                                            </p>
                                            <p class="furgan-mini-cart__buttons buttons">
                                                <a href="<?php echo e(route('cart.index')); ?>" class="button furgan-forward">Giỏ hàng</a>
                                                <a href="c<?php echo e(route('cart.checkout')); ?>" class="button checkout furgan-forward">Thanh toán</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="header-mobile-left">
            <div class="block-menu-bar">
                <a class="menu-bar menu-toggle" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>

        </div>
        <div class="header-mobile-mid">
            <div class="header-logo">
                <a href="<?php echo e(url('')); ?>">
                    <img alt="logo" src="<?php echo e(asset($fcSystem['homepage_logo'])); ?>" class="logo">
                </a>
            </div>
        </div>
        <div class="header-mobile-right">
            <div class="header-control-inner">
                <div class="meta-dreaming">
                    <div class="menu-item block-user block-dreaming furgan-dropdown" style="position: unset;">
                        <div class="header-search furgan-dropdown">
                            <div class="header-search-inner" data-furgan="furgan-dropdown">
                                <a href="#" class="link-dropdown block-link">
                                    <span class="flaticon-magnifying-glass-1"></span>
                                </a>
                            </div>
                            <div class="block-search">
                                <form role="search" action="<?php echo e(route('homepage.search')); ?>" method="get" class="form-search block-search-form furgan-live-search-form">
                                    <div class="form-content search-box results-search">
                                        <div class="inner">
                                            <input autocomplete="off" class="searchfield txt-livesearch input" name="keyword" value="<?php echo request()->get('keyword') ?>" placeholder="Nhập từ khóa tìm kiếm..." type="text">
                                        </div>
                                    </div>
                                    <?php if(!$searchCategory->isEmpty()): ?>
                                    <div class="category">
                                        <select name="category_id" class="category-search-option">
                                            <option value="0">Danh mục sản phẩm</option>
                                            <?php $__currentLoopData = $searchCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option class="level-0" value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php endif; ?>
                                    <button type="submit" class="btn-submit">
                                        <span class="flaticon-magnifying-glass-1"></span>
                                    </button>
                                </form><!-- block search -->
                            </div>
                        </div>
                    </div>
                    <div class="block-minicart block-dreaming furgan-mini-cart furgan-dropdown">
                        <div class="shopcart-dropdown block-cart-link" data-furgan="furgan-dropdown">
                            <a class="block-link link-dropdown" href="#">
                                <span class="flaticon-cart"></span>
                                <span class="count cart-quantity"><?php echo e($cart['quantity']); ?></span>
                            </a>
                        </div>
                        <div class="widget furgan widget_shopping_cart">
                            <div class="widget_shopping_cart_content">
                                <ul class="furgan-mini-cart cart_list product_list_widget cart-html-header">
                                    <?php if(isset($cart['cart']) && is_array($cart['cart']) && count($cart['cart']) > 0 ): ?>
                                    <?php $__currentLoopData = $cart['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    echo htmlItemCartHeader($k, $item);
                                    ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                                <p class="furgan-mini-cart__total total"><strong>Tổng tiền:</strong>
                                    <span class="furgan-Price-amount amount"><span class="furgan-Price-currencySymbol">₫</span><?php echo !empty($cart['total']) ? number_format($cart['total'], 0, ',', '.')  : '' ?></span>
                                </p>
                                <p class="furgan-mini-cart__buttons buttons">
                                    <a href="<?php echo e(route('cart.index')); ?>" class="button furgan-forward">Giỏ hàng</a>
                                    <a href="<?php echo e(route('cart.checkout')); ?>" class="button checkout furgan-forward">Thanh toán</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH /home/globalmat/domains/globalmat.vn/public_html/resources/views/homepage/common/header.blade.php ENDPATH**/ ?>