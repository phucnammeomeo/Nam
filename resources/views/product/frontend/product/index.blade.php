@extends('homepage.layout.home')
@section('content')
    <input type="hidden" value="<?php echo $detail->id; ?>" id="detailProductID">

    <div class="container mx-auto px-0 md:px-3" style="">
        <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">

            @include('homepage.common.aside')

            <div class="w-full lg:w-4/5 px-0 md:px-[5px]">

                <div class="bg-white p-[10px]">
                    @include('homepage.common.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $detail->title])
                    @include('product.frontend.product.data')
                </div>
                <div class="information-product mt-[10px] md:mt-[30px]  ">
                    <div class="flex flex-wrap justify-between ">
                        <div class="w-full md:w-1/2 ">
                            <h2 class=" py-[10px] px-[15px]  font-bold uppercase text-f18">
                                Thông tin sản phẩm
                            </h2>
                            <div class="p-[15px] bg-white h-full">
                                <div class="content-content">
                                    {!! $detail->content !!}
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 ">
                            <h2 class=" py-[10px] px-[15px]  font-bold uppercase text-f18">
                                Thông tin
                            </h2>
                            <div class="p-[15px] bg-white h-full">
                                <div class="content-content table">
                                    {!! showField($detail->postmetas, 'config_colums_editor_detail_product_info') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    @if (!$productSame->isEmpty())
        <div class="other-product mt-[40px]">
            <div class="container mx-auto px-0 md:px-3">
                <div class="content-product mt-[30px] ">
                    <div class="title-title p-[10px] text-f18">
                        <a href="javascript:void(0)" class=" font-bold">Sản phẩm liên quan</a>
                    </div>
                    <div class=" bg-white">
                        <div class="slider-product-related owl-carousel">
                            @foreach($productSame as $key => $item)
                                {!! htmlItemProduct($item, checkProductIncart($item->id, $cart['cart'])) !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('javascript')
    <script>
        $(function($) {
            let url = "<?php echo route('routerURL', ['slug' => $detailCatalogue->slug]); ?>";
            $('.cat-item a').each(function() {
                if (this.href === url) {
                    $(this).parent().addClass('current-cat');
                }
            });
        });
    </script>
@endpush

@push('css')
    <style type="text/css">
        .content-content img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: auto !important;
        }
    </style>
@endpush
