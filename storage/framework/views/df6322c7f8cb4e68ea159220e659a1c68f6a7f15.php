 <ul class="nav nav-link-tabs flex-wrap mb-2" role="tablist">
     <li id="example-homepage-tab" class="nav-item" role="presentation">
         <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-homepage" type="button" role="tab" aria-controls="example-tab-homepage" aria-selected="true">Thông tin chung</button>
     </li>
     <?php if(!$field->isEmpty()): ?>
     <li id="example-contact-tab" class="nav-item " role="presentation">
         <button class="nav-link w-full py-2 " data-tw-toggle="pill" data-tw-target="#example-tab-contact" type="button" role="tab" aria-controls="example-tab-contact" aria-selected="true">Custom field</button>
     </li>
     <?php endif; ?>

     <li id="example-attr-tab" class="nav-item <?php if (!in_array('attributes', $dropdown)) { ?>hidden<?php } ?>" role="presentation">
         <button class="nav-link w-full py-2 " data-tw-toggle="pill" data-tw-target="#example-tab-attr" type="button" role="tab" aria-controls="example-tab-attr" aria-selected="true">Bộ lọc sản phẩm(Sản phẩm biến thể)</button>
     </li>
     <li id="example-stock-tab" class="nav-item" role="presentation">
         <button class="nav-link w-full py-2 " data-tw-toggle="pill" data-tw-target="#example-tab-stock" type="button" role="tab" aria-controls="example-tab-stock" aria-selected="true">Kho hàng(Sản phẩm đơn giản)</button>
     </li>
 </ul><?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/product/backend/product/common/tab.blade.php ENDPATH**/ ?>