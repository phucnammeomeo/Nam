
<?php $__env->startSection('title'); ?>
<title>Chi tiết yêu cầu gia công</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<?php
$array = array(
    [
        "title" => "Danh sách yêu cầu gia công",
        "src" => route('machining.index'),
    ],
    [
        "title" => "Chi tiết",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
$data = json_decode($detail->machining, TRUE);
$title = [
    'chatlieu' => 'Chất liệu',
    'solop' => 'Số lớp',
    'kichthuoc' => 'Kích thước',
    'soluong' => 'Số lượng',
    'loaimachkhac' => 'Loại mạch khác	',
    'pcb' => 'Ghép PCB',
    'doday' => 'Độ dày',
    'colorboard' => 'Màu board',
    'mauchu' => 'Màu chữ',
    'kieuma' => 'Kiểu mạ',
    'dodaydong' => 'Độ dày đồng',
    'thoigian' => 'Thời gian',
    'hanlinhkien' => 'Hàn linh kiện',
    'stencil' => 'Đặt stencil',
]
?>
<div class="content">

    <div class="box mt-5">

        <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
            <div>
                <div class="text-base text-slate-500">From</div>
                <div class="text-lg font-medium text-primary mt-2"><?php echo e($detail->fullname); ?></div>
                <div class="mt-1"><?php echo e($detail->phone); ?></div>
                <div class="mt-1"><?php echo e($detail->address); ?></div>
                <div class="mt-1"><?php echo e($detail->email); ?></div>
                <div class="mt-1">Ghi chú: <?php echo e($detail->message); ?></div>
            </div>
            <?php if(File::exists(base_path($detail->file))): ?>
            <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                <div class="text-base text-slate-500">File Upload</div>
                <div class="text-lg font-medium text-primary mt-2">
                    <a href="<?php echo e(asset($detail->file)); ?>">Tải file</a>
                </div>
            </div>
            <?php endif; ?>

        </div>
        <div class="px-5 sm:px-16 pb-10 sm:pb-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">Tiêu đề</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">Nội dung</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data)): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="border-b dark:border-darkmode-400">
                                <div class="font-medium whitespace-nowrap"><?php echo e($title[$key]); ?></div>
                            </td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">
                                <?php if($key == 'kichthuoc'): ?>
                                <?php echo collect(json_decode($item, TRUE))->join('x', ' ') ?>
                                <?php else: ?>
                                <?php echo e($item); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard.layout.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/contact/backend/machiningEdit.blade.php ENDPATH**/ ?>