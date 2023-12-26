@extends('homepage.layout.home')
@section('content')
    <?php $cart = Session::get('cart'); ?>
    {{--  DANH MUC  --}}
    <div class="container mx-auto px-0 md:px-3">
        <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">
            @include('homepage.common.aside')
            <div class="w-full lg:w-4/5 px-0 md:px-[5px]">
                <div class="content-product  ">
                    @include('homepage.common.breadcrumb', ['breadcrumb' => '', 'title' => $page->title])

                    <div class="title-title p-[10px] text-f18">
                        <a href="javascript:void(0)" class=" font-bold">{{ $page->title }}</a>
                    </div>
                    <div class=" bg-white">
                        @if (!empty($data))
                            <div class="flex flex-wrap justify-center mx-[-10px]">
                                @foreach ($data as $key => $item)
                                    <div class="w-1/2 md:w-1/4 px-[10px]">
                                        {!! htmlItemProduct($item, checkProductIncart($item->id, $cart)) !!}
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagenavi wow fadeInUp mt-[20px] pb-[20px]">
                                {{-- Phân trang --}}
                                <?php echo $data->links(); ?>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .content-product .breadcrumb {
            margin: 10px 0;
        }
    </style>
@endpush
