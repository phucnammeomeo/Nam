
<?php /*$getPrice = getPrice(array('price' => $v->price, 'price_sale' => $v->price_sale, 'price_contact' => $v->price_contact));*/ ?>

{{-- Check có giảm giá --}}
{{-- @if($getPrice['price_old']) --}}
    {{-- Checkbox sản phẩm khuyến mãi --}}
    {{-- @if($item->id == 23)
        <div class="form-check form-switch">
                <input id="checkbox-switch-{{ $title }}-<?php echo $v->id; ?>" <?php echo $v->$title == 1 ? 'checked=""' : ''; ?>
                class="form-check-input publish-ajax" type="checkbox" data-module="{{ $module }}"
                data-id="<?php echo $v->id; ?>" data-title="{{ $title }}">
        </div>
    @else
        <div class="form-check form-switch">
            <input id="checkbox-switch-{{ $title }}-<?php echo $v->id; ?>" <?php echo $v->$title == 1 ? 'checked=""' : ''; ?>
            class="form-check-input publish-ajax" type="checkbox" data-module="{{ $module }}"
            data-id="<?php echo $v->id; ?>" data-title="{{ $title }}">
        </div>
    @endif
@else --}}
<div class="form-check form-switch">
    <input id="checkbox-switch-{{ $title }}-<?php echo $v->id; ?>" <?php echo $v->$title == 1 ? 'checked=""' : ''; ?>
        class="form-check-input publish-ajax" type="checkbox" data-module="{{ $module }}"
        data-id="<?php echo $v->id; ?>" data-title="{{ $title }}">
</div>
{{-- @endif --}}

