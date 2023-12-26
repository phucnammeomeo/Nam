<?php $menuProduct = getMenus('menu-danh-muc-san-pham'); ?>

<aside class="sidebar menu-product-header <?php echo e((!isset($view) || $view != 'home')?'hidden not-home':''); ?>">

    <div class="item-sb bg-white relative">

        <div class="py-[5px]">

            <?php if( $menuProduct ): ?>

                <?php $__currentLoopData = $menuProduct->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="acc__card border-gray-100">

                        <div class="acc__title text-f15 font-bold">

                            <a href="<?php echo e(url($val->slug)); ?>" class="hover:text-Pimary_color transition-all" style="display: block">

                                <span style="width: 95%;display: inline-block"><?php echo e($val->title); ?></span>

                                <?php if( !$val->children->isEmpty() ): ?>

                                <span class="text-f11 float-right" style="width: 5%;display: inline-block"><i class="fa-solid fa-angles-right"></i></span>

                                <?php endif; ?>

                            </a>

                        </div>

                        <?php if( !$val->children->isEmpty() ): ?>

                        <div class="submenu-category">

                            <div class="flex flex-wrap justify-between mx-[-10px]">

                                <div class="w-1/2 px-[10px]">

                                    <ul>

                                        <?php $__currentLoopData = $val->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyC => $valC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <li class="mb-[5px] font-bold">

                                            <a href="<?php echo e(url($valC->slug)); ?>" class="hover:text-Pimary_color transition-all"><?php echo e($valC->title); ?></a>

                                        </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>

                                </div>

                                <div class="w-1/2 px-[10px]">

                                    <?php if( $val->image != '' ): ?>

                                    <div class="img">

                                        <img src="<?php echo e($val->image); ?>" alt="<?php echo e($val->title); ?>" class="w-full">

                                    </div>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                        <?php endif; ?>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>

        </div>

    </div>

</aside>
<?php /**PATH C:\xampp\htdocs\sportshop\resources\views/homepage/common/menuProduct.blade.php ENDPATH**/ ?>