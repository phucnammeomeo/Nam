<div class="cart-sum relative">
    <a class="text-f14 text-white pr-[15px] flex items-center click-cart cursor-pointer">
        <span class="cart relative inline-block w-[45px] shopping-cart">
           <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                aria-hidden="true" viewBox="0 0 24 24" data-testid="AddShoppingCartIcon"
                style="font-size: 26px; color: white; margin-right: 5px;">
               <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"></path>
           </svg>
            <span class="stt w-[20px] h-[20px] bg-yellow-400 rounded-full text-white text-f12 inline-block text-center leading-[20px] top-[-7px] left-[19px] absolute cart-quantity"><?php echo e($cart['quantity']); ?></span>
        </span>
        <span class="text-f14 title-span">Giỏ hàng</span>
    </a>
    <div class="nav-cart-sum z-10 mini-cart">

        <div class="p-[10px] cart-html-header" style="max-height: 300px;overflow-y: scroll;">

            <?php if( $cart['cart'] ): ?>
                <?php $__currentLoopData = $cart['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item flex flex-wrap justify-between mb-[10px]">
                    <div class="img" style="width: 50px;">
                        <a href="<?php echo e(route( 'routerURL', ['slug' => $val['slug']] )); ?>"><img src="<?php echo e(asset(getImageUrl('products', $val['image'], 'small'))); ?>" alt="<?php echo e($val['title']); ?>"></a>
                    </div>
                    <div class="nav-img pl-[10px]" style="width: calc(100% - 50px);">
                        <h3 class="text-f14" style="line-height: 20px;"><?php echo e($val['title']); ?></h3>
                        <?php if( $val['unit'] != '' ): ?>
                        <p class="text-f13 leading-[16px]">ĐVT: <?php echo e($val['unit']); ?></p>
                        <?php endif; ?>
                        <p class="text-f13 leading-[16px]">x <?php echo e($val['quantity']); ?> <span class="float-right text-Pimary_color"><?php echo e(str_replace( '.', ',', number_format($val['price']))); ?> ₫</span></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="text-center py-4">Giỏ hàng chưa có sản phẩm</div>
            <?php endif; ?>
        </div>
        <div id="header-cart-action" style="<?php echo e($cart['quantity'] == 0?'display:none':''); ?>">
            <div class="sum-sum border-t border-b border-gray-100 p-[10px]">
                <p class="text-f14">
                    Có tổng <span class="cart-quantity"><?php echo e($cart['quantity']); ?></span> sản phẩm
                    <span class=" float-right">
                    Tổng tiền:<span class="text-Pimary_color font-bold cart-total"><?php echo e(str_replace('.', ',', number_format($cart['total']))); ?></span>
                </span>
                </p>
            </div>
            <div class="xemchitiet text-right p-[10px]">
                <a href="<?php echo e(route('cart.index')); ?>" class="bg-Pimary_color py-[5px] px-[10px] inline-block text-f14 text-white">Xem chi tiết</a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\sportshop\resources\views/homepage/common/headerCart.blade.php ENDPATH**/ ?>