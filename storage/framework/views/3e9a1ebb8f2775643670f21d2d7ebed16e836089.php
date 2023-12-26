    <div class="flex justify-between p-4">
        <div style="text-align: right;;border:0px" class="flex-1">
            <a href="javascript:void(0)" class="flex text-danger font-bold justify-end items-center space-x-1" data-tw-toggle="modal" data-tw-target="#modal-add-surcharge">
                <span>Chi phí</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </a>
        </div>
        <div style="text-align: center;;border:0px;width: 200px;" class="js_priceSurcharge">0</div>
    </div>
    <?php $__env->startPush('javascript'); ?>
    <!-- START: phụ phí -->
    <div id="modal-add-surcharge" class="modal" tabindex="-1" aria-hidden="true">
        <form class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header flex justify-between items-center">
                    <h2 class="font-medium text-base mr-auto">
                        Thêm chi phí
                    </h2>
                    <button type="button" data-tw-dismiss="modal" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modal Body -->
                <div class="modal-body space-y-3">
                    <div class="listItemSurcharge space-y-3">
                        <div class="item flex space-x-4 items-center">
                            <div class="w-3/5">
                                <input type="text" name="surcharge[title]" value="" class="form-control" placeholder="Tên chi phí" required>
                            </div>
                            <div class="w-1/5">
                                <input type="text" name="surcharge[price]" value="" class="form-control int" placeholder="0" required>
                            </div>
                            <div class="w-1/5">
                                <a href="javascript:void(0)" class="js_deleteSurcharge">
                                    <svg viewBox="0 0 20 20" focusable="false" aria-hidden="true" style="fill: red;width:20px;height:20px">
                                        <path d="M8 3.994c0-1.101.895-1.994 2-1.994s2 .893 2 1.994h4c.552 0 1 .446 1 .997a1 1 0 0 1-1 .997h-12c-.552 0-1-.447-1-.997s.448-.997 1-.997h4zm-3 10.514v-6.508h2v6.508a.5.5 0 0 0 .5.498h1.5v-7.006h2v7.006h1.5a.5.5 0 0 0 .5-.498v-6.508h2v6.508a2.496 2.496 0 0 1-2.5 2.492h-5c-1.38 0-2.5-1.116-2.5-2.492z"> &lt; /path&gt; </path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="flex justify-between items-center border-t pt-3">
                        <a href="javascript:void(0)" class="font-bold text-danger flex space-x-2 items-center js_addSurcharge">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Thêm chi phí
                        </a>
                        <div class="">
                            Tổng chi phí: <span class="js_totalSurcharge text-danger"> 0</span>
                        </div>

                    </div>
                </div>
                <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer">
                    <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Thoát</button>
                    <button type="submit" class="btn btn-primary">Áp dụng</button>
                </div>
                <!-- END: Modal Footer -->
            </div>
        </form>
    </div>
    <script>
        $(document).on('click', '.js_addSurcharge', function(e) {
            let html = '';
            html = html + '<div class="item flex space-x-4 items-center">';
            html = html + '<div class="w-3/5">';
            html = html + '<input type="text" name="surcharge[title]" value="" class="form-control" placeholder="Tên chi phí" required>';
            html = html + '</div>';
            html = html + '<div class="w-1/5">';
            html = html + '<input type="text" name="surcharge[price]" value="" class="form-control int" placeholder="0" required>';
            html = html + '</div>';
            html = html + '<div class="w-1/5">';
            html = html + ' <a href="javascript:void(0)" class="js_deleteSurcharge"><svg viewBox="0 0 20 20" focusable="false" aria-hidden="true" style="fill: red;width:20px;height:20px"><path d="M8 3.994c0-1.101.895-1.994 2-1.994s2 .893 2 1.994h4c.552 0 1 .446 1 .997a1 1 0 0 1-1 .997h-12c-.552 0-1-.447-1-.997s.448-.997 1-.997h4zm-3 10.514v-6.508h2v6.508a.5.5 0 0 0 .5.498h1.5v-7.006h2v7.006h1.5a.5.5 0 0 0 .5-.498v-6.508h2v6.508a2.496 2.496 0 0 1-2.5 2.492h-5c-1.38 0-2.5-1.116-2.5-2.492z"> &lt; /path&gt; </path></svg></a>';
            html = html + '</div>';
            html = html + '</div>';
            $('.listItemSurcharge').append(html);
        })
        $(document).on('click', '.js_deleteSurcharge', function() {
            let _this = $(this);
            _this.parents('.item').remove();
        });
        $(document).on('keyup', 'input[name="surcharge[price]"]', function(e) {
            var sum = 0;
            $('input[name="surcharge[price]"]').each(function() {
                sum += Number($(this).val().replace(".", ""));
            });
            $('.js_totalSurcharge').html(numberWithCommas(sum) + 'đ')
        })
    </script>
    <!-- END: phụ phí -->
    <?php $__env->stopPush(); ?><?php /**PATH D:\xampp\htdocs\evox.local\resources\views/product/backend/purchases/create/surcharge.blade.php ENDPATH**/ ?>