 <?php if(!$configIs->isEmpty()): ?>
 <?php $__currentLoopData = $configIs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <th><?php echo e($item->title); ?></th>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/components/table/is_thead.blade.php ENDPATH**/ ?>