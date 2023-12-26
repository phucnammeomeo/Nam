
<?php $__env->startSection('content'); ?>
<?php
function loadHtmlMPage($data = [], $title = '', $name = '')
{
    $html = '';
    if (!empty($data)) {
        $html .= '<tr class="chat-lieu">
                        <td class="col-left text-f16">' . $title . '</td>
                        <td class="col-right">
                            <div class="flex flex-wrap justify-start">';
        foreach ($data as $key => $item) {
            $active = '';
            $checked = '';
            if ($key == 0) {
                $active = 't-active';
                $checked = 'checked';
            }
            $html .= '<label for="' . $name . '.' . slug($item) . '-' . $key . '" class="handleChecked input-btn ' . $active . '">' . $item . '</label><input id="' . $name . '.' . slug($item) . '-' . $key . '" type="radio" value="' . $item . '" name="' . $name . '" class="hidden" ' . $checked . '>';
        }
        $html .= '</div>
                        </td>
                    </tr>';
    }
    return $html;
}
?>
<?php
$jsonData = $page->postmetasMany;
$data = [];
if (!empty($jsonData)) {
    foreach ($jsonData as $item) {
        $json = json_decode($item->meta_value, TRUE);
        if (!empty($json)) {
            if ($item->meta_key == 'config_colums_json_color_board') {
                $data[$item->meta_key] = $item->meta_value;
            } else {
                $data[$item->meta_key] = $json['title'];
            }
        }
    }
}
?>
<form id="file-upload">
    <div id="main" class="main-request-quote">
        <div class="breadcrumb py-[10px]" style="background-color: rgb(47, 47, 152, 1);">
            <div class="container mx-auto px-3">
                <ul class="flex flex-wrap text-white">
                    <li class="pr-[5px]"><a href="<?php echo e(url('')); ?>" class="text-white">Trang chủ</a> /</li>
                    <li class="text-white"><?php echo e($page->title); ?></li>
                </ul>
            </div>
        </div>
        <div class="content-machining my-[30px] md:my-[50px]">
            <div class="container mx-auto px-3">
                <div class="bg-gray-100 p-[10px] md:p-[30px] border border-gray-300">
                    <h2 class="font-bold text-f24 mb-[15px]">Thông tin liên hệ</h2>
                    <div>
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
                    </div>
                    <div class="flex flex-wrap justify-between -mx-3">


                        <div class="w-full md:w-1/2 px-3">

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
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <div class="pt-[20px] md:pt-0">
                                <?php echo $page->description; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="yckt pb-[30px]">
            <div class="container mx-auto px-3">
                <table class="w-full">
                    <tbody>
                        <tr class="up-file">
                            <td colspan="2">
                                <h2 class="text-ColorPrimary text-f25 font-bold mb-[10px]">Yêu cầu kỹ thuật</h2>
                                <p> <input type="file">
                                </p>
                            </td>
                        </tr>
                        <?php if(!empty($data) && !empty($data['config_colums_json_chatlieu'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_chatlieu'], 'Chất liệu', 'chatlieu'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_solop'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_solop'], 'Số lớp', 'solop'); ?>
                        <?php endif; ?>

                        <tr>
                            <td class="col-left  text-f16">Kích thước</td>
                            <td class="col-right">
                                <div class="flex flex-wrap justify-start">
                                    <input type="number" value="100" placeholder="100" class="kt-1" min="0" name="kichthuoc[1]"><br>
                                    <span>*</span><br>
                                    <input type="number" value="100" placeholder="100" class="kt-2" min="0" name="kichthuoc[2]"><br>
                                    <select id="kt-dv" name="kichthuoc[3]">
                                        <?php if(!empty($data) && !empty($data['config_colums_json_kichthuoc'])): ?>
                                        <?php $__currentLoopData = $data['config_colums_json_kichthuoc']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item); ?>"><?php echo e($item); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-left text-f16">Số lượng</td>
                            <td class="col-right flex flex-wrap justify-start">
                                <input type="number" placeholder="0" class="sl-number" min="0" value="5" name="soluong">
                            </td>
                        </tr>
                        <?php if(!empty($data) && !empty($data['config_colums_json_mach'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_mach'], 'Loại mạch khác', 'loaimachkhac'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_pcb'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_pcb'], 'Ghép PCB', 'pcb'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_doday'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_doday'], 'Độ dày', 'doday'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_color_board'])): ?>
                        <?php
                        $color_board = json_decode($data['config_colums_json_color_board'], TRUE);
                        ?>
                        <tr class="">
                            <td class="col-left text-f16 ">Màu board</td>
                            <td class="col-right">
                                <div class="flex flex-wrap justify-start">
                                    <?php $__currentLoopData = $color_board['title']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="input-btn <?php if($key==0): ?> t-active <?php endif; ?> flex items-center space-x-2 handleChecked" for="color_board_<?php echo e($key); ?>">
                                        <span class="w-[15px] h-[15px] rounded-full" style="background: <?php echo e($color_board['color'][$key]); ?>;"> </span>
                                        <span><?php echo e($item); ?></span>
                                    </label>
                                    <input type="radio" class="hidden" name="colorboard" value="<?php echo e($item); ?>" id="color_board_<?php echo e($key); ?>" <?php if($key==0): ?> checked <?php endif; ?>>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php if(!empty($data) && !empty($data['config_colums_json_mauchu'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_mauchu'], 'Màu chữ', 'mauchu'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_kieuma'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_kieuma'], 'Kiểu mạ', 'kieuma'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_dodaydong'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_dodaydong'], 'Độ dày đồng', 'dodaydong'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_thoigian'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_thoigian'], 'Thời gian', 'thoigian'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_hanlinhkien'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_hanlinhkien'], 'Hàn linh kiện', 'hanlinhkien'); ?>
                        <?php endif; ?>
                        <?php if(!empty($data) && !empty($data['config_colums_json_stencil'])): ?>
                        <?php echo loadHtmlMPage($data['config_colums_json_hanlinhkien'], 'Đặt stencil', 'stencil'); ?>
                        <?php endif; ?>

                        <tr>
                            <td class="col-left text-f16">Ghi chú</td>
                            <td class="col-right">
                                <div><textarea cols="40" rows="10" class="w-full h-[100px] border border-gray-200" name="message"></textarea></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center mt-[20px]">
                    <button class="px-[20px] h-[40px] leading-[40px] bg-ColorPrimary uppercase text-white borrder border-ColorPrimary transition-all">Gửi yêu cầu</button>
                </div>
            </div>

        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<script>
    $(document).on('click', '.handleChecked', function(e) {
        $(this).parent().find('.handleChecked').removeClass('t-active')
        $(this).addClass('t-active')
    })
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
            url: "<?php echo e(route('contactFrontend.machining')); ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                if (data.status == 200) {
                    $("#file-upload .print-error-msg").css('display', 'none');
                    $("#file-upload .print-success-msg").css('display', 'block');
                    $("#file-upload .print-success-msg span").html("<?php echo $fcSystem['message_4'] ?>");
                    $('html, body').animate({
                        scrollTop: $("#main").offset().top
                    }, 600);
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                } else {
                    $("#file-upload .print-error-msg").css('display', 'block');
                    $("#file-upload .print-success-msg").css('display', 'none');
                    $("#file-upload .print-error-msg span").html(data.error);
                    $('html, body').animate({
                        scrollTop: $("#main").offset().top
                    }, 600);
                }
            },
            error: function(response) {
                $('#file-input-error').text(response.responseJSON.message);
            }
        });
    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\food.local\resources\views/page/frontend/machining.blade.php ENDPATH**/ ?>