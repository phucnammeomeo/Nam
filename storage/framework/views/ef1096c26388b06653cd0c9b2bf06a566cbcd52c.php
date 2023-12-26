  
  <?php $__env->startSection('content'); ?>

  <div class="contact-btottom  bg-white p-[10px] mt-[20px]">

    <div class="flex flex-wrap justify-between -mx-3">
      <div class="w-full md:w-1/2 px-3 mt-4 md:mt-0">
        <h3 class="font-bold text-f20 mb-[10px] md:mb-[20px]">
          Địa chỉ của chúng tôi
        </h3>
        <div class="">
          <div class="mb-[20px]">
            <h4 class="text-f15">
              <span
                class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
                ><i class="fa-solid fa-location-dot"></i></span
              ><?php echo e($fcSystem['contact_address']); ?>

            </h4>
          </div>
          <div class="mb-[20px]">
            <h4 class="text-f15">
              <span
                class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
                ><i class="fa-solid fa-phone-volume"></i></span
              ><?php echo e($fcSystem['contact_hotline']); ?>

            </h4>
          </div>
          <div class="mb-[20px]">
            <h4 class="text-f15">
              <span
                class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
                ><i class="fa-solid fa-envelope"></i></span
              ><?php echo e($fcSystem['contact_email']); ?>

            </h4>
          </div>
          <div class="mb-[20px]">
            <h4 class="text-f15">
              <span
                class="w-[30px] h-[30px] text-center inline-block leading-[30px] bg-gray-300 rounded-full mr-[10px]"
                ><i class="fa-regular fa-clock"></i></span
              >Các ngày trong tuần
            </h4>
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/2 px-3">
        <div class="content-bt" role="form">
          <h3 class="font-bold text-f20 mb-[10px] md:mb-[20px]">
            Gửi thắc mắc cho chúng tôi
          </h3>
          <form action="" id="form-submit-contact">

            
            <?php echo csrf_field(); ?>

            <div class="">
              <div class="mb-[10px]">
                <input
                  type="text"
                  class="w-full h-[40px] border-b border-gray-200 rounded-sm text-f15"
                  placeholder="Tên của bạn"
                  name="fullname"
                  required
                />
              </div>
              <div class="flex flex-wrap justify-between mx-[-10px]">
                <div class="w-full md:w-1/2 px-[10px] mb-4 md:mb-0">
                  <input
                    type="email"
                    class="w-full h-[40px] border-b border-gray-200 rounded-sm text-f15"
                    placeholder="Email của bạn"
                    name="email"
                    required
                  />
                </div>
                <div class="w-full md:w-1/2 px-[10px]">
                  <input
                    type="text"
                    class="w-full h-[40px] border-b border-gray-200 rounded-sm text-f15"
                    placeholder="SĐT của bạn"
                    name="phone"
                    required
                  />
                </div>
              </div>

              <div class="mt-[10px]">
                <textarea
                  name="message"
                  id=""
                  cols="30"
                  rows="10"
                  class="w-full h-[100px] border-b border-gray-200 rounded-sm text-f15"
                  placeholder="Nội dung"
                ></textarea>
                <input
                  type="submit"
                  value="Gửi cho chúng tôi"
                  class="h-[40px] bg-Pimary_color text-white px-[15px] text-f15 rounded-sm uppercase mt-[10px] border border-yellow hover:bg-white hover:text-Pimary_color transition-all btn-submit-contact"
                />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="map mt-[20px]">
        <?php echo $fcSystem['contact_map'] ?>
    </div>

  </div>

  <?php $__env->stopSection(); ?>
  <?php $__env->startPush('javascript'); ?>
  <script src="<?php echo e(asset('assets/js/jquery-1.12.4.min.js')); ?>"></script>
  <script type="text/javascript">
      $(document).ready(function() {
          $(".btn-submit-contact").click(function(e) {
              e.preventDefault();
              var _token = $("#form-submit-contact input[name='_token']").val();
              var fullname = $("#form-submit-contact input[name='fullname']").val();
              var email = $("#form-submit-contact input[name='email']").val();
              var phone = $("#form-submit-contact input[name='phone']").val();
              var message = $("#form-submit-contact textarea[name='message']").val();
              $.ajax({
                  url: "<?php echo route('contactFrontend.store') ?>",
                  type: 'POST',
                  data: {
                      _token: _token,
                      fullname: fullname,
                      email: email,
                      phone: phone,
                      message: message,
                      type: "contact",
                  },
                  success: function(data) {
                      if (data.status == 200) {
                            if (confirm('Bạn có muốn gửi phản hồi này với <?php echo (isset($fcSystem[ 'homepage_company'])) ? $fcSystem['homepage_company'] : ''; ?> không ?')) {
                                alert('Gửi thông tin thành công!');
                                location.reload()
                            } else {
                                alert('Hẹn gặp bạn lần sau !');
                                location.reload()
                            }
                      }
                  }
              });
          });
      });
  </script>
  <script src="<?php echo e(asset('assets/js/jquery-1.12.4.min.js')); ?>"></script>
  <script src="<?php echo e(asset('library/toastr/toastr.min.js')); ?>"></script>
  <?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/contact/frontend/index.blade.php ENDPATH**/ ?>