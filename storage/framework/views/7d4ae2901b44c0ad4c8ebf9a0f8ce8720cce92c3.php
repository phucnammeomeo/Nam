<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="robots" content="index,follow" />
    
    <title><?php echo isset($seo['meta_title']) ? $seo['meta_title'] : $fcSystem['seo_meta_title']; ?></title>
    <meta name="description" content="<?php echo isset($seo['meta_description']) ? $seo['meta_description'] : $fcSystem['seo_meta_description']; ?>" />
    <!-- META FOR FACEBOOK -->
    <meta property="og:site_name" content="<?php echo isset($fcSystem['homepage_company']) ? $fcSystem['homepage_company'] : ''; ?>" />
    <meta property="og:rich_attachment" content="true" />
    <meta property="og:type" content="website" />
    <meta property="og:url" itemprop="url" content="<?php echo isset($seo['canonical']) ? $seo['canonical'] : ''; ?>" />
    <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo isset($seo['meta_image']) && !empty($seo['meta_image']) ? url($seo['meta_image']) : url($fcSystem['seo_meta_images']); ?>" />
    <meta property="og:image:width" content="800" />
    <meta property="og:image:height" content="354" />
    <meta content="<?php echo isset($seo['meta_title']) ? $seo['meta_title'] : $fcSystem['seo_meta_title']; ?>" itemprop="headline" property="og:title" />
    <meta content="<?php echo isset($seo['meta_description']) ? $seo['meta_description'] : $fcSystem['seo_meta_description']; ?>" itemprop="description" property="og:description" />
    <!-- Twitter Card -->
    <meta name="twitter:card" value="summary" />
    <meta name="twitter:url" content="<?php echo isset($seo['canonical']) ? $seo['canonical'] : ''; ?>" />
    <meta name="twitter:title" content="<?php echo isset($seo['meta_title']) ? $seo['meta_title'] : $fcSystem['seo_meta_title']; ?>" />
    <meta name="twitter:description" content="<?php echo isset($seo['meta_description']) ? $seo['meta_description'] : $fcSystem['seo_meta_description']; ?>" />
    <meta name="twitter:image" content="<<?php echo isset($seo['meta_image']) && !empty($seo['meta_image']) ? url($seo['meta_image']) : url($fcSystem['seo_meta_images']); ?>" />
    <meta name="twitter:site" content="<?php echo isset($fcSystem['homepage_company']) ? $fcSystem['homepage_company'] : ''; ?>" />
    <meta name="twitter:creator" content="<?php echo isset($fcSystem['homepage_brandname']) ? $fcSystem['homepage_brandname'] : ''; ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e($fcSystem['homepage_favicon']); ?>" />
    <!-- head-->
    <?php echo $__env->yieldPushContent('appcss'); ?>
    <?php echo $__env->make('homepage.common.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('css'); ?>

    <script>
        var BASE_URL = '<?php echo url(''); ?>/';
        var BASE_URL_AJAX = '<?php echo url(''); ?>/';
    </script>
    <?php echo $__env->make('homepage.common.schema', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $fcSystem['script_header']; ?>
</head>

<body>
    <?php echo $__env->make('homepage.common.cache', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('homepage.common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="main" class="sitemap">
        <div class="main-content">
            <?php echo $__env->make('homepage.common.menubottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <?php echo $__env->make('homepage.common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('homepage.common.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php /*@include('homepage.common.loading')*/ ?>
    <?php echo $__env->yieldPushContent('javascript'); ?>
    
    <?php /*echo $fcSystem['script_footer'];*/ ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\khangdien\resources\views/homepage/layout/home.blade.php ENDPATH**/ ?>