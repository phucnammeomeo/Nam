<?php if( $breadcrumb ): ?>

    <div class="breadcrumb mb-[30px]">

        <ul class="flex flex-wrap">

            <li class="pr-[5px]">

                <a href="<?php echo e(url('/')); ?>">Trang chủ</a>

            </li>

            <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <li><span class="per">/</span> <a href="<?php echo e(route('routerURL', ['slug' => $val->slug])); ?>"><?php echo e($val->title); ?></a></li>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>

    </div>

<?php else: ?>

    <div class="breadcrumb  mb-[30px]">

        <ul class="flex flex-wrap">

            <li class="pr-[5px]">

                <a href="<?php echo e(url('/')); ?>">Trang chủ</a>

            </li>

            <li><span class="per">/</span> <?php echo e($title); ?></li>

        </ul>

    </div>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\sportshop\resources\views/homepage/common/breadcrumb.blade.php ENDPATH**/ ?>