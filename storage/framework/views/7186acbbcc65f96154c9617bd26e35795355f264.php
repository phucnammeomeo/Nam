<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

<script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

<link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css" />
<!-- <link rel="stylesheet" href="fonts/font.css"> -->
<link rel="stylesheet" href="<?php echo e(asset('assets/build/tailwind.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/build/app.css')); ?>" />

<link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.theme.default.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/owl.carousel.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/_header.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/_footer.css')); ?>" />

<link rel="stylesheet" href="<?php echo e(asset('assets/css/home/_box_1.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/home/_box_2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/home/_box_3.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/home/_box_4.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/home/_box_5.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/home/_box_6.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/home/_box_7.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/swiper-bundle.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('library/toastr/toastr.min.css')); ?>" />

<?php $__env->startPush('javascript'); ?>
<script  src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
<script  src="<?php echo e(asset('assets/js/owl.carousel.min.js')); ?>"></script>
<script  src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
<script  src="<?php echo e(asset('assets/js/jquery.sticky.js')); ?>"></script>
<script  src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
<script  src="https://unpkg.com/flowbite@1.5.2/dist/datepicker.js"></script>
<script type="text/javascript" src="<?php echo e(asset('product/rating/bootstrap-rating.min.js')); ?>"></script>
<script  src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/swiper-bundle.min.js')); ?>"></script>
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

    const sliderThumbs = new Swiper(".slider__thumbs .swiper-container", {
      direction: "vertical",
      slidesPerView: 4,
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
<?php $__env->stopPush(); ?>
<?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/homepage/common/head.blade.php ENDPATH**/ ?>