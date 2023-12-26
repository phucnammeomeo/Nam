{{-- <div class="newsletter_form">
    <div class="alert alert-danger print-error-msg" style="display: none">
        <span></span>

    </div>
    <div class="alert alert-success print-success-msg" style="display: none">
        <span></span>

    </div>
</div> --}}
<form action="" class="relative mt-[10px] form-subscribe">
    @csrf
    <input type="email" placeholder="Thông tin của bạn"
        class="w-full h-[40px] border border-gray-200 rounded-[5px] text-f15 bg-gray-50" required name="email"/>
        {{-- <button class="absolute top-[7px] right-[10px] btn-submit" style="color: red;display:block">
            <i class="fa-solid fa-magnifying-glass"></i> Đăng kí
        </button> --}}
</form>

<!-- END SECTION NEWSLATTER -->
@push('javascript')
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
                            if (confirm('Bạn có muốn đăng kí email của bạn với <?php echo (isset($fcSystem[ 'homepage_company'])) ? $fcSystem['homepage_company'] : ''; ?> không ?')) {
                                alert('Đăng kí email thành công');
                                location.reload()
                            } else {
                                alert('Hẹn gặp bạn lần sau !');
                                location.reload()
                            }
                    }
                    //     $(".newsletter_form .print-error-msg").css('display', 'none');
                    //     $(".newsletter_form .print-success-msg").css('display', 'block');
                    //     $(".newsletter_form .print-success-msg span").html(
                    //         "<?php echo $fcSystem['message_1'] ?>");
                    //     setTimeout(function() {
                    //         $(".newsletter_form .print-error-msg").css('display', 'none');
                    //         $(".newsletter_form .print-success-msg").css('display', 'none');
                    //         $(".newsletter_form .print-success-msg span").html('');
                    //     }, 3000);
                    // } else {
                    //     $(".newsletter_form .print-error-msg").css('display', 'block');
                    //     $(".newsletter_form .print-success-msg").css('display', 'none');
                    //     $(".newsletter_form .print-error-msg span").html(data.error);
                    // }
                }
            });
        });
    });
</script>
@endpush
