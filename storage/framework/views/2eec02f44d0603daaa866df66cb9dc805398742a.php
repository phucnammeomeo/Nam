<script src="<?php echo e(asset('frontend/js/swiper-bundle.min.js')); ?>"></script>


<script src="<?php echo e(asset('frontend/js/hc-offcanvas-nav.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/jquery.sticky.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/jquery.marquee.min.js')); ?>"></script>


<script src="<?php echo e(asset('library/toastr/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/jquery-ui.js')); ?>"></script>




<script src="<?php echo e(asset('frontend/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/library/js/products.js')); ?>"></script>

<script>
    //hieu ung wow------------------------------------------
    wow = new WOW({
        animateClass: "animated",
        offset: 100,
        callback: function (box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">");
        },
    });
    wow.init();

    //hieu ung wow------------------------------------------
    wow = new WOW({
        animateClass: "animated",
        offset: 100,
        callback: function (box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">");
        },
    });
    wow.init();

    // $(document).ready(function() {
    const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
        direction: "vertical",
        slidesPerView: 4,
        spaceBetween: 10,
        navigation: {
            nextEl: ".slider__next",
            prevEl: ".slider__prev",
        },
        freeMode: true,
        slideToClickedSlide: true,
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
    // });


    // ok
    // sliderImages[0].controller.control = sliderThumbs;
    // sliderThumbs[1].controller.control = sliderImages;

    // sliderImages.params.control = sliderThumbs;
    // sliderThumbs.params.swiper = sliderImages;
    });

</script>
<?php /**PATH C:\xampp\htdocs\sports\resources\views/homepage/common/script.blade.php ENDPATH**/ ?>