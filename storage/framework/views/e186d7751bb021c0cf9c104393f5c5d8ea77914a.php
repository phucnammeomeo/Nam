

<?php $__env->startSection('title'); ?>
    <title>Cập nhập từ gợi ý</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php
    $array = array(
        [
            "title" => "Danh sách từ gợi ý",
            "src" => route('keywords.index'),
        ],
        [
            "title" => "Cập nhập",
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
                Cập nhập từ gợi ý
            </h1>
        </div>
        <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="<?php echo e(route('keywords.update',['id' => $detail->id])); ?>" method="post" enctype="multipart/form-data">
            <div class=" col-span-12 lg:col-span-12">
                <ul class="nav nav-link-tabs flex-wrap" role="tablist">

                    <li id="example-homepage-tab" class="nav-item" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-homepage" type="button" role="tab" aria-controls="example-tab-homepage" aria-selected="true">Thông tin chung</button>
                    </li>
                    <?php if(!$field->isEmpty()): ?>
                        <li id="example-contact-tab" class="nav-item " role="presentation">
                            <button class="nav-link w-full py-2 " data-tw-toggle="pill" data-tw-target="#example-tab-contact" type="button" role="tab" aria-controls="example-tab-contact" aria-selected="true">Custom field</button>
                        </li>
                    <?php endif; ?>
                </ul>
                <!-- BEGIN: Form Layout -->
                <div class=" box p-5">
                    <?php echo $__env->make('components.alert-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo csrf_field(); ?>
                    <div class="tab-content">
                        <div id="example-tab-homepage" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-homepage-tab">
                            <div>
                                <label class="form-label text-base font-semibold">Tiêu đề từ khoá</label>
                                <?php echo Form::text('title', $detail->title, ['class' => 'form-control w-full title']); ?>
                            </div>
                        </div>
                        <div id="example-tab-contact" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-contact-tab">
                            <?php echo $__env->make('components.field.index', ['module' => $module], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </div>

                <?php echo $__env->make('components.publish', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class=" box p-5 mt-3">
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24">Lưu</button>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien3/domains/khangdien.tamphat.edu.vn/public_html/resources/views/keyword/backend/edit.blade.php ENDPATH**/ ?>