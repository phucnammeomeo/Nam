@extends('homepage.layout.home')
@section('content')

{{-- Article --}}
<div class="container mx-auto px-3">

    <div class="content-right">

        <div class="content-new-detail bg-white p-[10px]">

            @include('homepage.common.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $detail->title])

            <h1 class="text-f20 font-bold">
                {{$detail->title}}
            </h1>

            <p class="date text-gray-600 my-[10px]">
                Ngày đăng: {{ date('d/m/Y', strtotime($detail['created_at'])) }}
            </p>

            <div class="content-content">
                {!! $detail->content !!}
            </div>

        </div>

        @if( $sameArticle )

        <div class="other-new pt-[30px] bg-white p-[10px] mt-[20px]">

            <div class="title-title  text-f18 pl-[20px] uppercase">

                <a href="javacript:void(0)" class=" font-bold">Bài viết liên quan</a>

            </div>

            <div class="slider-new owl-carousel mt-[20px]">

                @foreach($sameArticle as $item)

                <div class="item border rounded-[6px] overflow-hidden p-[10px]" style="border: 2px solid transparent;box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px;">

                    <div class="img hover-zoom">

                        <a href="{{ route('routerURL', ['slug' => $item->slug]) }}">

                            <img src=" {{ asset($item->image != '')?$item->image:'images/404.png' }}" alt="{{ $item->title }}" class="w-full object-cover">

                        </a>

                    </div>

                    <div class="mt-[15px]">

                        <h3 class="text-f17 overflow-hidden" style="text-overflow: ellipsis;line-height: 20px;-webkit-line-clamp: 2;height: 40px;display: -webkit-box;-webkit-box-orient: vertical;">

                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}" class="hover:text-Pimary_color transition-all"> {{ $item->title }} </a>

                        </h3>

                        <p class="date text-gray-600 mt-[5px] text-f13">{{ $item['created_at'] }}</p>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        @endif

    </div>

</div>

@endsection
@push('javascript')
@endpush
