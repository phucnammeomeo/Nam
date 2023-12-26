 <div class="flex flex-col space-y-3 p-2">
     <?php if(count($suppliers) > 0): ?>
     <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <a class="item flex items-center hover:text-danger js_handle_suppliers" href="javascript:void(0)" data-id="<?php echo e($item->id); ?>" data-info="<?php echo base64_encode(json_encode($item)); ?>">
         <div class="w-10 h-10 rounded-full">
             <img src="https://ui-avatars.com/api/?name=<?php echo e($item->title); ?>" class="rounded-full w-full">
         </div>
         <span class="flex ml-2">
             <?php echo e($item->title); ?> - <?php echo e($item->phone); ?>

         </span>
     </a>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php endif; ?>
 </div>
 <div class="paginationSuppliers flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center py-2 border-t ">
     <?php echo e($suppliers->links()); ?>

 </div><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/product/backend/purchases/suppliers.blade.php ENDPATH**/ ?>