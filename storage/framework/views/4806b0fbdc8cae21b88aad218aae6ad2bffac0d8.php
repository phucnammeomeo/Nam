<?php
    $menu_header = getMenus('menu-header');
?>
<div class="main-menu-pr bg-white hidden lg:block">
    <div class="main-menu">
        <ul class="flex lg:flex-grow md:space-x-0 lg:space-x-4 flex-wrap">
            <?php if(count($menu_header->menu_items) > 0): ?>
                <?php $__currentLoopData = $menu_header->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="group relative">
                        <a href="<?php echo e(url($item->slug)); ?>"
                            class="inline-block px-[5px] lg:px-[8px] py-[10px] text-f15 transition-all hover:text-Pimary_color uppercase">
                            <span class="lg:mt-0 hover:text-blue003">
                                <?php echo e($item->title); ?>


                            </span>
                        </a>
                        <?php if(count($item->children) > 0): ?>
                        <span class="text-f11 ml-[5px]"><i class="fa-solid fa-chevron-down"></i></span>
                            <ul
                                class="group-hover:block hidden absolute dropdown left-0 top-full z-30 bg-white submenu shadow">
                                <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                    <li >
                                        <a href="<?php echo e(url($item2->slug)); ?>"
                                            class="hover:text-white text-f15 inline-block py-[10px] px-[15px] hover:bg-Pimary_color w-full"
                                            style="text-transform: uppercase"
                                            <?php echo $_blank_2; ?>><?php echo e($item2->title); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>
</div>


<?php /**PATH C:\xampp\htdocs\khangdien\resources\views/homepage/common/navbar.blade.php ENDPATH**/ ?>