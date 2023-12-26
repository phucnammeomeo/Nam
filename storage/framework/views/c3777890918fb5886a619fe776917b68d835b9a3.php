
<?php $__env->startSection('title'); ?>
<title>Chi tiết đơn nhập hàng <?php echo e($detail->code); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách đơn nhập hàng",
        "src" => route('product_purchases.index'),
    ],
    [
        "title" => "Chi tiết đơn nhập hàng " . $detail->code,
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content space-y-5">
    <div class="flex justify-between">
        <div>
            <h1 class="text-3xl font-bold mt-10">
                <?php echo e($detail->code); ?>

            </h1>
            <p><?php echo e($detail->created_at); ?></p>
        </div>
        <div class="mt-5 relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center">
            <div class="lg:text-center flex items-center lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full btn btn-primary">1</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Đặt hàng</div>
                <div class="lg:w-32 lg:mt-3 ml-3 lg:mx-auto"><?php echo e($detail->created_at); ?></div>
            </div>
            <div class="lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <button class="w-10 h-10 rounded-full btn btn-primary">2</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Duyệt</div>
                <div class="lg:w-32 lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400"><?php echo e($detail->created_at); ?></div>
            </div>
            <div class="lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <?php if(!empty($detail->created_stock_at)): ?>
                <button class="w-10 h-10 rounded-full btn btn-primary">3</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Nhập kho</div>
                <div class="lg:w-32 lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400"><?php echo e($detail->created_stock_at); ?></div>
                <?php else: ?>
                <button class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">3</button>
                <div class="lg:w-32 lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Nhập kho</div>
                <?php endif; ?>

            </div>
            <div class="lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                <?php if(!empty($detail->created_completed_at)): ?>
                <button class="w-10 h-10 rounded-full btn btn-primary">4</button>
                <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Hoàn thành</div>
                <div class="lg:w-32 lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400"><?php echo e($detail->created_completed_at); ?></div>
                <?php else: ?>
                <button class="w-10 h-10 rounded-full btn text-slate-500 bg-slate-100 dark:bg-darkmode-400 dark:border-darkmode-400">4</button>
                <div class="lg:w-32 lg:mt-3 ml-3 lg:mx-auto text-slate-600 dark:text-slate-400">Hoàn thành</div>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-8 space-y-3">
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin nhà cung cấp
                    </h2>
                </div>
                <div class="p-5">
                    <div class="" id="loadDataInfoSuppliers">
                        <div class="flex items-center justify-between">
                            <div class="item flex items-center hover:text-danger cursor-pointer js_handleCloseInfoSuppliers">
                                <div class="w-10 h-10 rounded-full"><img src="https://ui-avatars.com/api/?name=<?php echo e($detail->suppliers->title); ?>" class="rounded-full w-full"></div>
                                <div class="flex items-center"><span class="mx-2 font-bold text-danger"><?php echo e($detail->suppliers->title); ?></span>

                                </div>
                            </div>
                            <div>Công nợ: <b><?php echo e(number_format($detail->suppliers->debt,'0',',','.')); ?>₫</b></div>
                        </div>
                        <div class="mt-3 border-t pt-3">
                            <h2 class="font-medium text-base mr-auto">Thông tin chi tiết:</h2>
                            <div class="space-y-1">
                                <p>Mã nhà cung cấp: <?php echo e($detail->suppliers->code); ?></p>
                                <p> Số điện thoại: <?php echo e($detail->suppliers->phone); ?></p>
                                <p>Email: <?php echo e($detail->suppliers->email); ?></p>
                                <p>Địa chỉ: <?php echo e($detail->suppliers->address); ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin sản phẩm
                    </h2>
                </div>
                <div class="p-5">
                    <div class="overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">Mã sản phẩm</th>
                                    <th class="whitespace-nowrap">Tên sản phẩm</th>
                                    <th class="text-center whitespace-nowrap">Đơn vị</th>
                                    <th class="text-center whitespace-nowrap">Số lượng </th>
                                    <th class="text-center whitespace-nowrap">Giá nhập</th>
                                    <th class="text-center whitespace-nowrap">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody id="htmlShowPurchase">
                                <?php echo $products['html']; ?>
                            </tbody>

                        </table>
                    </div>
                    <div>
                        <div class="flex justify-between p-4">
                            <span class="font-bold flex-1" style="text-align: right;border:0px">Số lượng</span>
                            <span style="text-align: center;;border:0px;width: 200px;" class="js_quantity_purchases"><?php echo e($products['quantity']); ?></span>
                        </div>
                        <div class="flex justify-between p-4">
                            <span class="font-bold flex-1" style="text-align: right;;border:0px">Tổng tiền</span>
                            <span style="text-align: center;;border:0px;width: 200px;" class="js_provisional_purchases"><?php echo e(number_format($products['provisional'],'0',',','.')); ?>đ</span>
                        </div>
                        <div class="flex justify-between p-4">
                            <div style="text-align: right;;border:0px" class="flex-1">
                                <div class="flex text-danger font-bold justify-end items-center space-x-1 relative">
                                    <a href="javascript:void(0)" class="js_toggleDiscount flex items-center space-x-1">
                                        <span>Chiết khấu</span>
                                    </a>

                                </div>
                            </div>
                            <div style="text-align: center;;border:0px;width: 200px;" class="js_priceDiscount">- <?php echo e(number_format($products['priceDiscount'],'0',',','.')); ?>đ</div>
                        </div>
                        <div class="js_html_VAT">
                            <?php echo $products['htmlVAT'] ?>
                        </div>
                        <div class="flex justify-between p-4">
                            <div style="text-align: right;;border:0px" class="flex-1">
                                <a href="javascript:void(0)" class="flex text-danger font-bold justify-end items-center space-x-1" data-tw-toggle="modal" data-tw-target="#modal-add-surcharge">
                                    <span>Chi phí</span>

                                </a>
                            </div>
                            <div style="text-align: center;;border:0px;width: 200px;" class="js_priceSurcharge"><?php echo e(number_format($products['priceSurcharge'],'0',',','.')); ?>đ</div>
                        </div>
                        <div class="flex justify-between p-4">
                            <div style="text-align: right;;border:0px" class="text-danger font-bold flex-1">Tiền cần trả</div>
                            <div style="text-align: center;;border:0px;width: 200px;" class="js_totalPriceCart"><?php echo e(number_format($products['total'],'0',',','.')); ?>đ</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Thanh toán
                    </h2>
                    <div class="flex items-center gap-2">
                        <span>
                            Đã thanh toán: <b><?php echo e(number_format($detail->product_purchases_financials->sum('price'),'0',',','.')); ?>đ</b> - Còn phải trả: <b><?php echo e(number_format($price,'0',',','.')); ?></b>
                        </span>
                        <?php if(!empty($price)): ?>
                        <div class="text-center">
                            <div class="dropdown inline-block" data-tw-placement="bottom-start">
                                <button class="dropdown-toggle btn btn-primary" aria-expanded="false" data-tw-toggle="dropdown">
                                    Xác nhận thanh toán
                                    <i data-lucide="chevron-down" class="w-4 h-4 ml-2"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="dropdown-content">
                                        <div class="p-2">
                                            <div>
                                                <div class="text-xs">Phương thức thanh toán</div>
                                                <select class="form-control mt-2">
                                                    <?php $__currentLoopData = config('payment.method'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e($item); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                                <div class="text-xs">Số tiền thanh toán</div>
                                                <input type="text" class="form-control mt-2 flex-1 float" placeholder="" value="<?php echo e(number_format($price,'0',',','.')); ?>" />
                                            </div>
                                            <div class="mt-3">
                                                <div class="text-xs">Tham chiếu</div>
                                                <input type="text" class="form-control mt-2 flex-1 float" placeholder="" />
                                            </div>
                                            <div class="flex items-center mt-3">
                                                <button data-dismiss="dropdown" class="btn btn-secondary w-32 ml-auto">Đóng</button>
                                                <button class="btn btn-primary w-32 ml-2">Áp dụng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if(count($detail->product_purchases_financials) > 0): ?>
                <div class="p-5">
                    <!-- BEGIN: Timeline Wrapper -->
                    <div class="px-5 mt-5 -mb-5 pb-5 relative overflow-hidden before:content-[''] before:absolute before:w-px before:bg-slate-200/60 before:dark:bg-darkmode-400 before:mr-auto before:left-0 lg:before:right-0 before:ml-3 lg:before:ml-auto before:h-full before:mt-8 ">
                        <?php $__currentLoopData = $detail->product_purchases_financials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative z-10 bg-white dark:bg-darkmode-600 py-2 my-5 text-center text-slate-500 text-xs"><?php echo e($item->created_at); ?></div>
                        <!-- BEGIN: Timeline Content Latest -->
                        <div class=" lg:ml-[51%] pl-6 lg:pl-[51px] before:content-[''] before:absolute before:w-20 before:h-px before:mt-8 before:left-[60px] before:bg-slate-200 before:dark:bg-darkmode-400 before:rounded-full before:inset-x-0 before:mx-auto before:z-[-1] ">
                            <div class=" bg-white dark:bg-darkmode-400 shadow-sm border border-slate-200 rounded-md p-5 flex flex-col sm:flex-row items-start gap-y-3 mt-10 before:content-[''] before:absolute before:w-6 before:h-6 before:bg-primary/20 before:rounded-full before:inset-x-0 lg:before:ml-auto before:mr-auto lg:before:animate-ping after:content-[''] after:absolute after:w-6 after:h-6 after:bg-primary after:rounded-full after:inset-x-0 lg:after:ml-auto after:mr-auto after:border-4 after:border-white/60 after:dark:border-darkmode-300 ">
                                <div>
                                    <span class="text-primary font-medium">
                                        Xác nhận thanh toán <?php echo e(number_format($item->price,'0',',','.')); ?>đ thành công
                                    </span>
                                    <div class="text-slate-500 text-xs mt-1.5">
                                        <p><b>Phương thức thanh toán:</b> <?php echo e(!empty($item->method)?config('payment.method')[$item->method]: '---'); ?></p>
                                        <p><b>Tham chiếu:</b> <?php echo e(!empty($item->reference)?$item->reference:'---'); ?></p>
                                        <p><b>Người thanh toán:</b> <?php echo e($item->users->name); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Timeline Content Latest -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- END: Timeline Content -->
                    </div>

                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4 space-y-3">
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Thông tin đơn nhập
                    </h2>
                    <div>
                        <span class="<?php echo e(config('payment.statusColor')[$detail->status]); ?> font-bold"><?php echo e(config('payment.status')[$detail->status]); ?></span>
                    </div>
                </div>
                <div class="p-5 space-y-2">
                    <p><b>Chi nhánh:</b> <?php echo e($detail->address->title); ?></p>
                    <p><b>Ngày hẹn giao:</b> <?php echo e($detail->dueOn); ?></p>
                    <p><b>Tham chiếu:</b> <?php echo e(!empty($detail->reference)?$detail->reference:'---'); ?></p>
                </div>
            </div>
            <div class="box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Ghi chú
                    </h2>

                </div>
                <div class="p-5 space-y-2">
                    <?php echo e(!empty($detail->note)?$detail->note:'Chưa có ghi chú'); ?>

                </div>
            </div>
        </div>
    </div>


</div>
<style>
    .before\:bg-slate-100::before {
        background-color: #dddddd;
    }

    .html_deletePurchase a {
        display: none;
    }

    #htmlShowPurchase input {
        border: 0px !important;
        box-shadow: none;
        pointer-events: none;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/product/backend/purchases/show.blade.php ENDPATH**/ ?>