<?php $__env->startSection('content'); ?>


    <div class="content-product mt-[30px] bg-white">
        <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
            <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo route('routerURL', ['slug' => $v->slug]); ?>" class="text-white font-bold"><?php echo e($v->title); ?> / </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="p-[10px]">
            <?php if(!empty($data)): ?>
                <div class="flex flex-wrap justify-center">


                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="w-1/2 md:w-1/4">

                            <div class="item border border-gray-100 p-[10px]">
                                <?php echo htmlProduct($key, $item); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="pagenavi wow fadeInUp mt-[20px] pb-[20px]">
            
            <?php echo $data->links(); ?>
        </div>

    </div>


        <?php if(!empty($detail->description)): ?>
        <div class="box-content border border-Pimary_color p-[15px] rounded-[10px] mt-[20px]">

                <div class="status-meeting">
                    Mô tả về: <?php echo e(strip_tags($detail->title)); ?>

                </div>
                <div class="read-more-content">
                    <div class="status-meeting">
                        <?php echo e(strip_tags($detail->description)); ?>

                    </div>
                </div>

                <a href="javascript:void(0);"
                    class="read-more  text-Pimary_color uppercase inline-block w-full text-center mt-[10px]"
                    title="Read More">Xem thêm</a>
            </div>
        <?php else: ?>
        <div class="box-content border border-Pimary_color p-[15px] rounded-[10px] mt-[20px]" style="display: none;">

            

            <a href="javascript:void(0);"
                class="read-more  text-Pimary_color uppercase inline-block w-full text-center mt-[10px]"
                title="Read More">Xem thêm</a>
        </div>
        <?php endif; ?>



<?php $__env->stopSection(); ?>



<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/product/frontend/category/index.blade.php ENDPATH**/ ?>