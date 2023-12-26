<?php $__env->startSection('content'); ?>
<div class="content-product mt-[30px] bg-white">
    <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
      <a href="" class="text-white font-bold">SẢN PHẨM</a>
    </div>

    <div class="p-[10px]">
        <?php if($data): ?>
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
         
        <?php echo $data->links() ?>
    </div>
  </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/page/frontend/products.blade.php ENDPATH**/ ?>