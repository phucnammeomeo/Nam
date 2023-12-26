   <div class=" overflow-auto lg:overflow-visible">
       <table class="table table-report -mt-2">
           <thead>
               <tr>
                   <th style="width:40px;text-align: center;">
                       <input type="checkbox" id="checkbox-all">
                   </th>
                   <th class="whitespace-nowrap">STT</th>
                   <th class="whitespace-nowrap">Mã phiếu</th>
                   <th class="whitespace-nowrap">Loại phiếu</th>
                   <th class="whitespace-nowrap">Trạng thái</th>
                   <th class="whitespace-nowrap">Số tiền chi</th>
                   <th class="whitespace-nowrap">Nhóm người nhận</th>
                   <th class="whitespace-nowrap">Chứng từ gốc</th>
                   <th class="whitespace-nowrap text-left">Tên người nhận</th>
                   <th class="whitespace-nowrap text-left">Ngày tạo</th>
                   <th class="whitespace-nowrap text-center">#</th>
               </tr>
           </thead>
           <tbody id="table_data" role="alert" aria-live="polite" aria-relevant="all">
               <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php
                $checked = 0;
                if ($v->group_id == 11) {
                    $checked = 1;
                }
                if ($v->module == 'product_purchases') {
                    $checked = 1;
                }
                if ($v->status == 'cancelled') {
                    $checked = 1;
                }
                ?>
               <tr class="odd " id="post-<?php echo $v->id; ?>">
                   <td>
                       <input type="checkbox" name="checkbox[]" value="<?php echo $v->id; ?>" class="checkbox-item" data-check="<?php echo e($checked); ?>">
                   </td>
                   <td>
                       <?php echo e($data->firstItem()+$loop->index); ?>

                   </td>
                   <td>
                       <a class="text-primary font-medium" href="<?php echo e(route('payment_vouchers.edit',['id'=>$v->id])); ?>">
                           <?php echo e($v->code); ?>

                       </a>
                   </td>
                   <td>
                       <?php echo e(!empty($v->payment_groups) ? $v->payment_groups->title:''); ?>

                   </td>
                   <td>
                       <span class="<?php echo e($status['class'][$v->status]); ?>">
                           <?php echo e($status['method'][$v->status]); ?>

                       </span>
                   </td>
                   <td>
                       <?php echo e(number_format($v->price,'0',',','.')); ?>đ
                   </td>
                   <td class="w-40">
                       <?php echo e(!empty($table[$v->module])?$table[$v->module]:''); ?>

                   </td>
                   <td>
                       <?php if($v->module == 'product_purchases'): ?>
                       <a href="" class="font-bold text-danger"><?php echo e(!empty($v->product_purchases) ? $v->product_purchases->code:''); ?></a>
                       <?php endif; ?>
                   </td>

                   <td>
                       <?php if($v->module == 'users'): ?>
                       <?php echo e(!empty($v->users) ? $v->users->name:''); ?>

                       <?php elseif($v->module == 'customers'): ?>
                       <?php echo e(!empty($v->customers) ? $v->customers->name:''); ?>

                       <?php elseif($v->module == 'product_purchases'): ?>
                       <?php echo e(!empty($v->product_purchases->suppliers) ? $v->product_purchases->suppliers->title:''); ?>

                       <?php endif; ?>
                   </td>
                   <td>
                       <?php echo e($v->created_at); ?>

                   </td>
                   <td class="table-report__action w-56 ">
                       <div class="flex justify-center items-center">
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment_vouchers_edit')): ?>
                           <a class="flex items-center mr-3" href="<?php echo e(route('payment_vouchers.edit',['id'=>$v->id])); ?>">
                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1">
                                   <polyline points="9 11 12 14 22 4"></polyline>
                                   <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                               </svg> Edit
                           </a>
                           <?php endif; ?>
                       </div>
                   </td>
               </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </tbody>
       </table>
   </div>
   <!-- END: Data List -->
   <!-- BEGIN: Pagination -->
   <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
       <?php echo e($data->links()); ?>

   </div>
   <!-- END: Pagination --><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/cashbook/payment/payment/data.blade.php ENDPATH**/ ?>