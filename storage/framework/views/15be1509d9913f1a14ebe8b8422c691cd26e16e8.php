
<?php $__env->startSection('title'); ?>
<title>Nhà cung cấp</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách nhà cung cấp",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Nhà cung cấp
    </h1>
    <div class=" mt-3 flex flex-col md:flex-row gap-2 justify-between md:items-center">
        <ul class="flex items-center space-x-4">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('suppliers_index')): ?>
            <li>
                <a href="<?php echo e(route('suppliers.export')); ?>" class="flex items-center space-x-1 btn btn-sm btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <span>Xuất file</span>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('suppliers_create')): ?>
            <li>
                <a href="javascript:void(0)" data-tw-toggle="modal" data-tw-target="#import_suppliers" class="flex items-center space-x-1 btn btn-sm btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <span>Nhập file</span>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('suppliers_categories_index')): ?>
            <li>
                <a href="<?php echo e(route('suppliers_categories.index')); ?>" class="flex items-center space-x-1 btn btn-sm btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <span>Nhóm nhà cung cấp</span>
                </a>
            </li>
            <?php endif; ?>

        </ul>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('suppliers_create')): ?>
        <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary shadow-md">Thêm mới</a>
        <?php endif; ?>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class=" col-span-12 ">
            <form action="" class="" id="search" style="margin-bottom: 0px;">
                <div class="flex gap-2 flex-wrap">
                    <select class="flex-auto form-control ajax-delete-all mr10" style="width: 150px;height:42px" data-title="Lưu ý: Khi bạn xóa danh mục nội dung tĩnh, toàn bộ nội dung tĩnh trong nhóm này sẽ bị xóa. Hãy chắc chắn rằng bạn muốn thực hiện chức năng này!" data-module="<?php echo e($module); ?>">
                        <option>Hành động</option>
                        <option value="">Xóa</option>
                    </select>
                    <?php if(!empty($listUsers)): ?>
                    <div class="flex-auto">
                        <?php echo Form::select('user_id', $listUsers, request()->get('user_id'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty($categories)): ?>
                    <div class="flex-auto">
                        <?php echo Form::select('category_id', $categories, request()->get('category_id'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    <?php endif; ?>
                    <div class="flex-auto">
                        <?php echo Form::select('publish', array('-1' => 'Chọn trạng thái', '1' => 'Ngừng giao dịch', '0' => 'Đang giao dịch'), request()->get('publish'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    <div class="flex-auto">
                        <?php echo Form::select('payment', $payments, request()->get('payment'), ['class' => 'form-control tom-select tom-select-custom', 'data-placeholder' => "Select your favorite actors", 'style' => 'height:42px']); ?>
                    </div>
                    <input type="search" name="keyword" class="keyword form-control" placeholder="Tìm kiếm theo mã, tên, email, số điện thoại nhà cung cấp ..." autocomplete="off" value="<?php echo request()->get('keyword') ?>" style="width:400px;max-width: 100%;">
                    <button class="btn btn-primary">
                        <i data-lucide="search"></i>
                    </button>
                </div>
            </form>
        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th style="width:40px;">
                            <input type="checkbox" id="checkbox-all">
                        </th>
                        <th class="whitespace-nowrap">STT</th>
                        <th class="whitespace-nowrap">Mã</th>
                        <th class="whitespace-nowrap">Tên</th>
                        <th class="whitespace-nowrap">Nhóm </th>
                        <th class="whitespace-nowrap">Email</th>
                        <th class="whitespace-nowrap">Số điện thoại</th>
                        <th class="whitespace-nowrap">Công nợ</th>
                        <th class="whitespace-nowrap">Giao dịch</th>
                        <th class="whitespace-nowrap">#</th>
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
                            <a href="" class="text-danger font-bold"><?php echo e($v->code); ?></a>
                        </td>
                        <td>
                            <?php echo e($v->title); ?>

                        </td>
                        <td>
                            <?php echo e($v->categories->title); ?>

                        </td>
                        <td>
                            <?php echo e($v->email); ?>

                        </td>
                        <td>
                            <?php echo e($v->phone); ?>

                        </td>
                        <td>
                            <?php echo e(number_format($v->debt,'0',',','.')); ?>

                        </td>
                        <td class="w-40">
                            <?php echo $__env->make('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                            $v->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('suppliers_edit')): ?>
                                <a class="flex items-center mr-3" href="<?php echo e(route('suppliers.edit',['id'=>$v->id])); ?>">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('suppliers_destroy')): ?>
                                <a class="flex items-center text-danger ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa thuộc tính, thuộc tính sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                                <?php endif; ?>
                            </div>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<div id="import_suppliers" class="modal" tabindex="-1" aria-hidden="true">
    <form action="<?php echo route('suppliers.import') ?>" class="modal-dialog modal-lg" method="post" enctype="multipart/form-data">
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/suppliers/suppliers/index.blade.php ENDPATH**/ ?>