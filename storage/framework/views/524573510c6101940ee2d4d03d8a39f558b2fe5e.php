<?php
$menu_footer = getMenus('menu-footer');
?>
<footer id="footer" class="footer style-01">
    <?php echo $__env->make('homepage.common/subscribers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="section-001 section-009" id="widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 widget">
                    <h2 class="widgettitle">Thông tin liên hệ<span class="arrow"></span>
                    </h2>
                    <div class="">
                        <h4 class="az_custom_heading">Địa chỉ</h4>
                        <p><?php echo e($fcSystem['contact_address']); ?></p>
                        <h4 class="az_custom_heading">Hotline</h4>
                        <p><?php echo e($fcSystem['contact_hotline']); ?></p>
                        <h4 class="az_custom_heading">Email</h4>
                        <p><?php echo e($fcSystem['contact_email']); ?></p>
                    </div>
                </div>
                <?php if(count($menu_footer->menu_items) > 0): ?>
                <?php $__currentLoopData = $menu_footer->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($item->children) > 0): ?>
                <div class="col-md-3 widget">
                    <h2 class="widgettitle"><?php echo e($item->title); ?><span class="arrow"></span>
                    </h2>
                    <div class=" ">
                        <ul>
                            <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                            <li class="cat-item"><a href="<?php echo e(url($item2->slug)); ?>" <?php echo $_blank_2 ?>><?php echo e($item2->title); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="col-md-3 widget">
                    <h2 class="widgettitle">Maps<span class="arrow"></span>
                    </h2>
                    <div class="">
                        <?php /*<div class="fb-page" data-href="{{$fcSystem['social_facebook']}}" data-tabs="timeline" data-width="" data-height="230" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="{{$fcSystem['social_facebook']}}" class="fb-xfbml-parse-ignore"><a href="{{$fcSystem['social_facebook']}}">Trái Cây Nhập Khẩu Hà Nội</a></blockquote>
                        </div>*/?>
                        <?php echo $fcSystem['contact_map']?>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="section-010">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php echo e($fcSystem['homepage_copyright']); ?>

                </div>
                <div class="col-md-6">
                    <div class="furgan-socials style-01">
                        <div class="content-socials">
                            <ul class="socials-list">
                                <li>
                                    <a href="<?php echo e($fcSystem['social_facebook']); ?>" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e($fcSystem['social_instagram']); ?>" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e($fcSystem['social_twitter']); ?>" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e($fcSystem['social_pinterest']); ?>" target="_blank">
                                        <i class="fa fa-pinterest-p"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /*<div class="footer-device-mobile">
    <div class="wapper">
        <div class="footer-device-mobile-item device-home">
            <a href="index-2.html">
                <span class="icon">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </span>
                Home
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-wishlist">
            <a href="wishlist.html">
                <span class="icon">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </span>
                Wishlist
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <a href="cart.html">
                <span class="icon">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <span class="count-icon">
                        0
                    </span>
                </span>
                <span class="text">Cart</span>
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-user">
            <a href="my-account.html">
                <span class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                Account
            </a>
        </div>
    </div>
</div>*/ ?>
<a href="#" class="backtotop active">
    <i class="fa fa-angle-double-up"></i>
</a>
<script src="<?php echo e(asset('furgan/assets/js/jquery-1.12.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/chosen.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/countdown.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/jquery.scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/lightbox.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/magnific-popup.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/slick.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/jquery.zoom.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/threesixty.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('furgan/assets/js/mobilemenu.js')); ?>"></script>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
<script src="<?php echo e(asset('furgan/assets/js/functions.js')); ?>"></script>

<?php /*<script>
    $(document).on('click', '.yith-wcqv-button,.add_to_cart_button', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var title = $(this).attr('data-title');
        $('#exampleModalLabel').html(title);
        $.post('<?php echo route('products.quickView') ?>', {
                id: id,
                "_token": $('meta[name="csrf-token"]').attr("content")
            },
            function(data) {
                $('#myModal #product-27 .main-contain-summary').html(data)
                $('#myModal').modal('show')
            }
        );

    })
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="single-thumb-vertical main-container shop-page right-sidebar">
                    <div class="main-content col-xl-12 col-lg-12 col-md-12 col-sm-12 has-sidebar">
                        <div class="furgan-notices-wrapper"></div>
                        <div id="product-27" class="post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-variable has-default-attributes">

                            <div class="main-contain-summary">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>*/ ?>
<style type="text/css">
	footer iframe{
		height: 200px
	}
</style><?php /**PATH /home/globalmat/domains/globalmat.vn/public_html/resources/views/homepage/common/footer.blade.php ENDPATH**/ ?>