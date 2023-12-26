<?php $__env->startSection('content'); ?>
    

<div class="container mx-auto px-3">

    <div class="content-right">

        <div class="content-new-detail bg-white p-[10px]">

            <?php echo $__env->make('homepage.common.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $detail->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <h1 class="text-f20 font-bold">
                <?php echo e($detail->title); ?>

            </h1>

            <p class="date text-gray-600 my-[10px]">
                Ngày đăng: <?php echo e(date('d/m/Y', strtotime($detail['created_at']))); ?>

            </p>

            <div class="content-content">
                <?php echo $detail->content; ?>

            </div>

        </div>

        <?php if( $sameArticle ): ?>

        <div class="other-new pt-[30px] bg-white p-[10px] mt-[20px]">

            <div class="title-title  text-f18 pl-[20px] uppercase">

                <a href="javacript:void(0)" class=" font-bold">Bài viết liên quan</a>

            </div>

            <div class="slider-new owl-carousel mt-[20px]">

                <?php $__currentLoopData = $sameArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="item border rounded-[6px] overflow-hidden p-[10px]" style="border: 2px solid transparent;box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px;">

                    <div class="img hover-zoom">

                        <a href="<?php echo e(route('routerURL', ['slug' => $item->slug])); ?>">

                            <img src=" <?php echo e(asset($item->image != '')?$item->image:'images/404.png'); ?>" alt="<?php echo e($item->title); ?>" class="w-full object-cover">

                        </a>

                    </div>

                    <div class="mt-[15px]">

                        <h3 class="text-f17 overflow-hidden" style="text-overflow: ellipsis;line-height: 20px;-webkit-line-clamp: 2;height: 40px;display: -webkit-box;-webkit-box-orient: vertical;">

                            <a href="<?php echo e(route('routerURL', ['slug' => $item->slug])); ?>" class="hover:text-Pimary_color transition-all"> <?php echo e($item->title); ?> </a>

                        </h3>

                        <p class="date text-gray-600 mt-[5px] text-f13"><?php echo e($item['created_at']); ?></p>

                    </div>

                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

        <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien3/domains/khangdien.tamphat.edu.vn/public_html/resources/views/article/frontend/article/index.blade.php ENDPATH**/ ?>