<?php if (!empty(Auth::user())) { ?>
    <div class="w-full bg-black text-center z-50 button-clear-cache">
        <a href="<?php echo e(route('homepage.clearCache')); ?>" class=" font-bold py-2 px-4 rounded neonShadow flex justify-center items-center">Xóa cache</a>
    </div>
<?php } ?>
<?php /**PATH /home/vuong/domains/vuong.tamphat.edu.vn/public_html/resources/views/homepage/common/cache.blade.php ENDPATH**/ ?>