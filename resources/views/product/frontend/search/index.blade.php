@extends('homepage.layout.home')
@section('content')
    <div class="container mx-auto px-3">
        <div class="content-product mt-[30px] bg-white">
            <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
                <a href="javascript:void(0)" class="text-white font-bold">KẾT QUẢ TÌM KIẾM</a>
            </div>
            <div class="p-[10px]">
                @if(!empty($data))
                    <div class="flex flex-wrap mx-[-10px] justify-center">
                        @foreach ($data as $key => $item)
                            <div class="w-1/2 md:w-1/4">
                                {!! htmlItemProduct($item, checkProductIncart($item->id, $cart['cart'])) !!}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="pagenavi wow fadeInUp mt-[20px] pb-[20px]">
                {{-- Phân trang --}}
                <?php echo $data->links() ?>
            </div>

        </div>
    </div>


@endsection
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
    $(document).ready(function() {
        $(function() {
            $(document).on('change', '.SortBy', function() {
                var sort_by = $(this).val();
                window.location.href =
                "<?php echo $seo['canonical'] ?>?keyword=<?php echo request()->get('keyword') ?>&category_id=<?php echo request()->get('category_id') ?>&sort=" +
                sort_by;
            });
        });
    });
</script>
@endpush --}}

