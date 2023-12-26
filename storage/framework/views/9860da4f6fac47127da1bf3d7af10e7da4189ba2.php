
<?php $__env->startSection('content'); ?>
<div id="main" class="main-request-quote">
    <div class="breadcrumb py-[10px]" style="background-color: rgb(47, 47, 152, 1);">
        <div class="container mx-auto px-3">
            <ul class="flex flex-wrap text-white">
                <li class="pr-[5px]"><a href="<?php echo e(url('')); ?>" class="text-white">Trang chủ</a> /</li>
                <li class="text-white"><?php echo e($page->title); ?></li>
            </ul>
        </div>
    </div>
    <div class="content-request-quote my-[50px]">
        <div class="container mx-auto px-3">
            <div class="bg-gray-100 p-[30px] border border-gray-300">
                <h2 class="font-bold text-f24 "><?php echo e($page->title); ?></h2>
                <div class="flex flex-wrap justify-between -mx-3">
                    <div class="w-full md:w-1/2 px-3">
                        <form action="" id="file-upload">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-2 print-error-msg  mt-5" style="display: none">
                                <strong class="font-bold">ERROR!</strong>
                                <span class="block sm:inline"></span>
                            </div>
                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-2 print-success-msg mt-5" style="display: none">
                                <div class="flex items-center mb-">
                                    <div class="py-1">
                                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-bold"></span>
                                    </div>
                                </div>
                            </div>
                            <input type="file" class="my-[20px]">
                            <input type="text" placeholder="Họ và tên(*)" name="fullname" class="w-full h-[40px] border border-gray-200 mb-[15px] text-sm">
                            <input type="text" placeholder="Địa chỉ(*)" name="address" class="w-full h-[40px] border border-gray-200 mb-[15px] text-sm">
                            <div class="flex flex-wrap justify-between mx-[-5px]">
                                <div class="w-full md:w-1/2 px-[5px]">
                                    <input type="text" placeholder="Số điện thoại(*)" name="phone" class="w-full h-[40px] border border-gray-200 mb-[15px] text-sm">
                                </div>
                                <div class="w-full md:w-1/2 px-[5px]">
                                    <input type="text" placeholder="Email" name="email" class="w-full h-[40px] border border-gray-200 mb-[15px] text-sm">
                                </div>
                            </div>
                            <textarea name="message" id="" cols="30" rows="10" class="w-full h-[100px] border border-gray-200 mb-[15px] px-2 py-3 text-sm" placeholder="Ghi chú(*)"></textarea>
                            <div class="text-center">
                                <input type="submit" value="Gửi yêu cầu" class="px-[20px] h-[40px] leading-[40px] bg-ColorPrimary uppercase text-white borrder border-ColorPrimary hover:bg-white hover:text-ColorPrimary transition-all cursor-pointer">
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <div class="pt-[20px]">
                            <?php echo $page->description; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#file-upload').submit(function(e) {
        e.preventDefault();
        var formData = new FormData();
        var file_data = $('input[type="file"]')[0].files; // for multiple files
        for (var i = 0; i < file_data.length; i++) {
            formData.append("file", file_data[i]);
        }
        var other_data = $('#file-upload').serializeArray();
        $.each(other_data, function(key, input) {
            formData.append(input.name, input.value);
        });
        $.ajax({
            type: 'POST',
            url: "<?php echo e(route('contactFrontend.quote')); ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                if (data.status == 200) {
                    $("#file-upload .print-error-msg").css('display', 'none');
                    $("#file-upload .print-success-msg").css('display', 'block');
                    $("#file-upload .print-success-msg span").html("<?php echo $fcSystem['message_1'] ?>");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $("#file-upload .print-error-msg").css('display', 'block');
                    $("#file-upload .print-success-msg").css('display', 'none');
                    $("#file-upload .print-error-msg span").html(data.error);
                }
            },
            error: function(response) {
                $('#file-input-error').text(response.responseJSON.message);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/page/frontend/quote.blade.php ENDPATH**/ ?>