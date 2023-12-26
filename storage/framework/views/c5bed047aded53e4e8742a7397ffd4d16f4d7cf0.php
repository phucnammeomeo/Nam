<div class="mt-5 space-y-2 scrollbar px-3" style="max-height:600px">
    <?php if(!$products->isEmpty()): ?>
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="border-b pb-2">
        <?php if(count($item->product_versions) > 0): ?>
        <div class="pl-0 lg:space-y-3 text-sm lg:text-base">
            <?php $__currentLoopData = $item->product_versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $title_version = collect(json_decode($val->title_version))->join(' - ', '');
            $price = !empty($val->price_import_version) ? $val->price_import_version : (!empty($item->price_import) ? $item->price_import : 0);
            $image = File::exists(base_path($val->image_version)) ? (!empty($val->image_version) ? asset($val->image_version) : (File::exists(base_path($item->image)) ? (!empty($item->image) ? asset($item->image) : asset('images/404.png')) : asset('images/404.png'))) : asset('images/404.png');
            $array = array(
                'id' => $item->id,
                'id_version' => $val->id_version,
                'title_version' => $val->title_version,
                'type' => 'variable',
                'price' =>  $price,
                'image' =>  $image,
                'unit' =>  $item->unit,
            );
            ?>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="checkboxItem" value="<?php echo e(json_encode($array)); ?>">
                <div class="js_handleSelectModalProduct flex-1 text-sm lg:text-base grid space-x-2 lg:space-x-0 grid-cols-3 lg:grid-cols-12 items-center cursor-pointer ">
                    <div class="lg:col-span-1 flex items-center space-x-1">
                        <img alt="<?php echo e($item->title); ?>" style="height:50px;width: 50px;object-fit: cover;" class="object-cover border" src="<?php echo e($image); ?>">
                    </div>
                    <div class="lg:col-span-6">
                        <span class="font-semibold"><?php echo e($item->title); ?></span><br>(<?php echo e($title_version); ?>)
                    </div>
                    <div class="lg:col-span-5 text-right">
                        <span class="text-danger font-semibold"><?php echo e(number_format($price,'0',',','.')); ?> đ</span><br>
                        <b>Số lượng:</b> <?php echo e($val->_stock); ?>

                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <?php
        $array = array(
            'id' => $item->id,
            'type' => 'simple',
            'price' =>  $item->price_import,
            'image' => asset($item->image),
            'unit' =>  $item->unit,
        );
        ?>
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="checkboxItem" value="<?php echo e(json_encode($array)); ?>">
            <div class="js_handleSelectModalProduct flex-1 text-sm lg:text-base grid space-x-2 lg:space-x-0 grid-cols-3 lg:grid-cols-12 items-center cursor-pointer ">
                <div class="lg:col-span-1 flex items-center space-x-1">
                    <img alt="<?php echo e($item->title); ?>" style="height:50px;width: 50px;object-fit: cover;" class="object-cover border" src="<?php echo e(File::exists(base_path($item->image)) ? (!empty($item->image)?asset($item->image): asset('images/404.png')) : asset('images/404.png')); ?>">
                </div>
                <div class="lg:col-span-6 font-semibold">
                    <?php echo e($item->title); ?>

                </div>
                <div class="lg:col-span-5 text-right">
                    <span class="text-danger font-semibold"><?php echo e(number_format($item->price_import,'0',',','.')); ?> đ</span><br>
                    <b>Số lượng: </b><?php echo e($item->inventoryQuantity); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center paginationModalProducts">
    <?php echo e($products->links()); ?>

</div><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/product/backend/purchases/create/ajaxProductModal.blade.php ENDPATH**/ ?>