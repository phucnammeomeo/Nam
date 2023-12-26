@extends('homepage.layout.home')
@section('content')

    <div class="container mx-auto overflow-hidden mt-[20px] ">
        <div class="flex flex-wrap justify-center">
            <div class="w-full px-[10px]">
                <div class=" bg-white py-[10px]  relative inline-block w-full overflow-hidden">
                    <div class="icon absolute top-0 left-0 bg-white  z-10">
                        <img src="{{ asset('frontend/img/icon-5.gif') }}" alt="Icon" style="width: 50px; "
                             class="inline-block float-left mr-[10px] ">
                    </div>
                    <div class="marquee_text">
                        <div class="content-marquee_text">
                            <p class="flex flex-wrap items-center text-f16 font-bold">{{ $fcSystem['homepage_marquee'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-3">
        @if( $productHome )
            @foreach( $productHome as $key => $val )
                @if( !$val->data->isEmpty() )
                    <div class="content-product mt-[30px] ">
                        <div class="title-title p-[10px] text-f18">
                            <a href="{{ route( 'routerURL', ['slug' => $val->slug] ) }}" class=" font-bold">{{ $val->title }}</a>
                        </div>
                        <div class="bg-white">
                            <div class="flex flex-wrap justify-center mx-[-10px] render-data">
                                @foreach( $val->data as $keyC => $valC )
                                <div class="w-1/2 md:w-1/4 lg:w-1/5 px-[10px]">
                                    {!! htmlItemProduct($valC, checkProductIncart($valC->id, $cart['cart'])) !!}
                                </div>
                                @endforeach
                            </div>
                            @if( count($val->data) == 10 )
                                <div class="readmore text-center inline-block w-full mt-[10px] mb-[20px]">
                                    <a href="javascript:void(0)" data-id="{{ $val->id }}" data-count="10" data-limit="10" class="load-more-product border border-Pimary_color py-[8px] px-[25px] rounded-[5px] text-Pimary_color hover:bg-Pimary_color hover:text-white transition-all">
                                        Xem thêm<i class="fa-solid fa-angles-right text-f12 ml-[5px]"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        @endif

        @if( $partners )
        <div class="partner-section p-[10px] bg-white mt-[20px]">
            <div class="title-title p-[10px] text-f20 text-center uppercase">
                <a href="javascript:void(0)" class=" font-bold">{{ $partners->title }}</a>
            </div>
            <div class="content-partner-section mt-[20px]">
                <div class="owl-carousel slider-partner-2">
                    @foreach( $partners->slides as $key => $valC )
                    <div class="item">
                        <a href="{{ $valC->slug!=''?url($valC->slug):'javascript:void(0)' }}"><img src="{{ $valC->src }}" alt="{{ $valC->title }}"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
@push('javascript')
@endpush
