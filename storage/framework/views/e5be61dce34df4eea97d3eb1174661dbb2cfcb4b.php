<?php
$menu_footer = getMenus('menu-footer');
?>


<!-- start: Footer -->

<div class="support-online">
    <div class="support-content" style="display: none">
      <a href="tel:<?php echo e($fcSystem['contact_hotline']); ?>" class="call-now" rel="nofollow">
        <i class="fa-solid fa-mobile-retro"></i>
        <div class="animated infinite zoomIn kenit-alo-circle"></div>
        <div class="animated infinite pulse kenit-alo-circle-fill"></div>
        <span>Gọi ngay: <?php echo e($fcSystem['contact_hotline']); ?></span>
      </a>
      <a class="mes" href="<?php echo e($fcSystem['social_facebook']); ?>" target="_blank">
        <i class="fa-brands fa-facebook-f"></i>
        <span>Liên hệ qua facebook</span>
      </a>
      <a class="zalo" href="<?php echo e($fcSystem['social_zalo']); ?>" target="_blank">
        <i class="fa-brands fa-rocketchat"></i>
        <span>Zalo: <?php echo e($fcSystem['contact_hotline']); ?></span>
      </a>
      <a class="sms" href="sms:<?php echo e($fcSystem['contact_hotline']); ?>">
        <i class="fa-solid fa-comment-sms"></i>
        <span>SMS: <?php echo e($fcSystem['contact_hotline']); ?></span>
      </a>
    </div>
    <a class="btn-support">
      <i class="fa-solid fa-user"></i>
      <div class="animated infinite zoomIn kenit-alo-circle"></div>
      <div class="animated infinite pulse kenit-alo-circle-fill"></div>
    </a>
  </div>
  <div id="scrollUp"><i class="fa fa-angle-up"></i></div>

  <div
    class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden"
    id="modal"
  >
    <div
      class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
          >&#8203;</span
        >
        <div
          class="p-[50px] relative inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <button
            type="button"
            class="bg-gray-500 text-white rounded absolute top-0 right-0 w-[30px] h-[30px] text-center leading-[30px]"
            onclick="toggleModal()"
          >
            <i class="fas fa-times"></i>
          </button>
          <div
            class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 text-center text-f20 md:text-f40 font-bold"
          >
            <p>
              Soạn:
              <span class="text-Pimary_color">ST150K 386323669 </span>
              gửi<span class="text-Pimary_color"> 9123</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--  end: Footer -->


<?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/footer.blade.php ENDPATH**/ ?>