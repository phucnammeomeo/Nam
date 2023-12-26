<?php $__env->startSection('content'); ?>
<main class="contact-btottom  bg-white p-[10px] mt-[20px]">
    <div class=" container mx-auto">
        <h1 class="uppercase w-full text-center font-bold text-2xl md:text-4xl py-4"><?php echo e($page->title); ?></h1>
        <div class="text-center py-4">
            <?php echo $fcSystem['cart_1'] ?>
        </div>
        <div class=" text-center flex justify-center py-4 space-x-2">
            <a href="<?php echo e(url('/san-pham')); ?>" class=" bg-red-600 text-white rounded-full px-6 py-2 w-auto"><?php echo e(trans('index.ContinueShopping')); ?></a>
            <a href="javascript:void(0)" onclick="PrintElem()" class="bg-blue-700 text-white rounded-full px-6 py-2 w-auto"><?php echo e(trans('index.PrintOrder')); ?></a>
        </div>
        <?php $cart = json_decode($detail->cart, TRUE); ?>
        <?php $coupon = json_decode($detail->coupon, TRUE); ?>

        <div class="main-contact">
            <div class="py-4 main-left">

                <div class="rounded-xl p-4 md:w-[736px] mx-auto">

                    <h2 class="text-xl font-medium w-full text-center mb-6"><?php echo e(trans('index.DeliveryInformation')); ?></h2>

                    <p>
                        <?php echo e(trans('index.Fullname')); ?>: <strong><?php echo e($detail->fullname); ?></strong>
                    </p>
                    <p>
                        Email: <strong><?php echo e($detail->email); ?></strong>
                    </p>
                    <p>
                        <?php echo e(trans('index.Phone')); ?>: <strong><?php echo e($detail->phone); ?></strong>
                    </p>
                    <p>
                        <?php echo e(trans('index.Payments')); ?>: <strong><?php echo e(config('cart')['payment'][$detail->payment]); ?></strong>
                    </p>
                    <p>
                        <?php echo e(trans('index.DeliveryAddress')); ?>: <strong><?php echo e($detail->address); ?></strong>
                    </p>
                    <p>
                        <?php echo e(trans('index.Ward')); ?>: <strong><?php echo e(!empty($detail->ward_name)?$detail->ward_name->name:''); ?></strong>
                    </p>
                    <p>
                        <?php echo e(trans('index.District')); ?>: <strong><?php echo e(!empty($detail->district_name)?$detail->district_name->name:''); ?></strong>
                    </p>
                    <p>
                        <?php echo e(trans('index.City')); ?>: <strong><?php echo e(!empty($detail->city_name)?$detail->city_name->name:''); ?></strong>
                    </p>


                </div>

            </div>

            <div class="py-4 main-right">

                <div class="rounded-xl p-4 md:w-[736px] mx-auto">
                    <h2 class="text-xl font-medium w-full text-center mb-6"><?php echo e(trans('index.InformationLine')); ?></h2>

                    <div class="items-center">
                        <div class="col-start-3 col-span-3 mb-1" style="display: flex;width: 100%; border: solid 1px silver; background-color: lawngreen;">
                            <div class="p-2 text-center" style="width: 50%; border-right: solid 3px silver">
                                <?php echo e(trans('index.ProductCode')); ?> #<?php echo e($detail->code); ?>

                            </div>

                            <div class="p-2 text-center" style="width: 50%">
                                <?php echo e(trans('index.BookingDate')); ?> <?php echo e($detail->created_at); ?>

                            </div>
                        </div>

                        <div class="col-start-1 col-end-8 overflow-x-auto">
                            <table class="table table-aut">
                                <thead>
                                    <tr>
                                        <th><?php echo e(trans('index.ImageProduct')); ?></th>
                                        <th><?php echo e(trans('index.TitleProduct')); ?></th>
                                        <th><?php echo e(trans('index.Amount')); ?></th>
                                        <th><?php echo e(trans('index.Price')); ?></th>
                                        <th><?php echo e(trans('index.intomoney')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <?php if($cart): ?>
                                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $slug = !empty($v['slug']) ? route('routerURL', ['slug' => $v['slug']]) : 'javascript:void(0)';
                                    $options = !empty($v['options']) ? (!empty($v['options']['title_version']) ? $v['options']['title_version'] : '') : '';
                                    $unit = !empty($v['unit']) ? $v['unit'] : '';

                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <a href="<?php echo e($slug); ?>" target="_blank"><img src="<?php echo e(url($v['image'])); ?>" alt="<?php echo e($v['title']); ?>"></a><br>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo e($slug); ?>" target="_blank"><?php echo e($v['title']); ?></a><br>
                                            <?php if(!empty($options)): ?>
                                            <p><?php echo e(trans('index.Classify')); ?>: <?php echo e($options); ?> </p>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?php echo e($v['quantity']); ?></td>
                                        <td class="text-center"><?php echo e(number_format( $v['price'],0,'.',',')); ?>₫</td>

                                        <td class="text-center"><?php echo e(number_format($v['quantity'] * $v['price'],0,'.',',')); ?>₫</td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            <?php echo e(trans('index.Provisional')); ?>

                                        </td>
                                        <td colspan="2" class="text-right">
                                            <?php echo e(number_format($detail->total_price)); ?>₫
                                        </td>
                                    </tr>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            <?php echo e(trans('index.ShippingUnit')); ?>

                                        </td>
                                        </td>
                                        <td colspan="2" class="text-right">
                                            <?php echo e($detail->title_ship); ?>

                                        </td>
                                    </tr>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            <?php echo e(trans('index.TransportFee')); ?>

                                        </td>
                                        <td colspan="2" class="text-right">
                                            <?php echo e(number_format($detail->fee_ship)); ?>₫
                                        </td>
                                    </tr>
                                    <?php if(isset($coupon)): ?>
                                    <?php $__currentLoopData = $coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="3"><?php echo e(trans('index.Discount')); ?></span>
                                        </td>
                                        <td colspan="2" class="text-right">-<span class="amount cart-coupon-price"><?php echo e(number_format($v['price'])); ?>₫</span></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    <?php if($detail->payment == 'wallet'): ?>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            <?php echo e(trans('index.TotalAmount')); ?>

                                        </td>
                                        <td colspan="2" class="text-right">
                                            <?php echo e(number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship)); ?>₫
                                        </td>
                                    </tr>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            <?php echo e(trans('index.Paid')); ?>

                                        </td>
                                        <td colspan="2" class="text-right">
                                            <?php echo e(number_format($detail->wallet)); ?>₫
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr class="total_payment">
                                        <td colspan="3">
                                            <?php echo e(trans('index.TotalMoneyPayment')); ?>

                                        </td>
                                        <td colspan="2" class="text-right font-bold text-red-600">
                                            <?php echo e(number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship-$detail->wallet)); ?>₫
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<style>

    .table {
        width: 100%;
        border-spacing: 0;
        background: #d9d9d9;
        border: solid 1px silver
    }

    .thank-box .table {
        margin: 1rem 0;
    }

    .table td,
    .table th {
        padding: 10px 20px !important;
    }

    .table thead>tr th {
        color: #fff;
        background-color: #2f5acf;
        font-weight: 500;
        border-bottom: solid 1px silver;
    }

    .table tfoot{
        border-top: solid 1px silver;
    }


    .text--left {
        text-align: left;
    }

    /* .table tbody tr:nth-child(2n) td {
        background-color: #eee;
    } */

    .table th
    {
        border: 0px !important;
    }

    .table tfoot td {
        color: #fff;
        background-color: #2f5acf;
        font-weight: 500;
    }

    .main-contact{
        display: flex;
        border: solid 1px silver;
        background-color: antiquewhite;
    }

    .main-left{
        width: 30%;
        margin-right:5px;
        border-right: solid 1px silver;
    }

    .main-right{
        width: 70%;
    }

    .rounded-xl{
        opacity: 0.8;
    }

    .rounded-xl strong{
        color: blue;
        opacity: 0.6;
    }

</style>


<div id="GFG" style="background-color: green;" class="hidden">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" dir="ltr" align="center" style="background-color:#fff;font-size:16px">
        <tb>
            <tr>
                <td align="left" valign="top" style="margin:0;padding:0">
                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="720" bgcolor="#ffffff">
                        <tbody>
                            <tr>
                                <td>
                                    <div style="border:2px solid #2f5acf;padding:8px 16px;border-radius:16px;margin-top:16px">
                                        <p style="margin:10px 0 20px;font-weight:bold;font-size:20px;text-decoration: uppercase;">
                                            <?php echo e(trans('index.InformationLine')); ?>

                                            <a href="javascript:void(0)">
                                                #<?php echo e($detail->code); ?>

                                            </a>
                                            <span style="font-weight:normal">(<?php echo e($detail->created_at); ?>)</span>
                                        </p>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td valign="top">
                                                        <p style="margin:10px 0;font-weight:bold">
                                                            <b><?php echo e(trans('index.BillingInformation')); ?></b>
                                                        </p>
                                                        <p style="margin:10px 0">
                                                            <b><?php echo e(trans('index.Fullname')); ?>:</b> <?php echo e($detail->fullname); ?>

                                                        </p>
                                                        <?php if($detail->email): ?>
                                                        <p style="margin:10px 0">
                                                            <b>Email:</b> <a href="mailto:<?php echo e($detail->email); ?>" target="_blank"><?php echo e($detail->email); ?></a>
                                                        </p>
                                                        <?php endif; ?>
                                                        <p style="margin:10px 0">
                                                            <b><?php echo e(trans('index.Phone')); ?>:</b> <?php echo e($detail->phone); ?>

                                                        </p>
                                                    </td>
                                                    <td valign="top">
                                                        <p style="margin:10px 0;font-weight:bold">
                                                            <b><?php echo e(trans('index.DeliveryAddress2')); ?></b>
                                                        </p>
                                                        <p style="margin:10px 0">
                                                            <b><?php echo e(trans('index.Fullname')); ?>:</b> <?php echo e($detail->fullname); ?>

                                                        </p>
                                                        <?php if($detail->email): ?>
                                                        <p style="margin:10px 0">
                                                            <b>Email:</b> <a href="mailto:<?php echo e($detail->email); ?>" target="_blank"><?php echo e($detail->email); ?></a>
                                                        </p>
                                                        <?php endif; ?>
                                                        <p style="margin:10px 0">
                                                            <b><?php echo e(trans('index.Phone')); ?>:</b> <?php echo e($detail->phone); ?>

                                                        </p>
                                                        <p style="margin:10px 0">
                                                            <b><?php echo e(trans('index.Address')); ?>:</b> <?php echo e($detail->address); ?>

                                                        </p>
                                                        <?php if(!empty($detail->ward_name)): ?>
                                                        <p>
                                                            <b><?php echo e(trans('index.Ward')); ?>:</b>
                                                            <?php echo e(!empty($detail->ward_name)?$detail->ward_name->name:''); ?>

                                                        </p>
                                                        <?php endif; ?>
                                                        <?php if(!empty($detail->district_name)): ?>
                                                        <p>
                                                            <b><?php echo e(trans('index.District')); ?>:</b>
                                                            <?php echo e(!empty($detail->district_name)?$detail->district_name->name:''); ?>

                                                        </p>
                                                        <?php endif; ?>
                                                        <?php if(!empty($detail->city_name)): ?>
                                                        <p>
                                                            <b><?php echo e(trans('index.City')); ?>:</b>
                                                            <?php echo e(!empty($detail->city_name)?$detail->city_name->name:''); ?>

                                                        </p>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <p style="margin:10px 0">
                                                            <b><?php echo e(trans('index.PaymentMethods')); ?>:</b>
                                                            <?php echo e(config('cart')['payment'][$detail->payment]); ?>

                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <?php $cart = json_decode($detail->cart, TRUE); ?>
                            <?php $coupon = json_decode($detail->coupon, TRUE); ?>
                            <tr>
                                <td>
                                    <div style="border:2px solid #2f5acf;padding:8px 16px;border-radius:16px;margin-top:16px">
                                        <p style="margin:10px 0 20px;font-weight:bold;font-size:20px">
                                            <?php echo e(trans('index.OrderDetails')); ?>

                                        </p>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size:14px">
                                            <thead>
                                                <tr>
                                                    <th width="150px" style="text-align:left"><?php echo e(trans('index.TitleProduct')); ?></th>
                                                    <th><?php echo e(trans('index.Amount')); ?></th>
                                                    <th width="150px"><?php echo e(trans('index.Price')); ?></th>
                                                    <th style="text-align:right"><?php echo e(trans('index.intomoney')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($cart): ?>
                                                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $unit = !empty($v['unit']) ? $v['unit'] : '';
                                                $slug = !empty($v['slug']) ? route('routerURL', ['slug' => $v['slug']]) : 'javascript:void(0)';
                                                $options = !empty($v['options']) ? (!empty($v['options']['title_version']) ? $v['options']['title_version'] : '') : '';
                                                ?>
                                                <tr>
                                                    <td style="text-align:left">
                                                        <p style="margin:5px 0 0">
                                                            <a href="<?php echo e($slug); ?>" target="_blank"><?php echo e($v['title']); ?></a>
                                                        </p>
                                                        <?php if(!empty($options)): ?>
                                                        <p style="margin-top:3px">
                                                            <span style="font-size:12px;display:block">
                                                                <?php echo e($options); ?>

                                                            </span>
                                                        </p>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="text-align:center">
                                                        <?php echo e($v['quantity']); ?> <?php echo e($unit); ?>

                                                    </td>
                                                    <td style="text-align:center">
                                                        <b>
                                                            <?php echo e(number_format( $v['price'],0,'.',',')); ?>₫
                                                        </b>

                                                    </td>
                                                    <td style="text-align:right">
                                                        <?php echo e(number_format($v['quantity'] * $v['price'],0,'.',',')); ?>₫
                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        <b><?php echo e(trans('index.Provisional')); ?></b>
                                                    </td>
                                                    <td style="text-align:right">
                                                        <?php echo e(number_format($detail->total_price)); ?>₫
                                                    </td>
                                                </tr>
                                                <?php if(isset($coupon)): ?>
                                                <?php $__currentLoopData = $coupon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <b><?php echo e(trans('index.Discount')); ?></b>
                                                    </td>
                                                    <td style="text-align:right">
                                                        - <?php echo e(number_format($v['price'])); ?>₫
                                                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                <tr>
                                                    <td colspan="3"><b><?php echo e(trans('index.ShippingUnit')); ?></b></td>
                                                    <td style="text-align:right">
                                                        <?php echo e($detail->title_ship); ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><b><?php echo e(trans('index.TransportFee')); ?></b></td>
                                                    <td style="text-align:right">
                                                        <?php echo e(number_format($detail->fee_ship)); ?>₫
                                                    </td>
                                                </tr>
                                                <?php if($detail->payment == 'wallet'): ?>
                                                <tr>
                                                    <td colspan="3"><b><?php echo e(trans('index.TotalAmount')); ?></b></td>
                                                    <td style="text-align:right">
                                                        <?php echo e(number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship)); ?>₫
                                                    </td>
                                                </tr>

                                                <tr class="total_payment">
                                                    <td colspan="3">
                                                        <?php echo e(trans('index.Paid')); ?>

                                                    </td>
                                                    <td colspan="2" class="text-right">
                                                        <?php echo e(number_format($detail->wallet)); ?>₫
                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                                <tr class="total_payment">
                                                    <td colspan="3">
                                                        <?php echo e(trans('index.TotalMoneyPayment')); ?>

                                                    </td>
                                                    <td colspan="2" class="text-right font-bold text-red-600">
                                                        <?php echo e(number_format($detail->total_price-$detail->total_price_coupon+$detail->fee_ship-$detail->wallet)); ?>₫
                                                    </td>
                                                </tr>

                                            </tfoot>
                                        </table>

                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </td>
            </tr>
        </tbody>
    </table>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>
<script type="text/javascript">
    function PrintElem(elem) {
        const printContents = document.getElementById('GFG').innerHTML;
        const originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>

<style>
    .cartIndex button,
    .cartIndex input {
        padding: 0px !important;
        margin: 0 !important;
        background: transparent !important;
        border: 0px !important;
        color: #000;
        height: auto;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/cart/success.blade.php ENDPATH**/ ?>