<?php if($paginator->hasPages()): ?>
        <ul class="flex flex-wrap justify-center pagination">
            
            <?php if($paginator->onFirstPage()): ?>
                <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                    <span style="height: 100%" class=" page-link inline-block w-[40px] h-[40px] leading-[40px] text-center mx-[2px] border border-Orangefc5 bg-Pimary_color text-white" aria-hidden="true"><i class="fa-solid fa-angles-left ml-[3px] text-f11"></i></span>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a style="height: 100%" class="page-link inline-block w-[40px] h-[40px] leading-[40px] text-center mx-[2px] border border-Orangefc5 bg-Pimary_color text-white" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>"><i class="fa-solid fa-angles-left ml-[3px] text-f11"></i></a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="page-item disabled" aria-disabled="true"><a class="page-link inline-block w-[40px] h-[40px] leading-[40px] text-center mx-[2px] border border-gray-300"><?php echo e($element); ?></a></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="page-item active bg-Pimary_color text-white" aria-current="page"><a class="page-link inline-block w-[40px] h-[40px] leading-[40px] text-center mx-[2px]  border-Orangefc5"><?php echo e($page); ?></a></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link inline-block w-[40px] h-[40px] leading-[40px] text-center mx-[2px] border border-gray-300" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li class="page-item">
                    <a style="height: 100%" class="page-link inline-block w-[40px] h-[40px] leading-[40px] text-center mx-[2px] border border-gray-300 bg-Pimary_color text-white" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>"><i class="fa-solid fa-angles-right ml-[3px] text-f11"></i></a>
                </li>
            <?php else: ?>
                <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                    <span style="height: 100%" class="page-link inline-block w-[40px] h-[40px] leading-[40px] text-center mx-[2px] border border-gray-300 bg-Pimary_color text-white" aria-hidden="true"><i class="fa-solid fa-angles-right ml-[3px] text-f11"></i></span>
                </li>
            <?php endif; ?>
        </ul>
<?php endif; ?>
<?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/vendor/laravel/framework/src/Illuminate/Pagination/resources/views/bootstrap-4.blade.php ENDPATH**/ ?>