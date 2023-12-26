@extends('homepage.layout.home')
@section('content')
    <div class="container mx-auto px-0 md:px-3">
        <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">
            @include('homepage.common.aside')
            <div class="w-full lg:w-4/5 px-0 md:px-[5px]">
                <div class="content-product  ">
                    @include('homepage.common.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => $detail->title])

                    <div class="title-title p-[10px] text-f18">
                        <a href="javascript:void(0)" class=" font-bold">{{ $detail->title }}</a>
                    </div>
                    <div class=" bg-white">
                        @if (!empty($data))
                            <div class="flex flex-wrap justify-center mx-[-10px]">
                                @foreach ($data as $key => $item)
                                <div class="w-1/2 md:w-1/4 px-[10px]">
                                    {!! htmlItemProduct($item, checkProductIncart($item->id, $cart['cart'])) !!}
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
{{-- @include('product.frontend.category.script') --}}
{{-- @push('javascript')
<script>
    $(document).on('click', '.modes-mode', function(e) {
        $('.modes-mode').removeClass('active')
        $(this).addClass('active')
        var type = $(this).attr('value');
        if (type == 'grid') {
            $('#js_data_product_filter li').attr('class', '').addClass('grid-item product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes')
        } else if (type == 'list') {
            $('#js_data_product_filter li').attr('class', '').addClass('list-item product-item wow fadeInUp product-item rows-space-30 col-bg-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-ts-12 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes')
        }
    })
</script>
@endpush --}}
