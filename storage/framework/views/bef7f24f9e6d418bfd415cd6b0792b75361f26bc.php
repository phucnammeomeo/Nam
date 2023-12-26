  
  <?php $__env->startSection('content'); ?>

  <div class="banner-wrapper has_background">
      <img src="<?php echo e(asset($page['image'])); ?>" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
      <div class="banner-wrapper-inner">
          <h1 class="page-title"><?php echo e($page->title); ?></h1>
          <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
              <ul class="trail-items breadcrumb">
                  <li class="trail-item trail-begin"><a href="<?php echo e(url('')); ?>"><span>Trang chủ</span></a></li>
                  <li class="trail-item trail-end active"><span>Liên hệ</span>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <div class="site-main main-container no-sidebar">
      <div class="section-041">
          <div class="container">
              <?php echo $fcSystem['contact_map'] ?>
          </div>
      </div>
      <div class="section-042">
          <div class="container">
              <div class="row">
                  <div class="col-md-12 offset-xl-1 col-xl-10 col-lg-12">
                      <div class="row">
                          <div class="col-md-6">
                              <h4 class="az_custom_heading">Địa chỉ</h4>
                              <p><?php echo e($fcSystem['contact_address']); ?></p>
                              <h4 class="az_custom_heading">Số điện thoại</h4>
                              <p><?php echo e($fcSystem['contact_hotline']); ?></p>
                              <h4 class="az_custom_heading">Email</h4>
                              <p><?php echo e($fcSystem['contact_email']); ?></p>
                          </div>
                          <div class="col-md-6">
                              <div role="form" class="wpcf7">
                                  <form class="wpcf7-form" id="form-submit-contact">
                                      <p>
                                      <div class="alert alert-danger print-error-msg" style="display:none"><span class=""></span></div>
                                      <div class="alert alert-success print-success-msg" style="display:none"><span class=""></span></div>
                                      </p>
                                      <?php echo csrf_field(); ?>
                                      <p><label> Họ và tên *<br>
                                              <span class="wpcf7-form-control-wrap your-name">
                                                  <input name="fullname" value="" size="40" class="fullname wpcf7-form-control wpcf7-text wpcf7-validates-as-required" type="text"></span>
                                          </label></p>
                                      <p><label> Email *<br>
                                              <span class="wpcf7-form-control-wrap your-email">
                                                  <input name="email" value="" size="40" class="email wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" type="email"></span>
                                          </label></p>
                                      <p><label> Nội dung *<br>
                                              <span class="wpcf7-form-control-wrap your-message">
                                                  <textarea name="message" cols="40" rows="10" class="message wpcf7-form-control wpcf7-textarea"></textarea></span>
                                          </label></p>
                                      <p><button type="submit" class="btn-submit-contact wpcf7-form-control wpcf7-submit">Gửi</button></p>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <?php $__env->stopSection(); ?>
  <?php $__env->startPush('javascript'); ?>
  <style>
      footer {
          margin-top: 0px !important
      }
  </style>
  <script type="text/javascript">
      $(document).ready(function() {
          $(".btn-submit-contact").click(function(e) {
              e.preventDefault();
              var _token = $("#form-submit-contact input[name='_token']").val();
              var fullname = $("#form-submit-contact input[name='fullname']").val();
              var email = $("#form-submit-contact input[name='email']").val();
              var message = $("#form-submit-contact textarea[name='message']").val();
              $.ajax({
                  url: "<?php echo route('contactFrontend.store') ?>",
                  type: 'POST',
                  data: {
                      _token: _token,
                      fullname: fullname,
                      email: email,
                      message: message
                  },
                  success: function(data) {
                      if (data.status == 200) {
                          $("#form-submit-contact .print-error-msg").css('display', 'none');
                          $("#form-submit-contact .print-success-msg").css('display', 'block');
                          $("#form-submit-contact .print-success-msg span").html(
                              "<?php echo $fcSystem['message_2'] ?>");
                          setTimeout(function() {
                              $("#form-submit-contact .print-success-msg").css('display', 'none');
                              $("#form-submit-contact .print-success-msg span").html("");
                          }, 3000);
                      } else {
                          $("#form-submit-contact .print-error-msg").css('display', 'block');
                          $("#form-submit-contact .print-success-msg").css('display', 'none');
                          $("#form-submit-contact .print-error-msg span").html(data.error);
                      }
                  }
              });
          });
      });
  </script>
  <style>
      @media (max-width: 768px) {
          .mt-20-mobile {
              margin-top: 50px;
          }
      }
  </style>
  <?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/globalmat/domains/globalmat.vn/public_html/resources/views/contact/frontend/index.blade.php ENDPATH**/ ?>