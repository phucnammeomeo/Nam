<?php

$mainMenu = getMenus('menu-header');

?>

<div class="top-content border-b border-gray-300 bg-white">

    <div class="container mx-auto px-3">

        <div class="flex flex-wrap justify-between mx-[-5px]">

            <div class="w-1/5 px-[5px]">

                <h3 class="text-f15  py-[10px] px-[15px] h-full cursor-pointer open-menu-category" style="border-radius: 5px 5px 0 0 ">

                    <i class="fa-solid fa-bars mr-[8px]"></i>Danh mục sản phẩm

                </h3>

            </div>

            <div class="w-4/5 px-[5px]">

                <div class="main-menu-pr hidden lg:block">

                    <div class="main-menu">

                        <?php if( $mainMenu ): ?>

                        <ul class="flex lg:flex-grow md:space-x-0 lg:space-x-4 flex-wrap">

                            <?php $__currentLoopData = $mainMenu->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <li class="group relative">

                                <a href="<?php echo e(url($val->slug)); ?>" class="inline-block px-[5px] lg:px-[6px] py-[10px] text-f15 transition-all hover:text-Pimary_color">

                                    <span class="lg:mt-0 hover:text-blue003">

                                        <?php if( $val->image != '' ): ?>

                                        <span class="mr-[3px]"><img src="<?php echo e($val->image); ?>" alt="<?php echo e($val->title); ?>" style="display: inline-block;width: 20px;height: 20px;object-fit: contain;position: relative;top: -1px"></span>

                                        <?php endif; ?>

                                        <?php echo e($val->title); ?>


                                        <?php if( !$val->children->isEmpty() ): ?>

                                        <span class="text-f11 ml-[5px]"><i class="fa-solid fa-chevron-down"></i></span>

                                        <?php endif; ?>

                                    </span>

                                </a>

                                <?php if( !$val->children->isEmpty() ): ?>

                                <ul class="group-hover:block hidden absolute dropdown left-0 top-full z-30 bg-white submenu shadow">

                                    <?php $__currentLoopData = $val->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyC => $valC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <li>

                                        <a href="<?php echo e(url($valC->slug)); ?>" class="hover:text-white text-f15 inline-block py-[10px] px-[15px] hover:bg-Pimary_color w-full"><?php echo e($valC->title); ?></a>

                                    </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </ul>

                                <?php endif; ?>

                            </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="container mx-auto px-0 md:px-3">

    <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">

        <div class="w-1/5 px-[5px] hidden lg:block">

            <?php if( !isset($showMenu) || ($showMenu != 'hide') ): ?>

            <?php echo $__env->make('homepage.common.menuProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php endif; ?>

        </div>

        <?php if( isset($view) && $view == 'home' ): ?>

        <?php echo $__env->make('homepage.common.slide', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endif; ?>

    </div>

</div>
<?php /**PATH C:\xampp\htdocs\sports\resources\views/homepage/common/menubottom.blade.php ENDPATH**/ ?>