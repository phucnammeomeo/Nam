@extends('homepage.layout.home')
@section('content')
<main class="py-8 bg-white">
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-center">
            <div class="w-[580px] max-w-full bg-[#f4f6f8] p-6 rounded-xl " style="border: solid 1px orange">

                <div class="text-center py-[10px] text-f25 mb-10 font-bold ">
                    <h1 class="text-Pimary_color">ĐĂNG NHẬP ĐỂ THEO DÕI ĐƠN HÀNG CỦA BẠN</h1>
                </div>

                <div class="flex mb-10">
                    <div class="w-1/2 text-center" style="border-right: solid 1px">
                        <a href="{{route('customer.login')}}" class="font-bold uppercase h-[50px] leading-[50px]  float-left w-full" style="text-decoration: revert">{{trans('index.Login')}}</a>
                    </div>
                    <div class="w-1/2 text-center">
                        <a href="{{route('customer.register')}}" class="font-semibold uppercase h-[50px] leading-[50px] float-left w-full " style="text-decoration: revert">{{trans('index.Register')}}</a>
                    </div>
                </div>
                <form action="{{route('customer.login-store')}}" method="POST" id="form-auth">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">
                            {{session('success')}}
                        </span>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">ERROR!</strong>
                        <span class="block sm:inline">
                            @foreach ($errors->all() as $error)
                            {{ $error }}
                            @endforeach
                        </span>
                    </div>
                    @endif
                    <div class="mt-2">
                        <label class="font-bold text-f14">Email {{trans('index.OR')}} {{trans('index.Phone')}}<span class="text-f13 text-red-600">*</span></label>
                        <input type="text" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="email" value="{{old('email')}}" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="mt-5">
                        <label class="font-bold text-f14">{{trans('index.Password')}}<span class="text-f13 text-red-600">*</span></label>
                        <input type="password" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="password" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="flex mt-5 justify-end">
                        <a href="{{route('customer.reset-password')}}" class="text-[#3bb77e] font-bold" title="{{trans('index.ForgotPassword')}}?">{{trans('index.ForgotPassword')}}?</a>
                    </div>
                    <div class="mt-5 flex justify-center ">
                        <button type="submit" class=" bg-Pimary_color btn-submit-contact py-4 px-1 md:px-8 rounded-lg block bg-[#3bb77e]  text-white transition-all leading-none text-f15 font-bold  w-full"> {{trans('index.Login')}}</button>
                    </div>
                    {{-- <div class="mt-5 text-f13 flex justify-center leading-4"><?php echo $page->description ?></div>
                    <div class="flex justify-center mt-3">
                        <span class="rounded-full border border-gray-300 px-3 py-1 text-f12">hoặc đăng nhập qua</span>
                    </div>
                    @include('customer.frontend.auth.common.social') --}}
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

