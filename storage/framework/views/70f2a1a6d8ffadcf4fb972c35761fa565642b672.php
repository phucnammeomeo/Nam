<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-3">
        <div class="content-product mt-[30px] bg-white">
            <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
                <a href="javascript:void(0)" class="text-white font-bold">KẾT QUẢ TÌM KIẾM</a>
            </div>
            <div class="p-[10px]">
                <?php if(!empty($data)): ?>
                    <div class="flex flex-wrap mx-[-10px] justify-center">
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="w-1/2 md:w-1/4">
                                <?php echo htmlItemProduct($item, checkProductIncart($item->id, $cart['cart'])); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="pagenavi wow fadeInUp mt-[20px] pb-[20px]">
                
                <?php echo $data->links() ?>
            </div>

        </div>
    </div>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sports\resources\views/product/frontend/search/index.blade.php ENDPATH**/ ?>