 <nav id="primary-nav" class="dropdown cf mobile" style="display: none">
     <ul class="dropdown menu">
         <?php if($menu_header): ?>
         <?php if(count($menu_header->menu_items) > 0): ?>
         <?php $__currentLoopData = $menu_header->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

         <li class="">
             <a class="" href="<?php echo e(!empty($item->children->count() > 0)?'javascript:void(0)':url($item->slug)); ?>">
                 <?php echo e($item->title); ?>

                 <?php if($item->children->count() > 0): ?>
                 <span class="downarrow"></span>
                 <?php endif; ?>

             </a>
             <?php if($item->children->count() > 0): ?>
             <ul class="sub-menu">
                 <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <li class="">
                     <a class="" href="<?php echo e(url($item2->slug)); ?>">
                         <?php echo e($item2->title); ?>

                     </a>
                 </li>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </ul>
             <?php endif; ?>
         </li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         <?php endif; ?>
         <?php endif; ?>
     </ul>
 </nav><?php /**PATH D:\xampp\htdocs\food.local\resources\views/homepage/common/menuMobile.blade.php ENDPATH**/ ?>