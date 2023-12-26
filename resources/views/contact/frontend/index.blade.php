@extends('homepage.layout.home')
@section('content')

<div class="container mx-auto px-3">
    @include('homepage.common.breadcrumb', ['breadcrumb' => '', 'title' => $page->title])
    <div class="contact-btottom  bg-white p-[10px] mt-[20px]">

        <div class="flex flex-wrap justify-between -mx-3">
            <div class="w-full md:w-1/2 px-3 mt-4 md:mt-0">
                <h3 class="font-bold text-f20 mb-[10px] md:mb-[20px]">
                    Địa chỉ của chúng tôi
                </h3>
                <div class="">
                    <div class="mb-[20px]">
                        <h4 class="text-f15">
              <span
                      class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
              ><i class="fa-solid fa-location-dot"></i></span
              >{{$fcSystem['contact_address']}}
                        </h4>
                    </div>
                    <div class="mb-[20px]">
                        <h4 class="text-f15">
              <span
                      class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
              ><i class="fa-solid fa-phone-volume"></i></span
              >{{$fcSystem['contact_hotline']}}
                        </h4>
                    </div>
                    <div class="mb-[20px]">
                        <h4 class="text-f15">
              <span
                      class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
              ><i class="fa-solid fa-envelope"></i></span
              >{{$fcSystem['contact_email']}}
                        </h4>
                    </div>
                    <div class="mb-[20px]">
                        <h4 class="text-f15">
              <span
                      class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
              ><i class="fa-regular fa-clock"></i></span
              >{{ $fcSystem['contact_tglv'] }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <div class="content-bt" role="form">
                    <h3 class="font-bold text-f20 mb-[10px] md:mb-[20px]">
                        Gửi thắc mắc cho chúng tôi
                    </h3>
                    <form id="form-submit-contact">

                         <p>
                            <div class="alert alert-danger print-error-msg bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-[10px]" style="display:none"><span class=""></span></div>
                            <div class="alert alert-success print-success-msg bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-[10px]" style="display:none"><span class=""></span></div>
                        </p>

                        @csrf

                        <div class="">
                            <div class="mb-[10px]">
                                <input
                                        type="text"
                                        class="w-full h-[40px] border-b border-gray-200 rounded-sm text-f15"
                                        placeholder="Tên của bạn"
                                        name="fullname"

                                />
                            </div>
                            <div class="flex flex-wrap justify-between mx-[-10px]">
                                <div class="w-full md:w-1/2 px-[10px] mb-4 md:mb-0">
                                    <input
                                            type="email"
                                            class="w-full h-[40px] border-b border-gray-200 rounded-sm text-f15"
                                            placeholder="Email của bạn"
                                            name="email"

                                    />
                                </div>
                                <div class="w-full md:w-1/2 px-[10px]">
                                    <input
                                            type="text"
                                            class="w-full h-[40px] border-b border-gray-200 rounded-sm text-f15"
                                            placeholder="SĐT của bạn"
                                            name="phone"

                                    />
                                </div>
                            </div>

                            <div class="mt-[10px]">
                <textarea
                        name="message"
                        id=""
                        cols="30"
                        rows="10"
                        class="w-full h-[100px] border-b border-gray-200 rounded-sm text-f15"
                        placeholder="Nội dung"
                ></textarea>
                                <input
                                        type="submit"
                                        value="Gửi cho chúng tôi"
                                        class="cursor-pointer h-[40px] bg-Pimary_color text-white px-[15px] text-f15 rounded-sm uppercase mt-[10px] border border-yellow hover:bg-white hover:text-Pimary_color transition-all btn-submit-contact"
                                />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="map mt-[20px]">
            <?php echo $fcSystem['contact_map'] ?>
        </div>

    </div>
</div>

@endsection
@push('css')
    <style>
        .breadcrumb {
            margin: 10px 0;
        }
    </style>
@endpush

@push('javascript')
{{--    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $("#form-submit-contact").submit(function (e) {
                console.log(1111);
                e.preventDefault();
                var _token = $("#form-submit-contact input[name='_token']").val();
                var fullname = $("#form-submit-contact input[name='fullname']").val();
                var email = $("#form-submit-contact input[name='email']").val();
                var phone = $("#form-submit-contact input[name='phone']").val();
                var message = $("#form-submit-contact textarea[name='message']").val();
                $.ajax({
                    url: "<?php echo route('contactFrontend.store') ?>",
                    type: 'POST',
                    data: {
                        _token: _token,
                        fullname: fullname,
                        email: email,
                        phone: phone,
                        message: message,
                        type: "contact",
                    },
                    success: function (data) {
                        if (data.status == 500) {
                            $('#form-submit-contact .alert-success span').html('');
                            $('#form-submit-contact .alert-success').hide();

                            $('#form-submit-contact .alert-danger span').html(data.error);
                            $('#form-submit-contact .alert-danger').show();

                        } else {
                            $('#form-submit-contact .alert-danger span').html('');
                            $('#form-submit-contact .alert-danger').hide();

                            $('#form-submit-contact .alert-success span').html("Đăng ký thành công!");
                            $('#form-submit-contact .alert-success').show();
                            setTimeout(function() {
                                location.reload()
                            }, 2000);

                        }
                    }
                });
            });
        });
    </script>
{{--    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>--}}
{{--    <script src="{{asset('library/toastr/toastr.min.js')}}"></script>--}}
@endpush
