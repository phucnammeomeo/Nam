<div class="section-001 section-009">
    <div class="container">
        <div class="furgan-newsletter style-01">
            <div class="newsletter-inner">
                <div class="newsletter-info">
                    <div class="newsletter-wrap">
                        <h3 class="title"><?php echo e($fcSystem['title_6']); ?></h3>
                        <h4 class="subtitle"><?php echo e($fcSystem['title_7']); ?></h4>
                        <p class="desc"><?php echo e($fcSystem['title_8']); ?></p>
                    </div>
                </div>
                <div class="newsletter_form">
                    <div class="alert alert-danger print-error-msg" style="display: none">
                        <span></span>

                    </div>
                    <div class="alert alert-success print-success-msg" style="display: none">
                        <span></span>

                    </div>
                </div>
                <div class="newsletter-form-wrap">
                    <div class="newsletter-form-inner">
                        <form class="form-subscribe" method="">
                            <?php echo csrf_field(); ?>
                            <input class="email email-newsletter" name="email" placeholder="Email ..." type="email" required>
                            <button type="submit" class="button btn-submit submit-newsletter">
                                <span class="text">Đăng kí</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION NEWSLATTER -->
<?php $__env->startPush('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".form-subscribe .btn-submit").click(function(e) {
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
<?php $__env->stopPush(); ?><?php /**PATH /home/globalmat/domains/globalmat.vn/public_html/resources/views/homepage/common/subscribers.blade.php ENDPATH**/ ?>