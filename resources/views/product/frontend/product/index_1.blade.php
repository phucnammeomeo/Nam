@extends('homepage.layout.home')
@section('content')
<?php
$listAlbums = json_decode($detail->image_json, true);
$price = getPrice(array('price' => $detail->price, 'price_sale' => $detail->price_sale, 'price_contact' => $detail->price_contact));
if (count($detail->product_versions) > 0) {
    $type = 'variable';
} else {
    $type = 'simple';
}

$version = json_decode(base64_decode($detail['version_json']), true);
$attribute_tmp = [];
$attributesID =  [];
if (!empty($version) && !empty($version[2])) {
    foreach ($version[2] as $item) {
        foreach ($item as $val) {
            $attributesID[] = $val;
        }
    }
    if (!empty($attributesID)) {
        $attribute_tmp = \App\Models\Attribute::whereIn('id', $attributesID)->select('id', 'title', 'catalogueid')->with('catalogue')->get();
    }
}
$attributes = [];
if (!empty($attribute_tmp)) {
    foreach ($attribute_tmp as $item) {
        $attributes[] = array(
            'id' => $item->id,
            'title' => $item->title,
            'titleC' => $item->catalogue->title,
        );
    }
}
$attributes = collect($attributes)->groupBy('titleC')->all();

?>
<input type="hidden" value="<?php echo $detail->id ?>" id="detailProductID">
<div id="main" class="main-product-detail">
    <div class="breadcrumb py-[10px]" style="background-color: rgb(47, 47, 152, 1)">
        <div class="container mx-auto px-3">
            <ul class="flex flex-wrap text-white">
                <li class="pr-[5px]">
                    <a href="{{url('')}}" class="text-white">Trang chủ</a>
                </li>
                @foreach($breadcrumb as $k=>$v)
                <li><span class="text-white mx-2">/</span></li>
                <li><a href="<?php echo route('routerURL', ['slug' => $v->slug]) ?>" class="text-white">{{ $v->title}}</a></li>
                @endforeach
                <li><span class="text-white mx-2">/</span></li>
                <li><a href="<?php echo route('routerURL', ['slug' => $detail->slug]) ?>" class="text-white">{{ $detail->title}}</a></li>
            </ul>
        </div>
    </div>
    <div class="container mx-auto ">
        <div class="content-product-detail">
            <div class="bg-white p-[10px] md:p-[25px]">
                <div class="row flex flex-wrap justify-between -mx-3">
                    <div class="lg:w-1/2 md:w-1/2 sm:w-full w-full px-3">
                        <section class="slider">
                            <div class="slider__flex">
                                <div class="slider__images">
                                    <div class="swiper-container">
                                        <!-- Слайдер с изображениями -->
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide ">
                                                <img src="{{asset($detail->image)}}" alt="{{$detail->title}}" class="w-full object-contain h-full" />
                                            </div>
                                            @if(!empty($listAlbums))

                                            @foreach($listAlbums as $key=>$item)
                                            <div class="swiper-slide ">
                                                <img src="{{$item}}" alt="{{$detail->title}}" class="w-full object-contain h-full" />
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="slider__col mt-[15px]">
                                    <div class="slider__thumbs">
                                        <div class="swiper-container">
                                            <!-- Слайдер с превью -->
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide ">
                                                    <img src="{{asset($detail->image)}}" alt="{{$detail->title}}" class="w-full object-contain h-full" />
                                                </div>
                                                @if(!empty($listAlbums))

                                                @foreach($listAlbums as $key=>$item)
                                                <div class="swiper-slide ">
                                                    <img src="{{$item}}" alt="{{$detail->title}}" class="w-full h-[61px] md:h-[102px] object-contain" />
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <!-- Кнопка для переключения на следующий слайд -->
                                </div>
                            </div>
                        </section>
                        <style>
                            .slider .swiper-container {
                                width: 100%;
                                height: 100%;
                            }

                            .slider__prev,
                            .slider__next {
                                cursor: pointer;

                                color: #333;
                            }

                            .slider__prev:focus,
                            .slider__next:focus {
                                outline: none;
                            }

                            .content-product-detail .slider__col {
                                position: relative;
                            }

                            .content-product-detail .slider__col .slider__prev {
                                position: absolute;
                                top: 50%;
                                left: 5px;
                                transform: translateY(-50%);
                                z-index: 999;
                            }

                            .content-product-detail .slider__col .slider__next {
                                position: absolute;
                                top: 50%;
                                right: 5px;
                                transform: translateY(-50%);
                                z-index: 999;
                            }

                            .slider__thumbs .slider__image {
                                transition: 0.25s;
                                -webkit-filter: grayscale(100%);
                                filter: grayscale(100%);
                                opacity: 0.5;
                            }

                            .slider__thumbs .slider__image:hover {
                                opacity: 1;
                            }

                            .slider__thumbs .swiper-slide-thumb-active .slider__image {
                                -webkit-filter: grayscale(0%);
                                filter: grayscale(0%);
                                opacity: 1;
                            }

                            .slider__images {
                                height: 400px;
                            }

                            .slider__images .slider__image img {
                                transition: 3s;
                            }

                            .slider__images .slider__image:hover img {
                                transform: scale(1.1);
                            }

                            .slider__image {
                                width: 100%;
                                height: 100%;

                                overflow: hidden;
                            }

                            .slider__image img {
                                display: block;
                                width: 100%;
                                height: 100%;
                                -o-object-fit: cover;
                                object-fit: cover;
                            }
                        </style>
                        <!-- Swiper JS -->
                        <!-- END: slide product image PC-->
                    </div>
                    <div class="lg:w-1/2 md:w-1/2 sm:w-full w-full px-3 lg:mt-0 md:mt-0 sm:mt-4 mt-4">
                        <h1 class="text-f25 font-bold mb-[15px]">
                            {{$detail->title}}
                        </h1>
                        <p class="text-f14 mb-[3px]">
                            Mã: <span class="text-blue_primary">{{$detail->code}}</span>
                        </p>
                        <p class="text-f14 hidden">
                            Thương hiệu:
                            <span class="text-blue_primary">Bean Fashion</span> | Tình
                            trạng: <span class="text-blue_primary">Còn hàng</span>
                        </p>
                        <p class="price mt-[10px] border-b-[1px] pb-[10px]">
                            <span class="text-f25 font-bold text-red-600"> {{$price['price_final']}}</span>
                            @if(!empty($price['price_old']))
                            <del class="text-f16 text-gray-400 pl-[10px]">{{$price['price_old']}}</del>
                            @endif
                        </p>
                        <div class="desc text-f14 mt-[15px]">
                            <?php echo $detail->description ?>
                        </div>
                        <div class="mt-3">
                            <!--START: product version -->
                            <?php if ($type == 'variable' && !empty($attributes)) { ?>
                                <?php $i = 0;
                                foreach ($attributes as $key => $item) {
                                    $i++;
                                ?>
                                    <?php if (count($item) > 0) { ?>
                                        <div class="box-variable mb-3">
                                            <div class="font-bold text-base mb-1">{{$key}}</div>
                                            <div class="flex flex-wrap space-x-2">
                                                <?php foreach ($item as $k => $val) { ?>
                                                    <a href="javascript:void(0)" class="js_item_variable js_item_variable_{{$val['id']}} py-1 px-5 border 
                                                <?php if ($k == 0) { ?>checked<?php } ?> " data-id="{{$val['id']}}" data-stt="<?php echo !empty($i == count($attributes)) ? 1 : 0 ?>">
                                                        {{$val['title']}}
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php
                                } ?>
                            <?php } ?>
                            <?php if ($type == 'simple') { ?>
                                <?php
                                $hiddenAddToCart = 0;
                                $product_stock_title = '';
                                $quantityStock = '';
                                if ($detail->inventory == 1) {
                                    if ($detail->inventoryPolicy == 0) {
                                        if ($detail->inventoryQuantity == 0) {
                                            $hiddenAddToCart = 1;
                                            $product_stock_title =  '<span class="product_stock">Hết hàng</span>';
                                        } else {
                                            $quantityStock = $detail->inventoryQuantity;
                                            $product_stock_title = '<span class="product_stock">' . $detail->inventoryQuantity . '</span> sản phẩm có sẵn';
                                        }
                                    } else {
                                        $product_stock_title = '<span class="product_stock"></span> sản phẩm có sẵn';
                                    }
                                } else {
                                    $product_stock_title = '<span class="product_stock"></span> sản phẩm có sẵn';
                                }
                                ?>
                            <?php } ?>
                            <!--END: product version -->
                        </div>
                        <div class="w-full py-4">
                            <div class="font-black mb-2">Số lượng</div>
                            <div class="flex items-center">
                                <div class="custom-number-input h-10 w-32 flex flex-row rounded-lg relative bg-transparent mt-1">
                                    <button class="card-dec bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none flex items-center justify-center">
                                        <span class="m-auto text-2xl font-thin">−</span>
                                    </button>
                                    <input type="number" max="{{!empty($quantityStock)?$quantityStock:''}}" class="card-quantity border-0 focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="1"></input>
                                    <button class="card-inc bg-gray-200 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer flex items-center justify-center">
                                        <span class="m-auto text-2xl font-thin">+</span>
                                    </button>
                                </div>
                                <div class="ml-2 text-red-600 font-bold">
                                    @if($type == 'simple')
                                    <?php
                                    echo $product_stock_title;
                                    ?>
                                    @else
                                    <span class="js_product_stock">sản phẩm có sẵn</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-5 flex items-center w-full space-x-2">
                                <button data-quantity="1" data-id="{{$detail->id}}" data-title="{{$detail->title}}" data-price="<?php echo !empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0 ?>" data-cart="0" data-src="" data-type="{{$type}}" class="addtocart uppercase font-black h-12 w-1/2 text-white bg-red-600 flex-1 cursor-pointer items-center inline-flex rounded-md px-6 justify-center">
                                    Thêm vào giỏ
                                </button>
                                <button data-quantity="1" data-id="{{$detail->id}}" data-title="{{$detail->title}}" data-price="<?php echo !empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0 ?>" data-cart="1" data-src="" data-type="{{$type}}" class="addtocart uppercase font-black h-12 w-1/2 text-white bg-black flex-1 cursor-pointer items-center inline-flex rounded-md px-6 justify-center">
                                    mua ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-product-detail pt-[50px]">
        <div class="container mx-auto px-3">
            <h2 class="text-f30 font-bold text-center text-ColorPrimary">
                THÔNG TIN SẢN PHẨM
            </h2>
            <div class="content-content mt-[20px]">
                <?php echo $detail->content ?>
            </div>
            @if(!$productSame->isEmpty())
            <div class="other-product pt-[50px] pb-[50px]">
                <h2 class="text-f30 font-bold text-center text-ColorPrimary">
                    Sản phẩm liên quan
                </h2>
                <div class="slider-product owl-carousel mt-[20px]">
                    @foreach($productSame as $key=>$item)
                    <?php
                    $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
                    $item['price_contact']));
                    ?>
                    <div class="item">
                        <div class="img img-hover">
                            <a href="{{route('routerURL',['slug' => $item->slug])}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" class="w-full"></a>
                        </div>
                        <div class="nav-img mt-[10px]">
                            <h3 class="title-1 text-f15 font-semibold hover:text-Orangefc5 hover:text-Orangefc5">
                                <a href="{{route('routerURL',['slug' => $item->slug])}}" class="hover:text-Orangefc5">{{$item->title}}</a>
                            </h3>

                            <p class="mt-[15px]">
                                <span class="text-f18 font-bold text-red-600">{{$price['price_final']}} </span>
                                @if(!empty($price['price_old']))
                                <del class="pl-[5px] text-gray-400 text-f13">{{$price['price_old']}}</del>
                                @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/swiper-bundle.min.css')}}" />
<link rel="stylesheet" href="{{asset('frontend/library/css/products.css')}}" />

@endpush
@push('javascript')
<script src="{{asset('frontend/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('frontend/library/js/common.js')}}"></script>
<script>
    const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
        direction: "vertical",
        slidesPerView: 5,
        spaceBetween: 10,
        navigation: {
            nextEl: ".slider__next",
            prevEl: ".slider__prev",
        },
        freeMode: true,
        breakpoints: {
            0: {
                direction: "horizontal",
            },
            768: {
                direction: "horizontal",
            },
        },
    });
    const sliderImages = new Swiper(".slider__images .swiper-container", {
        direction: "vertical",
        slidesPerView: 1,
        spaceBetween: 32,
        mousewheel: true,
        navigation: {
            nextEl: ".slider__next",
            prevEl: ".slider__prev",
        },
        grabCursor: true,
        thumbs: {
            swiper: sliderThumbs,
        },
        breakpoints: {
            0: {
                direction: "horizontal",
            },
            768: {
                direction: "vertical",
            },
        },
    });
</script>
@endpush