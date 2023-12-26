<?php $__currentLoopData = $comment_view['listComment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $listImageCmt = json_decode($v->images, TRUE); ?>
<!--START: item comment-->
<div class="grid grid-cols-12 border-t py-5">
    <div class="col-span-12 md:col-span-4">
        <div class="flex">
            <span class="review_avatar">
                <img src="https://ui-avatars.com/api/?name=<?php echo e($v->fullname); ?>" class="rounded-full">
            </span>
            <div>
                <div><?php echo e($v->fullname); ?></div>
                <div><?php echo e($v->created_at); ?></div>
                <div class="text-xs">
                    <span>Đánh giá vào
                        <?php if($v->created_at): ?>
                        <?php echo e(Carbon\Carbon::parse($v->created_at)->diffForHumans()); ?>

                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 md:col-span-8 mt-5 md:mt-0 ml-5">
        <div class="flex items-center mb-1">
            <div class="flex">
                <?php for ($i = 1; $i <= $v->rating; $i++) { ?>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <path d="M10 2.5L12.1832 7.34711L17.5 7.91118L13.5325 11.4709L14.6353 16.6667L10 14.0196L5.36474 16.6667L6.4675 11.4709L2.5 7.91118L7.81679 7.34711L10 2.5Z" stroke="#FFD52E" fill="#FFD52E"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99996 1.66675L12.4257 7.09013L18.3333 7.72127L13.925 11.7042L15.1502 17.5177L9.99996 14.5559L4.84968 17.5177L6.07496 11.7042L1.66663 7.72127L7.57418 7.09013L9.99996 1.66675ZM9.99996 3.57863L8.10348 7.81865L3.48494 8.31207L6.93138 11.426L5.97345 15.9709L9.99996 13.6554L14.0265 15.9709L13.0685 11.426L16.515 8.31207L11.8964 7.81865L9.99996 3.57863Z" fill="#FFD52E"></path>
                        </svg>
                    </span>
                <?php } ?>
                <?php for ($i = 1; $i <= 5 - $v->rating; $i++) { ?>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <path d="M10 2.5L12.1832 7.34711L17.5 7.91118L13.5325 11.4709L14.6353 16.6667L10 14.0196L5.36474 16.6667L6.4675 11.4709L2.5 7.91118L7.81679 7.34711L10 2.5Z" stroke="#dddddd" fill="#dddddd"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99996 1.66675L12.4257 7.09013L18.3333 7.72127L13.925 11.7042L15.1502 17.5177L9.99996 14.5559L4.84968 17.5177L6.07496 11.7042L1.66663 7.72127L7.57418 7.09013L9.99996 1.66675ZM9.99996 3.57863L8.10348 7.81865L3.48494 8.31207L6.93138 11.426L5.97345 15.9709L9.99996 13.6554L14.0265 15.9709L13.0685 11.426L16.515 8.31207L11.8964 7.81865L9.99996 3.57863Z" fill="#dddddd"></path>
                        </svg>
                    </span>
                <?php } ?>
            </div>
            <div class="ml-4 font-medium">
                <?php echo e(config('comment')['rating'][$v->rating]); ?>

            </div>

        </div>
        <?php /*<div class="flex items-center mb-1">
            <div class="review-seller">
                <span class="review-check-icon">
                </span>Đã mua hàng
            </div>
        </div>*/ ?>
        <div class=" mb-1">
            <?php echo e($v->message); ?>

        </div>
        <?php if(!empty($listImageCmt)): ?>
        <div class="flex flex-wrap ">
            <?php $__currentLoopData = $listImageCmt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="review-comment__image mb-2 mr-2 border border-slate-50" style="background-image: url(<?php echo e($image); ?>);">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
        <div>
            <a href="javascript:void(0)" class="js_btn_reply font-medium text-white bg-red-600 flex-1 cursor-pointer items-center inline-flex rounded-md px-6 justify-center" data-id="<?php echo e($v->id); ?>" data-name="<?php echo e($v->fullname); ?>" data-comment="1">Bình luận</a>
            <div class="reply-comment">
            </div>
            <?php if($v->child): ?>
            <!-- START: sub comment -->
            <div class="review-comment__sub-comments">
                <?php $__currentLoopData = $v->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kc=>$vc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="review-sub-comment">
                    <div class="review-sub-comment-avatar">
                        <img src="https://ui-avatars.com/api/?name=<?php echo e($vc->fullname); ?>" alt="" class="rounded-full">
                    </div>
                    <div class="review-sub-comment-inner">
                        <div class="flex items-center mb-2">
                            <div class="font-medium text-sm"><?php echo e($vc->fullname); ?>

                            </div>
                            <?php if($vc->type == "QTV"): ?>
                            <div class="review-sub-comment-date">
                                <span class="text-d61c1f font-bold">QTV</span>
                            </div>
                            <?php endif; ?>
                            <div class="review-sub-comment-date">
                                <?php if($vc->created_at): ?>
                                <?php echo e(Carbon\Carbon::parse($vc->created_at)->diffForHumans()); ?>

                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="review-sub-comment-content "><?php echo e($vc->message); ?></div>
                        <?php $listImageCmtChild = json_decode($vc->images, TRUE); ?>
                        <?php if(!empty($listImageCmtChild)): ?>
                        <div class="flex flex-wrap mt-2">
                            <?php $__currentLoopData = $listImageCmtChild; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageC): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="review-comment__image mb-2 mr-2 border border-slate-50" style="background-image: url(<?php echo e($imageC); ?>);">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- END: sub comment -->
            <?php endif; ?>
        </div>
    </div>
</div>
<!--END: item comment-->
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<div class="dataTables_paginate paging_bootstrap pull-right paginate_cmt">
    <?php echo e($comment_view['listComment']->links()); ?>

</div><?php /**PATH D:\xampp\htdocs\food.local\resources\views/product/frontend/product/comment/data.blade.php ENDPATH**/ ?>