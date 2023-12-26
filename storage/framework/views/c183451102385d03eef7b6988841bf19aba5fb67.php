<?php $__env->startSection('title'); ?>
<title>Cấu hình email ứng dụng</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Cấu hình",
        "src" => route('generals.index'),
    ],
    [
        "title" => "Cấu hình email ứng dụng",
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
            Cấu hình email ứng dụng
        </h1>
    </div>
    <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="<?php echo e(route('config_emails.update',['id' => $detail->id])); ?>" method="post" enctype="multipart/form-data">
        <div class="col-span-12">
            <!-- BEGIN: Form Layout -->
            <div class=" box p-5">
                <?php echo $__env->make('components.alert-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo csrf_field(); ?>
                <div>
                    <label class="form-label text-base font-semibold">Tiêu đề </label>
                    <?php echo Form::text('title', $detail->title, ['class' => 'form-control w-full', 'readonly']); ?>
                </div>

                <?php if($detail->id == 1): ?>
                <?php
                $emails = json_decode($detail->data, TRUE);
                ?>
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Email ứng dụng </label>
                    <?php echo Form::text('email[]', !empty($emails) ? trim($emails[0]) : '', ['class' => 'form-control w-full', 'autocomplete' => 'off']); ?>
                </div>
                <div class="mt-3">
                    <label class="form-label text-base font-semibold">Mật khẩu ứng dụng </label>
                    <?php echo Form::text('email[]', !empty($emails) ? trim($emails[1]) : '', ['class' => 'form-control w-full', 'autocomplete' => 'off']); ?>
                </div>
                <?php endif; ?>
                <p class="text-center italic mt-5">" Lưu ý <span class="font-bold text-red-500">không thay đổi</span> thông tin bên trên <span class="font-bold">hoặc</span> thay đổi theo hướng dẫn sau: <a class="text-red-500" href="https://wiki.matbao.net/kb/huong-dan-tao-mat-khau-ung-dung-dich-vu-email-cua-google/" target="_blank">Xem thêm</a> tại đây! "</p>



                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary btn-submit">Cập nhập</button>
                </div>
            </div>

            <!-- END: Form Layout -->
        </div>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/config/email/edit.blade.php ENDPATH**/ ?>