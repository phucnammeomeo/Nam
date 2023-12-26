<?php $__env->startSection('title'); ?>
<title>Giao diện website</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Giao diện website",
        "src" => route('websites.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Giao diện website
    </h1>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('websites_create')): ?>
            <a href="javascript:void(0)" onclick="handleCreate()" class="btn btn-primary shadow-md mr-2">Thêm mới</a>
            <?php endif; ?>
        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-3">
                    <ul class="nav nav-link-tabs flex-col" role="tablist">
                        <?php if(!$data->isEmpty()): ?>
                        <?php $i = 0; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++; ?>
                        <li id="example-5-tab" class="nav-item flex-1" role="presentation">
                            <button class="pl-0 nav-link w-full py-2 text-left <?php if (request()->get('type') == $key) { ?>active<?php } else if (empty(request()->get('type')) &&  $i == 1) { ?>active<?php } ?>" data-type="<?php echo $key ?>" data-tw-toggle="pill" data-tw-target="#example-tab-<?php echo $i ?>" type="button" role="tab" aria-controls="example-tab<?php echo $i ?>" aria-selected="true" style="padding-left: 0px;"><?php echo e($type[$key]); ?></button>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-span-9">
                    <div class="tab-content mt-5">
                        <?php if(!$data->isEmpty()): ?>
                        <?php $i = 0; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $i++; ?>
                        <div id="example-tab-<?php echo $i ?>" class="tab-pane leading-relaxed <?php if (request()->get('type') == $key) { ?>active<?php } else if (empty(request()->get('type')) &&  $i == 1) { ?>active<?php } ?>" role="tabpanel" aria-labelledby="example-<?php echo $i ?>-tab">
                            <?php if(count($item) > 0): ?>

                            <?php if($key == 'header' || $key == 'footer'): ?>
                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="box item w-full mb-5 p-2">
                                <a href="<?php echo e(asset($val->image)); ?>" data-fancybox><img class="w-full" src="<?php echo e(asset($val->image)); ?>" alt="<?php echo e($val->title); ?>"></a>
                                <div class="mt-5">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h2 class="font-bold text-base mb-2"><?php echo e($val->title); ?></h2>
                                            <div class="form-check form-switch space-x-2">
                                                <input <?php echo ($val->publish == 1) ? 'checked=""' : ''; ?> class="form-check-input publish-ajax-website" type="checkbox" data-id="<?php echo $val->id; ?>" data-keyword="<?php echo $val->keyword; ?>" id="publish-<?php echo $val->id; ?>">
                                                <span>Kích hoạt</span>
                                            </div>
                                        </div>
                                        <div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('websites_edit')): ?>
                                            <a class="flex items-center mr-3 text-lg font-bold" href="<?php echo e(route('websites.edit',['id'=>$val->id])); ?>">
                                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <?php endif; ?>
                            <div class="grid grid-cols-3 gap-3">
                                <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="box item w-full mb-5 p-2">
                                    <a href="<?php echo e(asset($val->image)); ?>" data-fancybox><img class="w-full" style="height:300px;object-fit: contain;" src="<?php echo e(asset($val->image)); ?>" alt="<?php echo e($val->title); ?>"></a>
                                    <div class="mt-5">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <h2 class="font-bold text-base mb-2"><?php echo e($val->title); ?></h2>
                                                <div class="form-check form-switch space-x-2">
                                                    <input <?php echo ($val->publish == 1) ? 'checked=""' : ''; ?> class="form-check-input publish-ajax-website" type="checkbox" data-id="<?php echo $val->id; ?>" data-keyword="<?php echo $val->keyword; ?>" id="publish-<?php echo $val->id; ?>">
                                                    <span>Kích hoạt</span>
                                                </div>
                                            </div>
                                            <div>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('websites_edit')): ?>
                                                <a class="flex items-center mr-3 text-lg font-bold" href="<?php echo e(route('websites.edit',['id'=>$val->id])); ?>">
                                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
        <!-- END: Data List -->
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    function handleCreate() {
        var type = $('.nav-link-tabs li button.active').attr('data-type');
        var url = "<?php echo e(route('websites.create')); ?>?type=" + type;
        window.location.href = url;
    }
    /*START: ajax publish*/
    $(document).on('change', '.publish-ajax-website', function() {
        let _this = $(this);
        let param = {
            id: _this.attr("data-id"),
            keyword: _this.attr("data-keyword"),
        };
        swal({
                title: "Hãy chắc chắn rằng bạn muốn thực hiện thao tác này?",
                text: '',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Thực hiện!",
                cancelButtonText: "Hủy bỏ!",
                closeOnConfirm: false,
                closeOnCancel: false,
            },
            function(isConfirm) {
                if (isConfirm) {
                    let formURL = '<?php echo route('websites.publish') ?>';
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        url: formURL,
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            param: param
                        },
                        success: function(data) {
                            if (data.code === 200) {
                                swal({
                                    title: "Cập nhập thành công!",
                                    text: "",
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: "Có vấn đề xảy ra",
                                    text: "Vui lòng thử lại",
                                    type: "error"
                                }, function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(jqXhr, json, errorThrown) {
                            var errors = jqXhr.responseJSON;
                            var errorsHtml = "";
                            $.each(errors["errors"], function(index, value) {
                                errorsHtml += value + "/ ";
                            });
                        },
                    });
                } else {
                    swal({
                        title: "Hủy bỏ",
                        text: "Thao tác bị hủy bỏ",
                        type: "error"
                    }, function() {
                        location.reload();
                    });
                }
            }
        );
        return false;
    });
    /*END: ajax publish*/
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\khangdien\resources\views/website/index.blade.php ENDPATH**/ ?>