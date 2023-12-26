<?php
$menu_footer = getMenus('menu-footer');
?>

<footer class="footer bg-white mt-0 md:mt-[30px]">
    <div class="top-footer p-[10px] border-b border-gray-100">

        <div class="flex flex-wrap justify-between mx-[-10px] items-center logo-footer-1">
            <div class="w-full md:w-1/2 px-[10px] mb-[10px] md:mb-0 ">
                <p class="flex flex-wrap">
                    <span class=""><img src="<?php echo e(asset($fcSystem['homepage_logo_footer_1'])); ?>" alt="Logo" />
                    </span>
                    <span class="pl-[10px]"><?php echo e($fcSystem['title_9']); ?> <strong><?php echo e($fcSystem['title_10']); ?></strong>
                        <br />
                        <?php echo e($fcSystem['title_11']); ?></span>
                </p>
            </div>
            <div class="w-full md:w-1/2 px-[10px]">
                <p class="flex flex-wrap">
                    <span class=""><img src="<?php echo e(asset($fcSystem['homepage_logo_footer_2'])); ?>" alt="Logo" />
                    </span>
                    <span class="pl-[10px]"><?php echo e($fcSystem['title_12']); ?> <strong><?php echo e($fcSystem['title_13']); ?></strong>
                        <br />
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="content-footer p-[10px]">
        <div class="flex flex-wrap justify-between mx-[-10px] mb-\[7px\]">
            <div class="w-full md:w-1/2 px-[10px]">
                <h3 class="text-f16 font-bold uppercase mb-[7px]">
                    <?php echo e($fcSystem['title_5']); ?>

                </h3>
                <div class="flex flex-wrap  mt-[10px]">
                    <?php if(count($menu_footer->menu_items) > 0): ?>
                        <?php $__currentLoopData = $menu_footer->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($item->children) > 0): ?>
                                <div class="w-1/2 md:w-1/3 px-[5px]">
                                    <ul>
                                        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                            <li class="text-f15 text-gray-700 mb-[7px]">
                                                <a href="<?php echo e(url($item2->slug)); ?>"
                                                    <?php echo $_blank_2; ?>><?php echo e($item2->title); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                    <div class="w-1/2 md:w-1/3 px-[5px]">
                                        <ul>

                                                <?php $_blank_2 = !empty($item->target === '_blank') ? 'target="_blank"' : ''; ?>
                                                <li class="text-f15 text-gray-700 mb-[7px]">
                                                    <a href="<?php echo e(url($item->slug)); ?>"
                                                        <?php echo $_blank_2; ?>><?php echo e($item->title); ?></a>
                                                </li>

                                        </ul>
                                    </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <h3 class="text-f16 font-bold uppercase mb-[7px] mt-[10px]">
                    <?php echo e($fcSystem['title_14']); ?>

                </h3>
                
            </div>
            <div class="w-full md:w-1/2 px-[10px] mt-[10px] md:mt-0">
                <h3 class="text-f16 font-bold uppercase mb-[7px]">
                    <?php echo e($fcSystem['title_6']); ?>

                </h3>

                 
                <p class="mb-[5px]">
                    <i class="fa-solid fa-headphones mr-[5px]"></i><?php echo e($fcSystem['title_8']); ?>

                    <span class="font-bold">
                        <a
                            href="tel:<?php echo e($fcSystem['contact_hotline']); ?>"><?php echo e($fcSystem['contact_hotline']); ?>

                        </a>
                    </span>
                </p>

                <p class="mb-[5px]">
                    <i class="fa-solid fa-phone mr-[5px]"></i><?php echo e($fcSystem['title_15']); ?>

                    <span class="font-bold">
                        <a
                            href="tel:<?php echo e($fcSystem['contact_hotline2']); ?>"><?php echo e($fcSystem['contact_hotline2']); ?>

                        </a>
                    </span>
                </p>

                <p class="mb-[5px]">
                    <i class="fa-solid fa-location-dot mr-[5px]"></i><?php echo e($fcSystem['title_17']); ?>

                    <span class="font-bold">
                        <?php echo e($fcSystem['contact_address']); ?>

                    </span>
                </p>

                <p>
                    <i class="fa-solid fa-mail-bulk mr-[5px]"></i><?php echo e($fcSystem['title_16']); ?>

                    <span class="font-bold">
                        <a
                            href="mailto:<?php echo e($fcSystem['contact_email']); ?>"><?php echo e($fcSystem['contact_email']); ?>

                        </a>
                    </span>
                </p>

                <h4 class="text-f15 font-bold mt-[15px]">
                    <?php echo e($fcSystem['title_7']); ?>

                </h4>
                <?php echo $__env->make('homepage.common.subscribers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\khangdien\resources\views/homepage/common/menuFooter.blade.php ENDPATH**/ ?>