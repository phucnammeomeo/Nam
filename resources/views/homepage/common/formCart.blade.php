<section class="pb-md-0 background_bg overlay_bg_dark_80" data-img-src="{{asset($fcSystem['banner_3'])}}" id="formCart">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7">
                <div class="book_table overlay_bg_50 radius_all_10 ">
                    <div class="heading_s1 heading_light text-center">
                        <h2>Đặt bàn</h2>
                    </div>
                    <form method="post" class="form_transparent form_style1" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger print-error-msg" style="display: none">
                                    <span>
                                    </span>
                                </div>
                                <div class="alert alert-success print-success-msg" style="display: none">
                                    <span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row text_white">
                            <div class="form-group col-sm-6">
                                <div class="input_group">
                                    <input required="required" placeholder="Họ và tên" class="form-control" name="fullname" type="text">
                                    <div class="input_icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="input_group">
                                    <input required="required" placeholder="Email" class="form-control" name="email" type="email">
                                    <div class="input_icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="input_group">
                                    <input required="required" placeholder="Số điện thoại" class="form-control" name="phone" type="tel">
                                    <div class="input_icon">
                                        <i class="fa fa-mobile-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="custom_select">
                                    <select class="form-control" name="person">
                                        <option value="0">Số người</option>
                                        @for( $i=1; $i<=20 ; $i++) <option value="{{$i}}">{{$i}} người</option>
                                            @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="input_group">
                                    <input placeholder="Ngày" class="form-control datepicker" name="date" type="text">
                                    <div class="input_icon">
                                        <i class="far fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="input_group">
                                    <input placeholder="Giờ" class="form-control timepicker" data-theme="red" name="hour" type="text" value="{{date('H:s:i')}}">
                                    <div class="input_icon">
                                        <i class="far fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" title="Submit Your Message!" class="btn btn-white btn-radius btn-submit" name="submit" value="Submit">Đặt bàn</button>
                            </div>
                        </div>
                    </form>
                    <div class="opening_time text_white">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="heading_s1 pb-3 m-sm-0 text-center text-sm-left heading_light">
                                    <h5 style="font-size: 18px;">Thời gian mở cửa</h5>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="time_info">
                                    <h6>{{$fcSystem['title_3']}}</h6>
                                    <span>{{$fcSystem['title_4']}}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="time_info">
                                    <h6>{{$fcSystem['title_5']}}</h6>
                                    <span>{{$fcSystem['title_6']}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="large_divider d-none d-md-block"></div>
            </div>
            <div class="col-xl-6 col-lg-5">
                <div class="text-center chef_img animation" data-animation="fadeInRight" data-animation-delay="0.03s">
                    <img src="{{asset($fcSystem['banner_4'])}}" alt="chef_img" />
                </div>
            </div>
        </div>
    </div>
</section>
@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $(".form_transparent .btn-submit").click(function(e) {
            $('.lds-show').show();
            e.preventDefault();
            $.ajax({
                url: "<?php echo route('contactFrontend.bookTable') ?>",
                type: 'POST',
                data: {
                    _token: $(".form_transparent input[name='_token']").val(),
                    fullname: $(".form_transparent input[name='fullname']").val(),
                    email: $(".form_transparent input[name='email']").val(),
                    phone: $(".form_transparent input[name='phone']").val(),
                    person: $(".form_transparent select[name='person']").val(),
                    date: $(".form_transparent input[name='date']").val(),
                    hour: $(".form_transparent input[name='hour']").val(),
                },
                success: function(data) {
                    $('.lds-show').hide();
                    if (data.status == 200) {
                        $(".form_transparent .print-error-msg").css('display', 'none');
                        $(".form_transparent .print-success-msg").css('display', 'block');
                        $(".form_transparent .print-success-msg span").html(
                            "<?php echo $fcSystem['message_3'] ?>");
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        $(".form_transparent .print-error-msg").css('display', 'block');
                        $(".form_transparent .print-success-msg").css('display', 'none');
                        $(".form_transparent .print-error-msg span").html(data.error);
                    }
                }
            });
        });
    });
</script>
<!-- loading -->
<style>
    .lds-ring {
        width: 80px;
        height: 80px;
        position: fixed;
        z-index: 9999;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid #000;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: #e8272e transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .lds-show {
        width: 100%;
        height: 100vh;
        float: left;
        position: fixed;
        z-index: 999999999999999999999;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #0000004f;
    }
</style>
<div class="lds-show" style="display: none">
    <div class="lds-ring ">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
@endpush