<div class="newsletter_form">
    <div class="alert alert-danger print-error-msg" style="display: none">
        <span></span>

    </div>
    <div class="alert alert-success print-success-msg" style="display: none">
        <span></span>

    </div>
</div>
<form action="" class="relative mt-[10px] form-subscribe">
    <?php echo csrf_field(); ?>
    <input type="email" placeholder="Thông tin của bạn"
        class="w-full h-[40px] border border-gray-200 rounded-[5px] text-f15 bg-gray-50" required name="email"/>
        
</form>

<!-- END SECTION NEWSLATTER -->
<?php $__env->startPush('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".form-subscribe").submit(function(e) {
            e.preventDefault();
            var _token = $(".form-subscribe input[name='_token']").val();
            var email = $(".form-subscribe input[name='email']").val();
            $.ajax({
                url: "<?php echo route('contactFrontend.subcribers') ?>",
                type: 'POST',
                data: {
                    _token: _token,
                    email: email,
                    type: "email",
                },
                success: function(data) {
                    if (data.status == 200) {
                        $(".newsletter_form .print-error-msg").css('display', 'none');
                        $(".newsletter_form .print-success-msg").css('display', 'block');
                        $(".newsletter_form .print-success-msg span").html(
                            "<?php echo $fcSystem['message_1'] ?>");
                        setTimeout(function() {
                            $(".newsletter_form .print-error-msg").css('display', 'none');
                            $(".newsletter_form .print-success-msg").css('display', 'none');
                            $(".newsletter_form .print-success-msg span").html('');
                        }, 3000);
                    } else {
                        $(".newsletter_form .print-error-msg").css('display', 'block');
                        $(".newsletter_form .print-success-msg").css('display', 'none');
                        $(".newsletter_form .print-error-msg span").html(data.error);
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/subscribers.blade.php ENDPATH**/ ?>