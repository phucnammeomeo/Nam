<?php $__env->startSection('content'); ?>
<div class="py-9 bg-white px-4 cartIndex">
    <div class="container mx-auto">
        <div class="grid grid-cols-12 -mx-4">
            <div class="col-span-12 lg:col-span-3 px-4 order-last mt-8 lg:mt-0">
                <div class="mt-4 lg:mt-0" style="display: flex; margin: 10px 0; border:solid 1px silver">
                    <div class="bg-slate-100 p-2" style="width: 70%; margin-top: 10px;">
                        <ul class="flex flex-wrap items-center justify-between">
                            <li class="text-base font-semibold"><?php echo e(trans('index.TotalNumberOfProducts')); ?></li>
                            <li class="text-base font-semibold cart-quantity"><?php echo $cart['quantity'] ?>
                            </li>
                        </ul>
                        <?php $price_coupon = 0; ?>

                        <?php $price_coupon += !empty($v['price']) ? $v['price'] : 0; ?>
                        <input type="hidden" name="fee_ship" value="0">

                        <div class="cart-coupon-html">
                            <?php if(isset($coupon)): ?>
                            <?php $__currentLoopData = $coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $price_coupon += !empty($v['price']) ? $v['price'] : 0; ?>
                            <table>
                                <tr>
                                    <th><?php echo e(trans('index.DiscountCode')); ?> : <span class="cart-coupon-name"><?php echo e($v['name']); ?></span></th>
                                    <td>-<span class="amount cart-coupon-price"><?php echo number_format($v['price'], 0, ',', '.') . '₫' ?></span>
                                        <a href="javascript:void(0)" data-id="<?php echo e($v['id']); ?>" class="remove-coupon text-global font-bold">[<?php echo e(trans('index.Delete')); ?>]</a>
                                    </td>
                                </tr>
                            </table>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                        <div class="border-t  border-white py-5 mt-5">

                            <ul class="flex flex-wrap items-center justify-between">
                                <li class="text-base font-semibold"><?php echo e(trans('index.TotalPrice')); ?></li>
                                <li class="text-base font-semibold text-orange cart-total-final" style="color:#EE0033">
                                    <?php echo number_format($cart['total'] - $price_coupon, 0, ',', '.') . '₫' ?>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php if (in_array('coupons', $dropdown)) { ?>
                        <!-- START: mã giảm giá -->
                        
                    <?php } ?>

                    <!-- END: mã giảm giá -->

                    <div class="mt-3 " style="width: 30%; margin: 10px 10px 0 50px; height: 100%;">
                        <a href="<?php echo e(url('/san-pham')); ?>" class="bg-ColorPrimary w-full text-center inline-block bg-dark leading-none py-4 px-5 md:px-8 text-sm text-white transition-all hover:bg-orange uppercase font-semibold hover:text-white bg-Pimary_color" style="height: 50%; line-height: 1.5; margin-bottom:10px; border-radius: 50px"><?php echo e(trans('index.ContinueShopping')); ?></a>
                        
                            <a href="<?php echo e(route('cart.checkout')); ?>"  class="bg-ColorPrimary w-full text-center inline-block bg-dark leading-none py-4 px-5 md:px-8 text-sm text-white transition-all hover:bg-orange uppercase font-semibold hover:text-white bg-Pimary_color btn-pay" style="height: 50%; line-height: 1.5; margin-bottom:10px; border-radius: 50px"><?php echo e(trans('index.Pay')); ?></a>
                        
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-9 px-4">
                <div class="overflow-x-auto relative" style="margin-bottom: 5px">
                    <table class="w-full min-w-max table-aut">
                        <thead>
                            <tr>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    <?php echo e(trans('index.ImageProduct')); ?>

                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize" style="width:200px">
                                    <?php echo e(trans('index.TitleProduct')); ?>

                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    <?php echo e(trans('index.Price')); ?>

                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    <?php echo e(trans('index.Amount')); ?>

                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    <?php echo e(trans('index.intomoney')); ?>

                                </th>
                                <th class="bg-slate-100 p-3 border border-solid  text-center font-medium text-sm capitalize">
                                    <?php echo e(trans('index.Delete')); ?>

                                </th>
                            </tr>
                        </thead>
                        <?php if(!empty($cartController)): ?>
                            <tbody class="cart-html-cart">
                                <?php $__currentLoopData = $cartController; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    echo htmlItemCart($k, $item);
                                ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        <?php endif; ?>
                        <?php if(empty($cartController)): ?>
                            <?php $__env->startPush('css'); ?>
                            <style>
                                .btn-pay{
                                    pointer-events: none;
                                    opacity: 0.6;
                                }
                            </style>
                            <?php $__env->stopPush(); ?>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>
    <script src="<?php echo e(asset('assets/js/jquery-1.12.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('library/toastr/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/library/js/products.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/library/js/common.js')); ?>"></script>
    <script type="text/javascript">
        function openAlert() {
                var result = confirm("Bạn hãy đăng nhập để theo dõi đơn hàng của mình!");            
        }
    </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/cart/index.blade.php ENDPATH**/ ?>