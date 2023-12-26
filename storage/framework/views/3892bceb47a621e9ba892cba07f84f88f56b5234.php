 <?php
 $listAlbums = json_decode($detail->image_json, true);
 $price = getPrice(['price' => $detail->price, 'price_sale' => $detail->price_sale, 'price_contact' => $detail->price_contact]);
 if (count($detail->product_versions) > 0) {
     $type = 'variable';
 } else {
     $type = 'simple';
 }

 $version = json_decode(base64_decode($detail['version_json']), true);
 $attribute_tmp = [];
 $attributesID = [];
 if (!empty($version) && !empty($version[2])) {
     foreach ($version[2] as $item) {
         foreach ($item as $val) {
             $attributesID[] = $val;
         }
     }
     if (!empty($attributesID)) {
         $attribute_tmp = \App\Models\Attribute::whereIn('id', $attributesID)
             ->select('id', 'title', 'catalogueid')
             ->with('catalogue')
             ->get();
     }
 }
 $attributes = [];
 if (!empty($attribute_tmp)) {
     foreach ($attribute_tmp as $item) {
         $attributes[] = [
             'id' => $item->id,
             'title' => $item->title,
             'titleC' => $item->catalogue->title,
         ];
     }
 }
 $attributes = collect($attributes)
     ->groupBy('titleC')
     ->all();

 ?>
 <div class="row flex flex-wrap justify-between -mx-3">
     <div class="w-full md:w-3/5 px-3">
         <!-- Slide product -->
         <div class="slider">
             <div class="slider__flex">
                 <div class="slider__images">
                     <div class="swiper-container">

                         <div class="swiper-wrapper">
                             <?php if(!empty($listAlbums)): ?>
                                 <?php $__currentLoopData = $listAlbums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <div class="swiper-slide">
                                         <div class="slider__image">
                                             <img src="<?php echo e($item); ?>" alt="<?php echo e($detail->title); ?>" />
                                         </div>
                                     </div>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php else: ?>
                                 <div class="swiper-slide">
                                     <div class="slider__image">
                                         <img src="<?php echo e(asset($detail->image)); ?>" alt="<?php echo e($detail->title); ?>" />
                                     </div>
                                 </div>
                             <?php endif; ?>
                         </div>
                     </div>
                 </div>
                 <?php if(!empty($listAlbums)): ?>
                     <div class="slider__col mt-[15px]">
                         <div class="slider__prev">
                             <i class="fa-solid fa-angle-left"></i>
                         </div>


                         <div class="slider__thumbs">
                             <div class="swiper-container">

                                 <div class="swiper-wrapper">

                                     <?php $__currentLoopData = $listAlbums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <div class="swiper-slide swiper-slide-img">
                                             <div class="slider__image slider_img">
                                                 <img class="img_slider" src="<?php echo e($item); ?>" alt="<?php echo e($detail->title); ?>" />
                                             </div>
                                         </div>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                 </div>
                             </div>
                         </div>

                         <div class="slider__next">
                             <i class="fa-solid fa-angle-right"></i>
                         </div>
                         <!-- Кнопка для переключения на следующий слайд -->
                     </div>
                 <?php else: ?>
                     <div class="slider__col mt-[15px]" style="display: none">
                         <div class="slider__prev">
                             <i class="fa-solid fa-angle-left"></i>
                         </div>


                         <div class="slider__thumbs">
                             <div class="swiper-container">

                                 <div class="swiper-wrapper">
                                     <?php if(!empty($listAlbums)): ?>
                                         <?php $__currentLoopData = $listAlbums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <div class="swiper-slide">
                                                 <div class="slider__image">
                                                     <img src="<?php echo e($item); ?>" alt="<?php echo e($detail->title); ?>" />
                                                 </div>
                                             </div>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>
                                 </div>
                             </div>
                         </div>

                         <div class="slider__next">
                             <i class="fa-solid fa-angle-right"></i>
                         </div>
                         <!-- Кнопка для переключения на следующий слайд -->
                     </div>
                 <?php endif; ?>
             </div>
         </div>

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

             .slider__col {
                 position: relative;
             }

             .slider__col .slider__prev {
                 position: absolute;
                 top: 50%;
                 left: 5px;
                 transform: translateY(-50%);
                 z-index: 999;
             }

             .slider__col .slider__next {
                 position: absolute;
                 top: 50%;
                 right: 5px;
                 transform: translateY(-50%);
                 z-index: 999;
             }

             .slider__thumbs .slider__image {
                 transition: 0.25s;
                
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

                 object-fit: contain;
             }

             .swiper-slide-img{
                width: 150px!important; 
             }

             .img_slider{
                width: 100%!important;
                height: 100%!important;
                object-fit: cover!important;
             }

             .slider_img{
                width: 150px!important;
                height: 100px!important;
             }
         </style>

         <!-- Swiper JS -->
         <!-- END: slide product image PC-->

         <!-- Thông tin liên hệ chung -->
         <div class="endow-2 border border-gray-100 rounded-[10px] p-[15px] mt-[20px] ">
             <p class="mb-5px">
                <?php echo $detail->shipping; ?>
             </p>

         </div>

     </div>

     <div class="w-full md:w-2/5 px-3 lg:mt-0 md:mt-0 sm:mt-4 mt-4">
         <h1 class="text-f20 font-bold mb-[5px]">
             <?php echo e($detail->title); ?>

         </h1>
         <p class="text-f14 mb-[3px]">
             Mã: <span class="text-blue_primary"><?php echo e($detail->code); ?></span>
         </p>

         <p class="text-f14">

             Tình
             trạng:
             <?php if ($type == 'simple') { ?>
             <?php
             $hiddenAddToCart = 0;
             $product_stock_title = '';
             $quantityStock = '';
             if ($detail->inventory == 1 && $detail->inventoryPolicy == 0) {
                 if ($detail->inventoryQuantity == 0) {
                     $hiddenAddToCart = 1;
                     $product_stock_title = '<span class="text-blue_primary"">Hết hàng!</span>';
                 } else {
                     $quantityStock = $detail->inventoryQuantity;
                     $product_stock_title = '<span class="text-blue_primary"">' . 'Còn  ' . '<span style="color: red;font-weight:700">' . $detail->inventoryQuantity . '</span>' . '</span> sản phẩm trong cửa hàng!';
                 }
             } else {
                 $product_stock_title = '<span class="text-blue_primary""></span> Sản phẩm có sẵn!';
             }
             echo $product_stock_title;
             ?>
             <?php } else { ?>
             <span class="text-blue_primary">Sản phẩm có sẵn!</span>
             <?php } ?>
         </p>



         <p class="price mt-[10px] border-b-[1px] pb-[10px]">
             <?php if($price['price_final'] == "Liên hệ"): ?>
                <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>" title="Liên hệ hotline: <?php echo e($fcSystem['contact_hotline']); ?>"><span class="text-f25 font-bold text-red-600"> <?php echo e($price['price_final']); ?> </span></a>
             <?php else: ?>
                <span class="text-f25 font-bold text-red-600"> <?php echo e($price['price_final']); ?> </span>
             <?php endif; ?>

             
             <?php if(!empty($price['price_old'])): ?>
                 
                    <?php
                    $discount = 0;
                    $discount += ceil((((int) $price['price_old'] - (int) $price['price_final']) * 100) / (int) $price['price_old']);
                    ?>
                 <del class="text-f16 text-gray-400 pl-[10px]"><?php echo e($price['price_old']); ?>

                 </del>

                 <span class="bg-red text-f15 py-[3px] px-[10px] rounded-[5px] inline-block ml-[10px] text-white">-
                     <?php echo e($discount); ?> %
                 </span>
             <?php endif; ?>

         </p>

         <div class="w-full py-4">
             <div class="desc text-f14 ">
                 <p>
                     <?php echo $detail->description; ?>
                 </p>
             </div>

             <!-- Button chung -->
             <div class="mt-5">
                  <?php if($price['price_final'] == "Liên hệ"): ?>
                        <button data-quantity="1" data-id="<?php echo e($detail->id); ?>" data-title="<?php echo e($detail->title); ?>"
                            data-price="<?php echo !empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0; ?>" data-cart="0" data-src="" data-type="<?php echo e($type); ?>"
                            type="button"
                            class="rounded-[5px] addtocart single_add_to_cart_button uppercase font-bold py-[7px] w-full mb-[10px] text-white bg-Pimary_color flex-1 cursor-pointer items-center inline-flex px-6 justify-center border border-Pimary_color hover:text-Pimary_color hover:bg-white transition-all"
                            style="display: none">
                            Đặt hàng
                        </button>
                    <?php else: ?>
                        <button data-quantity="1" data-id="<?php echo e($detail->id); ?>" data-title="<?php echo e($detail->title); ?>"
                            data-price="<?php echo !empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0; ?>" data-cart="0" data-src="" data-type="<?php echo e($type); ?>"
                            type="button"
                            class="rounded-[5px] addtocart single_add_to_cart_button uppercase font-bold py-[7px] w-full mb-[10px] text-white bg-Pimary_color flex-1 cursor-pointer items-center inline-flex px-6 justify-center border border-Pimary_color hover:text-Pimary_color hover:bg-white transition-all">
                            Đặt hàng
                        </button>
                    <?php endif; ?>
                 <div class="phone-phone">
                     <div class="flex flex-wrap justify-between mx-[-5px]">
                         <div class="w-full md:w-1/2 px-[5px]">
                             <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>"
                                 class="mb-[5px] md:mb-0 w-full inline-block py-[7px] text-white bg-Pimary_color text-center text-f16 font-bold rounded-[25px] border border-Pimary_color hover:bg-white hover:text-Pimary_color transition-all"><i
                                     class="fa-solid fa-phone mr-2"></i><?php echo e($fcSystem['contact_hotline']); ?></a>
                         </div>
                         <div class="w-full md:w-1/2 px-[5px]">
                             <a href="tel:<?php echo e($fcSystem['contact_hotline2']); ?>"
                                 class="w-full inline-block py-[7px] text-white bg-red text-center text-f16 font-bold rounded-[25px] border border-red hover:bg-white hover:text-red transition-all"><i
                                     class="fa-solid fa-phone mr-2"></i><?php echo e($fcSystem['contact_hotline2']); ?></a>
                         </div>
                     </div>
                 </div>
                 <?php if(!empty($detail->endow)): ?>
                 <div class="endow border border-Pimary_color rounded-[10px] p-[15px] mt-[20px]">
                     <p class="mb-[5px]"><?php echo $detail->endow; ?></p>
                 </div>
                 <?php else: ?>
                 <div class="endow border border-Pimary_color rounded-[10px] p-[15px] mt-[20px]" style="display: none;">
                    <h3 class="text-f16  uppercase mb-[10px] border-b border-gray-100 pb-[10px]"><img
                            src="img/icon-4.png" alt="" class="mr-[3px] inline-block"> Ưu đãi đặc biệt
                    </h3>
                    <p class="mb-[5px]"><?php echo $detail->endow; ?></p>

                </div>
                 <?php endif; ?>
             </div>

         </div>
     </div>

 </div>



 <?php $__env->startPush('javascript'); ?>
     <script src="<?php echo e(asset('assets/js/jquery-1.12.4.min.js')); ?>"></script>
     <script src="<?php echo e(asset('frontend/library/js/products.js')); ?>"></script>
     <script src="<?php echo e(asset('frontend/library/js/common.js')); ?>"></script>
     <script src="<?php echo e(asset('library/toastr/toastr.min.js')); ?>"></script>
 <?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('library/toastr/toastr.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/product/frontend/product/data.blade.php ENDPATH**/ ?>