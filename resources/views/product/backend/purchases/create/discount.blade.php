  <div class="flex justify-between p-4">
      <div style="text-align: right;;border:0px" class="flex-1">
          <div class="flex text-danger font-bold justify-end items-center space-x-1 relative">
              <a href="javascript:void(0)" class="js_toggleDiscount flex items-center space-x-1">
                  <span>Chiết khấu</span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                  </svg>
              </a>
              <div class="absolute bg-white right-0 js_htmlDiscount" style="top:20px;display: none;">
                  <div class="flex p-3 shadow-sm border">
                      <div class="flex" style="width:100px">
                          <a href="javascript:void(0)" class="btn btn-default active js_typeDiscountTP" data-type="money">Giá trị</a>
                          <a href="javascript:void(0)" class="btn btn-default js_typeDiscountTP" data-type="percent">%</a>
                      </div>
                      <div class="flex-1">
                          <input type="text" class="form-control js_valueDiscountTP int" data-type="money">

                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div style="text-align: center;;border:0px;width: 200px;" class="js_priceDiscount">0</div>
  </div>
  <!-- START: script chiết khấu -->
  @push('javascript')
  <script>
      $(".js_toggleDiscount").focus(function() {
          $(".js_htmlDiscount").show()
      });
      var resultsSelected = false;
      $(".js_htmlDiscount").hover(
          function() {
              resultsSelected = true;
          },
          function() {
              resultsSelected = false;
          }
      );
      $(".js_toggleDiscount").blur(function() {
          if (!resultsSelected) { //if you click on anything other than the results
              $(".js_htmlDiscount").hide(); //hide the results
          }
      })

      $(document).on('click', '.js_typeDiscountTP', function() {
          var type = $(this).attr('data-type');
          $('.js_typeDiscountTP').removeClass('active')
          $(this).addClass('active')
          if (type == 'percent') {
              $('.js_valueDiscountTP').attr('max', 100)
          }
          $('.js_valueDiscountTP').attr('data-type', type)
      })
  </script>
  <style>
      .btn-default.active {
          color: #fff;
          background-color: red;
      }
  </style>
  @endpush
  <!-- END: script chiết khấu -->