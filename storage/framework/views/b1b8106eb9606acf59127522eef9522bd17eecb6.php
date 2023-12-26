
<?php $__env->startSection('title'); ?>
<title>Danh sách yêu cầu gia công</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách yêu cầu gia công",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh sách yêu cầu gia công
    </h1>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <?php echo $__env->make('components.search',['module'=>$module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        <th class="whitespace-nowrap">Thông tin</th>
                        <th class="whitespace-nowrap">Địa chỉ</th>
                        <th class="whitespace-nowrap">Nội dung</th>
                        <th class="whitespace-nowrap">File Upload</th>
                        <th class="whitespace-nowrap">Ngày gửi</th>
                        <th class="whitespace-nowrap text-center">#</th>
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
                            <p><?php echo $v->fullname; ?></p>
                            <p><?php echo $v->phone; ?></p>
                            <p><?php echo $v->email; ?></p>
                        </td>
                        <td>
                            <p><?php echo $v->address; ?></p>
                        </td>
                        <td>
                            <p><?php echo $v->message; ?></p>
                        </td>
                        <td>
                            <?php if(File::exists(base_path($v->file))): ?>
                            <?php if(!empty($v->file)): ?>
                            <a href="<?php echo asset($v->file); ?>" download="">Tải file</a>
                            <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo e($v->created_at); ?>

                        </td>
                        <td class="table-report__action w-56 ">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="<?php echo e(route('machining.edit',['id'=>$v->id])); ?>">
                                    Xem chi tiết
                                </a>
                                <a class="flex items-center text-danger ajax-delete" href="javascript:;" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa bài viết, bài viết sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
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
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/contact/backend/machining.blade.php ENDPATH**/ ?>