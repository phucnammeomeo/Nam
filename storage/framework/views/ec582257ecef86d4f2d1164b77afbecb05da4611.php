<div id="main" class="sitemap">
    <div class="main-content">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-5px]">
                <?php echo $__env->make('homepage.common.menuProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="w-full px-[5px]">
                    <div class="content-right">

                        <?php echo $__env->make('homepage.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('homepage.common.slide', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->yieldContent('content'); ?>

                        <?php echo $__env->make('homepage.common.menuFooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('homepage.common.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /home/khangdien3/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/bodyMain.blade.php ENDPATH**/ ?>