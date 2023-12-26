
<?php /*$getPrice = getPrice(array('price' => $v->price, 'price_sale' => $v->price_sale, 'price_contact' => $v->price_contact));*/ ?>



    
    
<div class="form-check form-switch">
    <input id="checkbox-switch-<?php echo e($title); ?>-<?php echo $v->id; ?>" <?php echo $v->$title == 1 ? 'checked=""' : ''; ?>
        class="form-check-input publish-ajax" type="checkbox" data-module="<?php echo e($module); ?>"
        data-id="<?php echo $v->id; ?>" data-title="<?php echo e($title); ?>">
</div>


<?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/components/isModule.blade.php ENDPATH**/ ?>