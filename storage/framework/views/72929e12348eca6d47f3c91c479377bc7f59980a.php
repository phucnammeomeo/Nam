

<?php $__env->startSection('title'); ?>
    <title>Cập nhập từ gợi ý</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php
    $array = array(
        [
            "title" => "Danh sách phí vận chuyển",
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
                Cập nhập phí vận chuyển <?php echo e($detail->name); ?>

            </h1>
        </div>

        <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="<?php echo e(route('ships.update_province', ['id' => $detail->id])); ?>?" method="post" enctype="multipart/form-data">
            <div class=" col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <div class=" box p-5">
                    <?php echo $__env->make('components.alert-error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo csrf_field(); ?>

                    <div class="tab-content">
                        <div id="example-tab-homepage" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-homepage-tab">
                            <div>
                                <label class="form-label text-base font-semibold">Giá vận chuyển</label>
                                <?php echo Form::text('price', $detail->price, ['class' => 'form-control w-full']); ?>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Nội dung</label>
                            <div class="mt-2">
                                <?php echo Form::textarea('description', $detail->description, ['id' => 'ckContent', 'class' => 'ck-editor', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                            </div>
                        </div>
                    </div>
                </div>


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
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien3/domains/khangdien.tamphat.edu.vn/public_html/resources/views/ship/backend/updateProvince.blade.php ENDPATH**/ ?>