<?php $__env->startPush('javascript'); ?>
<?php if(session('error') || session('success')): ?>
<?php if(session('success')): ?>
<script>
    toastr.success('<?php echo session('success') ?>', 'Thông báo!')
</script>
<?php endif; ?>
<?php if(session('error')): ?>
<script>
    toastr.error('<?php echo session('error') ?>', 'Error!')
</script>
<?php endif; ?>
<?php endif; ?>
<?php $__env->stopPush(); ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/components/alert-success.blade.php ENDPATH**/ ?>