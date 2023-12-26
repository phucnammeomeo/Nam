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

<header class="hidden md:block">
    <div class="top-header bg-Pimary_color">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-5px]">
                <div class="w-1/5 px-[5px]"></div>
                <div class="w-4/5 px-[5px]">
                    <div class="flex flex-wrap justify-between mx-[-5px]">
                        <div class="w-1/4 px-[5px]">
                            <div class="main-logo">
                                <a href="/"><img src="<?php echo e(asset($fcSystem['homepage_logo'])); ?>"
                                        alt="" /></a>
                            </div>
                        </div>
                        <div class="w-2/4 px-[5px]">
                            <div class="main-search">
                                <form role="search" action="<?php echo e(route('homepage.search')); ?>" method="get"
                                    class="relative inline-block w-full mt-[4px] form-search block-search-form furgan-live-search-form">

                                    <input style="height: 35px" autocomplete="off"
                                        class="text-f14 border border-gray-100 rounded-[5px] w-full searchfield txt-livesearch input"
                                        name="keyword" value="<?php echo request()->get('keyword'); ?>"
                                        placeholder="Bạn tìm gì..." type="text">
                                    <button class="absolute top-[6px] right-[13px]">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="w-1/4 px-[5px]">
                            <div class="cart-header flex flex-wrap justify-end items-center h-full">

                                <?php if(Auth::guard('customer')->user()): ?>
                                    <a href="<?php echo e(route('customer.orders')); ?>"
                                    class="text-f12 text-white inline-block mr-[15px] flex items-center"
                                    style="height: 100% ">Tài khoản<br />của bạn</a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('customer.login')); ?>"
                                    class="text-f12 text-white inline-block mr-[15px] flex items-center"
                                    style="height: 100% ">Đăng nhập</a>
                                <?php endif; ?>

                                <a href="<?php echo e(route('cart.index')); ?>"
                                    class="text-f14 text-white px-[20px] flex items-center"
                                    style="background: #e5764e; height: 100%">
                                    <span class="cart relative inline-block w-[45px]">
                                        <i class="fa-solid fa-cart-shopping text-f20 mr-[5px]"></i>
                                        <span
                                            class="stt w-[20px] h-[20px] bg-red rounded-full text-white text-f12 inline-block text-center leading-[20px] top-[-7px] left-[19px] absolute count cart-quantity quantity"><?php echo e($cart['quantity']); ?></span>
                                    </span>Giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/header.blade.php ENDPATH**/ ?>