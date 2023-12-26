<?php $__env->startSection('title'); ?>
<title>Danh sách đơn nhập hàng</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách đơn nhập hàng",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class="mt-10 space-y-3 box p-5">
        <div class="flex justify-between ">
            <h1 class=" text-lg font-medium ">
                Danh sách đơn nhập hàng
            </h1>
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-end">
                <ul class="flex items-center">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_purchases_index')): ?>
                    <li>
                        <a href="<?php echo e(route('suppliers_categories.index')); ?>" class="flex items-center space-x-1 btn btn-sm btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                            </svg>
                            <span>Quản lý trả hàng NCC</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_purchases_create')): ?>
                <a href="<?php echo e(route('product_purchases.create')); ?>" class="btn btn-primary shadow-md">Tạo đơn nhập hàng</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="">
            <form action="" class="" id="search" style="margin-bottom: 0px;">
                <div class="grid grid-cols-12 gap-2 flex-wrap ">
                    <select class="flex-auto form-control ajax-delete-all mr10 col-span-2" style="height:42px" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                        <option>Hành động</option>
                        <option value="">Xóa</option>
                    </select>
                    <?php if(!empty($listUsers)): ?>
                    <div class="flex-auto col-span-2">
                        <?php echo Form::select('user_id', $listUsers, request()->get('user_id'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    <?php endif; ?>
                    <div class="flex-auto col-span-2">
                        <?php echo Form::select('payment', config('payment.status'), request()->get('payment'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    <div class="flex col-span-4 justify-between gap-2">
                        <input type="search" name="keyword" class="keyword form-control" placeholder="Tìm kiếm theo mã, tên, email, số điện thoại nhà cung cấp ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>">
                        <button class="btn btn-primary">
                            <i data-lucide="search"></i>
                        </button>
                    </div>
                    <a class="flex col-span-2 gap-2 items-center justify-end text-base btn btn-default tp-cart" href="javascript:void(0)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5" />
                        </svg>
                        <span>Bộ lọc khác</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-3">

        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        <th class="whitespace-nowrap">STT</th>
                        <th class="whitespace-nowrap">Mã đơn</th>
                        <th class="whitespace-nowrap">Tên nhà cung cấp</th>
                        <th class="whitespace-nowrap">Chi nhánh</th>
                        <th class="whitespace-nowrap">Trạng thái</th>
                        <th class="whitespace-nowrap">Thanh toán</th>
                        <th class="whitespace-nowrap"> Nhập kho</th>
                        <th class="whitespace-nowrap">Tổng tiền</th>
                        <th class="whitespace-nowrap">Nhân viên tạo</th>
                        <th class="whitespace-nowrap">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="odd " id="post-<?php echo $v->id; ?>">
                        <td>
                            <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item">
                        </td>
                        <td>
                            <?php echo e($data->firstItem()+$loop->index); ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('product_purchases.show',['id'=>$v->id])); ?>" class="text-danger font-bold"><?php echo e($v->code); ?></a>
                        </td>
                        <td>
                            <?php echo e($v->suppliers->title); ?>

                        </td>
                        <td>
                            <?php echo e($v->address->title); ?>

                        </td>
                        <td class="font-bold <?php echo e(config('payment.statusColor')[$v->status]); ?>"><?php echo e(config('payment.status')[$v->status]); ?></td>
                        <td class="font-bold <?php echo e(config('payment.financialStatusColor')[$v->financialStatus]); ?>"><?php echo e(config('payment.financialStatus')[$v->financialStatus]); ?></td>
                        <td class="font-bold <?php echo e(config('payment.receiveStatusColor')[$v->receiveStatus]); ?>"><?php echo e(config('payment.receiveStatus')[$v->receiveStatus]); ?></td>
                        <td>
                            <?php echo e(number_format($v->price_total,'0',',','.')); ?>

                        </td>
                        <td>
                            <?php echo e($v->user->name); ?>

                        </td>
                        <td>
                            <?php echo e($v->created_at); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
            <?php echo e($data->links()); ?>

        </div>
        <!-- END: Pagination -->
    </div>
</div>
<div class="offcanvas-overlay fixed inset-0 bg-black opacity-50 z-50 hidden" style="background: #0000007a;"></div>
<div id="offcanvas-cart" style="width:520px;max-width: 100%;z-index: 99;" class="offcanvas left-auto right-0 transform fixed font-normal text-sm top-0 z-50 h-screen w-80 lg:w-96 transition-all ease-in-out duration-300 bg-white overflow-y-auto hidden animated fadeInRight">
    <div class="p-2">
        <div class="flex flex-wrap justify-between items-center pb-6 mb-6 border-b border-solid border-gray-600">
            <h4 class="font-normal text-xl">Bộ lọc</h4>
            <button class="offcanvas-close hover:text-green-500">
                <svg class="w-4 h-4 " viewBox="0 0 16 14">
                    <path d="M15 0L1 14m14 0L1 0" stroke="currentColor" fill="none" fill-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="mt-5 space-y-3">

            <div class="flex-auto ">
                <label class="font-medium mb-2">Trạng thái</label>
                <?php echo Form::select('payment', config('payment.status'), request()->get('payment'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Trạng thái", 'style' => 'height:42px']); ?>
            </div>
            <div class="flex-auto ">
                <label class="font-medium mb-2">Nhập kho</label>
                <?php echo Form::select('receiveStatus', config('payment.receiveStatus'), request()->get('receiveStatus'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Trạng thái nhập kho", 'style' => 'height:42px']); ?>
            </div>
            <div class="flex-auto ">
                <label class="font-medium mb-2">Thanh toán</label>
                <?php echo Form::select('financialStatus', config('payment.financialStatus'), request()->get('financialStatus'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Trạng thái thanh toán", 'style' => 'height:42px']); ?>
            </div>
            <?php if(!empty($listUsers)): ?>
            <div class="flex-auto">
                <label class="font-medium mb-2">Nhân viên</label>
                <?php echo Form::select('user_id', $listUsers, request()->get('user_id'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Tìm kiếm nhân viên", 'style' => 'height:42px']); ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($listAddress)): ?>
            <div class="flex-auto">
                <label class="font-medium mb-2">Chi nhánh</label>
                <?php echo Form::select('address_id', $listAddress, request()->get('address_id'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Tìm kiếm chi nhánh", 'style' => 'height:42px']); ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($listSuppliers)): ?>
            <div class="flex-auto">
                <label class="font-medium mb-2">Nhà cung cấp</label>
                <?php echo Form::select('suppliers_id', $listSuppliers, request()->get('suppliers_id'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Tìm kiếm nhà cung cấp", 'style' => 'height:42px']); ?>
            </div>
            <?php endif; ?>
            <div class="flex-auto ">
                <label class="font-medium mb-2">Ngày tạo</label>
                <input type="search" name="created_at" class="keyword form-control datetimepicker" placeholder="" autocomplete="off" value="<?php echo request()->get('created_at') ?>">
            </div>
            <div class="flex-auto ">
                <label class="font-medium mb-2">Ngày hẹn giao hàng</label>
                <input type="search" name="dueOn" class="keyword form-control datetimepicker" placeholder="" autocomplete="off" value="<?php echo request()->get('dueOn') ?>">
            </div>
            <div class="flex-auto ">
                <label class="font-medium mb-2">Tìm kiếm theo mã, tên, email, số điện thoại nhà cung cấp ...</label>
                <input type="search" name="keyword" class="keyword form-control" placeholder="" autocomplete="off" value="<?php echo request()->get('keyword') ?>">
            </div>
            <div class="flex justify-end">
                <button class="btn btn-primary">
                    Tìm kiếm
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('library/datetimepicker/jquery.datetimepicker.full.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('library/datetimepicker/jquery.datetimepicker.min.css')); ?>" />
<script type="text/javascript">
    $.datetimepicker.setLocale('vi');
    $('.datetimepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        minDate: 0
    });
</script>
<div id="import_suppliers" class="modal" tabindex="-1" aria-hidden="true">
    <form action="<?php echo route('product_purchases.import') ?>" class="modal-dialog modal-lg" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-lg mr-auto">
                    Nhập dữ liệu nhà cung cấp
                </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body text-base">
                <h2 class="font-medium">Chú ý:</h2>
                <p>- Mã nhà cung cấp phải là duy nhất đối với các nhà cung cấp độc lập</p>
                <p>- Chuyển đổi file nhập dưới dạng .xlsx trước tải dữ liệu.</p>
                <p>- Tải file mẫu nhà cung cấp <a href="<?php echo e(asset('upload/files/import-suppliers.xlsx')); ?>" download="" class="text-danger text-bold">tại đây</a></p>
                <p>- File nhập có dung lượng tối đa là 2MB và 5000 bản ghi.</p>
                <div class="py-5">
                    <label for="file_import_suppliers" class="cursor-pointer flex justify-center space-x-2" style="border: 2px dashed rgba(0, 0, 0, 0.3);background: white;padding: 10px 0px;">
                        <input type="file" name="file" class="hidden" id="file_import_suppliers">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                        </svg>
                        <span class="file-return">Tải lên từ thiết bị</span>
                    </label>
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Hủy</button>
                <button type="submit" class="btn btn-primary">Nhập file</button>
            </div>
            <!-- END: Modal Footer -->
        </div>
    </form>
</div>
<script>
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.file-return').html(fileName);;
    });
</script>
<script>
    $('.tp-cart').click(function() {
        $('.offcanvas-overlay').toggleClass('hidden');
        $('#offcanvas-cart').toggleClass('hidden');
    });
    $(".offcanvas-close, .offcanvas-overlay").on("click", function(e) {
        e.preventDefault();
        $('.offcanvas-overlay').addClass('hidden');
        $('#offcanvas-cart').addClass('hidden ');
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\khangdien\resources\views/product/backend/purchases/index.blade.php ENDPATH**/ ?>