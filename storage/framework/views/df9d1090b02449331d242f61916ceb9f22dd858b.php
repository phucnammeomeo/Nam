<div id="main" class="sitemap">
    <div class="main-content">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-5px]">
                <?php echo $__env->make('homepage.common.menuProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="w-full lg:w-4/5 px-[5px]">
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

<?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/homepage/common/bodyMain.blade.php ENDPATH**/ ?>