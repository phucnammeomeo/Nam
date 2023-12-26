<?php $__env->startSection('title'); ?>
<title>Thêm mới </title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Cấu hình",
        "src" => route('generals.index'),
    ],
    [
        "title" => "Danh sách ",
        "src" => route('config_images.index'),
    ],
    [
        "title" => "Thêm mới",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);

?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
    <div class=" flex items-center mt-8">
        <h1 class="text-lg font-medium mr-auto">
            Thêm mới
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="<?php echo e(route('config_images.store')); ?>" method="post" enctype="multipart/form-data">
        <div class="col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class=" box p-5">
                <?php echo $__env->make('components.alert-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo csrf_field(); ?>
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Module</label>
                    <?php echo Form::select('module', $table, null, ['class' => 'tom-select tom-select-custom w-full', 'data-placeholder' => ""]); ?>
                </div>
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Thumbnail</label>
                    <div class=" box p-5">
                        <div class="mt-3 grid grid-cols-5 items-center gap-6">
                            <label class="form-label text-base font-semibold col-span-1">Small</label>
                            <?php echo Form::text('data[type][]', 'small', ['class' => 'form-control hidden', 'required']); ?>
                            <?php echo Form::text('data[with][]', '', ['class' => 'form-control', 'required']); ?>
                            <?php echo Form::text('data[height][]', '', ['class' => 'form-control', 'required']); ?>
                        </div>
                        <div class="mt-3 grid grid-cols-5 items-center gap-6">
                            <label class="form-label text-base font-semibold col-span-1">Medium</label>
                            <?php echo Form::text('data[type][]', 'medium', ['class' => 'form-control hidden', 'required']); ?>
                            <?php echo Form::text('data[with][]', '', ['class' => 'form-control', 'required']); ?>
                            <?php echo Form::text('data[height][]', '', ['class' => 'form-control', 'required']); ?>
                        </div>
                        <div class="mt-3 grid grid-cols-5 items-center gap-6">
                            <label class="form-label text-base font-semibold col-span-1">Large</label>
                            <?php echo Form::text('data[type][]', 'large', ['class' => 'form-control hidden', 'required']); ?>
                            <?php echo Form::text('data[with][]', '', ['class' => 'form-control', 'required']); ?>
                            <?php echo Form::text('data[height][]', '', ['class' => 'form-control', 'required']); ?>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary btn-submit">Thêm mới</button>
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\khangdien\resources\views/config/images/create.blade.php ENDPATH**/ ?>