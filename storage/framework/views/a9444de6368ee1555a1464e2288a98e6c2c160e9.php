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
 <div class="contain-left has-gallery">
     <div class="single-left">
         <div class="furgan-product-gallery furgan-product-gallery--with-images furgan-product-gallery--columns-4 images">

             <div class="flex-viewport">
                 <figure class="furgan-product-gallery__wrapper">
                     <div class="furgan-product-gallery__image">
                         <img src="<?php echo e(asset($detail->image)); ?>" alt="<?php echo e($detail->title); ?>" style="width:100%" />
                     </div>
                     <?php if(!empty($listAlbums)): ?>
                     <?php $__currentLoopData = $listAlbums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <div class="furgan-product-gallery__image">
                         <img src="<?php echo e($item); ?>" alt="<?php echo e($detail->title); ?>" class="" style="width:100%" />
                     </div>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php endif; ?>
                 </figure>
             </div>
             <ol class="flex-control-nav flex-control-thumbs">
                 <li>
                     <img src="<?php echo e(asset($detail->image)); ?>" alt="<?php echo e($detail->title); ?>" style="width:100%" />
                 </li>
                 <?php if(!empty($listAlbums)): ?>
                 <?php $__currentLoopData = $listAlbums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <li>
                     <img src="<?php echo e($item); ?>" alt="<?php echo e($detail->title); ?>" class="" style="width:100%" />
                 </li>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php endif; ?>
             </ol>
         </div>
     </div>
     <div class="summary entry-summary">
         <h1 class="product_title entry-title"><?php echo e($detail->title); ?></h1>
         <p class="price">
             <span class="furgan-Price-amount amount  js_product_price_final">
                 <?php echo e($price['price_final']); ?>

             </span>
             <?php if(!empty($price['price_old'])): ?>
             <del><span class="furgan-Price-amount amount js_product_price_old"><?php echo e($price['price_old']); ?></span></del>
             <?php endif; ?>
         </p>
         <p class="stock in-stock">
             Tình trạng:
             <?php if ($type == 'simple') { ?>
                 <?php
                    $hiddenAddToCart = 0;
                    $product_stock_title = '';
                    $quantityStock = '';
                    if ($detail->inventory == 1 && $detail->inventoryPolicy == 0) {
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
                    echo $product_stock_title;
                    ?>
             <?php } else { ?>
                 <span class="js_product_stock">sản phẩm có sẵn</span>
             <?php } ?>
         </p>
         <div class="furgan-product-details__short-description">
             <?php echo $detail->description ?>
         </div>
         <form class="variations_form cart">
             <div class="variations">
                 <?php if ($type == 'variable' && !empty($attributes)) { ?>
                     <?php $i = 0;
                        foreach ($attributes as $key => $item) {
                            $i++;
                        ?>
                         <?php if (count($item) > 0) { ?>
                             <div class="box-variable mb-3">
                                 <div class="font-bold text-base mb-1"><?php echo e($key); ?></div>
                                 <div class="flex flex-wrap space-x-2">
                                     <?php foreach ($item as $k => $val) { ?>
                                         <a href="javascript:void(0)" data-countKey="<?php echo e($i); ?>" data-count="<?php echo e(count($attributes)); ?>" class="js_item_variable js_item_variable_<?php echo e($val['id']); ?> py-1 px-3 border 
                                                                    <?php if ($k == 0) { ?>checked<?php } ?> " data-id="<?php echo e($val['id']); ?>" data-stt="<?php echo !empty($i == count($attributes)) ? 1 : 0 ?>">
                                             <?php echo e($val['title']); ?>

                                         </a>
                                     <?php } ?>
                                 </div>
                             </div>
                         <?php } ?>
                     <?php
                        } ?>
                 <?php } ?>
             </div>
             <style>
                 .font-bold {
                     font-weight: bold;
                 }

                 .flex {
                     display: flex
                 }

                 .flex-wrap {
                     flex-wrap: wrap;
                 }

                 .space-x-2> :not([hidden])~ :not([hidden]) {
                     --tw-space-x-reverse: 0;
                     margin-right: calc(0.5rem * var(--tw-space-x-reverse));
                     margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
                 }

                 .text-base {
                     font-size: 1rem;
                     line-height: 1.5rem;
                 }

                 .mb-3 {
                     margin-bottom: 0.75rem;
                 }
             </style>
             <div class="single_variation_wrap">
                 <div class="furgan-variation single_variation"></div>
                 <div class="furgan-variation-add-to-cart variations_button">
                     <div class="quantity">
                         <span class="qty-label">Số lượng:</span>
                         <div class="control">
                             <a class="btn-number  card-dec" href="#">-</a>
                             <input type="text" data-step="1" min="0" max="" name="quantity[25]" value="1" title="Qty" class="card-quantity input-qty input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
                             <a class="btn-number  card-inc" href="#">+</a>
                         </div>
                     </div>
                     <button data-quantity="1" data-id="<?php echo e($detail->id); ?>" data-title="<?php echo e($detail->title); ?>" data-price="<?php echo !empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0 ?>" data-cart="0" data-src="" data-type="<?php echo e($type); ?>" type="button" class="addtocart single_add_to_cart_button button alt  furgan-variation-selection-needed">
                         Thêm vào giỏ hàng
                     </button>
                 </div>
             </div>
         </form>

         <div class="product_meta">
             <span class="sku_wrapper">Mã sản phẩm: <span class="sku js_product_code"><?php echo e($detail->code); ?></span></span>
             <?php if(count($detail->relationships) > 0): ?>
             <span class="posted_in">Categories:
                 <?php $__currentLoopData = $detail->relationships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kc=>$c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php echo !empty($kc > 0) ? ', ' : '' ?><a href="<?php echo e(route('routerURL',['slug' => $c->slug])); ?>"><?php echo e($c->title); ?></a>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </span>
             <?php endif; ?>
             <?php if(count($detail->getTags) > 0): ?>
             <span class="tagged_as">Tags:
                 <?php $__currentLoopData = $detail->getTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php echo !empty($key > 0) ? ', ' : '' ?><a href="<?php echo e(route('tagURL',['slug' => $item->slug])); ?>" rel="tag"><?php echo e($item->title); ?></a>
                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span>
             <?php endif; ?>
         </div>
         <div class="furgan-share-socials">
             <h5 class="social-heading">Share: </h5>
             <a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $seo['canonical'] ?>">
                 <i class="fa fa-facebook-f"></i>
             </a>
             <a target="_blank" class="twitter" href="https://twitter.com/intent/tweet?url=<?php echo $seo['canonical'] ?>">
                 <i class="fa fa-twitter"></i>
             </a>
             <a target="_blank" class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo $seo['canonical'] ?>">
                 <i class="fa fa-pinterest"></i>
             </a>
             <a target="_blank" class="googleplus" href="https://plus.google.com/share?url=<?php echo $seo['canonical'] ?>">
                 <i class="fa fa-google-plus"></i>
             </a>
         </div>
     </div>
 </div>
 <?php $__env->startPush('css'); ?>
 <link rel="stylesheet" href="<?php echo e(asset('frontend/library/css/products.css')); ?>" />
 <style>
     .js_item_variable.checked {
         position: relative;
         border-color: #ee4d2d !important;
     }
 </style>
 <?php $__env->stopPush(); ?>

 <?php $__env->startPush('javascript'); ?>
 <script type="text/javascript" src="<?php echo e(asset('product/rating/bootstrap-rating.min.js')); ?>"></script>
 <script src="<?php echo e(asset('frontend/library/js/common.js')); ?>"></script>
 <script src="<?php echo e(asset('frontend/library/js/products.js')); ?>"></script>
 <?php $__env->stopPush(); ?><?php /**PATH /home/globalmat/domains/globalmat.vn/public_html/resources/views/product/frontend/product/data.blade.php ENDPATH**/ ?>