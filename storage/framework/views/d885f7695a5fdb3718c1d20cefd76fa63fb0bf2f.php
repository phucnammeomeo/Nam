<?php $__env->startSection('content'); ?>



<div class="breadcrumbs"
    <?php if(!empty($detail->image)){?>style="background: url(<?php echo e(asset($detail->image)); ?>) no-repeat center top;"
    <?php }?>>
    <div class="container">
        <h1 style="margin-top:0px" class="title-breadcrumb">
            Tag: <?php echo e($detail->title); ?>

        </h1>
        <ul class="breadcrumb-cate">
            <li><a href="<?php echo e(url('')); ?>">Home</a></li>
            <li><a href="javascript:void(0)">Tag: <?php echo e($detail->title); ?></a></li>
        </ul>
    </div>
</div>
<div class="container product-detail product-detail-tp-custom">
    <div class="row">
        <div id="content" class="col-md-9 col-sm-12 col-xs-12">
            <a href="javascript:void(0)" class="open-sidebar hidden-lg hidden-md"><i class="fa fa-bars"></i>Sidebar</a>
            <div class="products-category">
                <?php if($data): ?>
                <div class="section-style4 products-list grid row number-col-3 so-filter-gird" id="dataTour">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo htmlItemTourCategory($key,$item->tour);?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="product-filter product-filter-bottom filters-panel">
                    <?php echo $data->links();?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- START: filter left -->
        <?php echo $__env->make('tour.frontend.aside', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- END: filter left -->
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/tag/frontend/tour.blade.php ENDPATH**/ ?>