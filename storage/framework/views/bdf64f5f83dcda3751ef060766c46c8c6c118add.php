<?php
$menu_danhmuc = getMenus('menu-danh-muc-san-pham');
?>

<div class="w-1/5 px-[5px] hidden lg:block">
    <aside class="sidebar mt-[-37px] scrollbar" id="style-1">
        <div class="force-overflow">
            <h3 class="text-f15 uppercase bg-gray-100 py-[8px] px-[15px]" style="border-radius: 5px 5px 0 0">
                <i class="fa-solid fa-bars mr-[8px]"></i>Danh mục sản phẩm
            </h3>
            <div class="item-sb bg-white body-sidebar">
                <div class="py-[10px]">
                    <?php if(count($menu_danhmuc->menu_items) > 0): ?>
                        <?php $__currentLoopData = $menu_danhmuc->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="acc__card border-gray-100">

                                <?php if(count($item->children) > 0): ?>
                                
                                <div class="acc__title text-f15 font-bold" style="position: relative">
                                    <a href="<?php echo e(url($item->slug)); ?>"><span><?php echo e($item->title); ?></span></a>
                                    <i class="fa-solid fa-chevron-down" style="position: absolute; right: 10px; top: 15px; font-size:9px"></i>
                                </div>
                                <?php else: ?>
                                <div class="acc__title text-f15 font-bold" style="position: relative">
                                    <a href="<?php echo e(url($item->slug)); ?>"><span><?php echo e($item->title); ?></span></a>
                                </div>

                                <?php endif; ?>


                                
                                <div class="acc__panel pl-[20px]">
                                    <?php if(count($item->children) > 0): ?>
                                        <ul>
                                            <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                                <li class="mb-[5px]">
                                                    <a href="<?php echo e(url($item2->slug)); ?>"
                                                        class="hover:text-Pimary_color transition-all"
                                                        <?php echo $_blank_2; ?>>
                                                        <?php echo e($item2->title); ?>

                                                    </a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </aside>
</div>

<?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/menuProduct.blade.php ENDPATH**/ ?>