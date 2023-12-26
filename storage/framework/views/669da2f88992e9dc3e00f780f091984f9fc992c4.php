<div id="main" class="sitemap">
    <div class="main-content">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-5px]">
                <?php echo $__env->make('homepage.common.menuProduct', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="w-full lg:w-4/5 px-[5px]">
                    <div class="content-right">

                        <?php echo $__env->make('homepage.common.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('homepage.common.slide', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->yieldContent('content'); ?>

                        <footer class="footer bg-white mt-0 md:mt-[30px]">
                            <div class="top-footer p-[10px] border-b border-gray-100">
                                <div class="flex flex-wrap justify-between mx-[-10px] items-center">
                                    <div class="w-full md:w-1/2 px-[10px] mb-[10px] md:mb-0">
                                        <p class="flex flex-wrap">
                                            <span class=""><img src="<?php echo e(asset('assets/img/icon-1.png')); ?>"
                                                    alt="" />
                                            </span>
                                            <span class="pl-[10px]">Đặt online <strong>giao tận nhà ĐÚNG GIỜ</strong>
                                                <br />
                                                (nếu trễ tặng PMH 50.000₫)</span>
                                        </p>
                                    </div>
                                    <div class="w-full md:w-1/2 px-[10px]">
                                        <p class="flex flex-wrap">
                                            <span class=""><img src="<?php echo e(asset('assets/img/iocn-2.png')); ?>"
                                                    alt="" />
                                            </span>
                                            <span class="pl-[10px]">Đổi, trả sản phẩm <strong>trong 7 ngày</strong>
                                                <br />
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="content-footer p-[10px]">
                                <div class="flex flex-wrap justify-between mx-[-10px]">
                                    <div class="w-full md:w-1/2 px-[10px]">
                                        <p class="phone text-Pimary_color font-bold">
                                            <i class="fa-solid fa-phone mr-[5px]"></i>Tổng đài:
                                            1900.1908 - 028.3622.9900 (7:00 - 21:30)
                                        </p>
                                        <div class="flex flex-wrap justify-between mx-[-5px] mt-[10px]">
                                            <div class="w-1/2 md:w-1/3 px-[5px]">
                                                <ul>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Quy chế hoạt động</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hướng dẫn mua hàng</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hóa đơn điện tử</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Quy chế hoạt động</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hướng dẫn mua hàng</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hóa đơn điện tử</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="w-1/2 md:w-1/3 px-[5px]">
                                                <ul>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Quy chế hoạt động</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hướng dẫn mua hàng</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hóa đơn điện tử</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Quy chế hoạt động</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hướng dẫn mua hàng</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hóa đơn điện tử</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="w-1/2 md:w-1/3 px-[5px]">
                                                <ul>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Quy chế hoạt động</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hướng dẫn mua hàng</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hóa đơn điện tử</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Quy chế hoạt động</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hướng dẫn mua hàng</a>
                                                    </li>
                                                    <li class="text-f15 text-gray-700 mb-[7px]">
                                                        <a href="">Hóa đơn điện tử</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full md:w-1/2 px-[10px] mt-[10px] md:mt-0">
                                        <h3 class="text-f16 font-bold uppercase mb-[7px]">
                                            Công ty trách nhiệm cổ phần việt nam
                                        </h3>
                                        <p class="mb-[5px]">
                                            <i class="fa-solid fa-location-dot mr-[5px]"></i>Số
                                            38, Ngõ 6 , Vĩnh phúc, Ba Đình, Hà Nội
                                        </p>
                                        <p>
                                            <i class="fa-solid fa-phone mr-[5px]"></i>0987 098
                                            8786 - 0987 098 789
                                        </p>
                                        <h4 class="text-f15 font-bold mt-[10px]">
                                            Hãy điền email nhận thông tin từ chúng tôi để k bỏ lỡ
                                            bất kỳ khuyến mãi hoặc tin tức nóng nhất
                                        </h4>
                                        <form action="" class="relative mt-[10px]">
                                            <input type="text" placeholder="Thông tin của bạn"
                                                class="w-full h-[40px] border border-gray-200 rounded-[5px] text-f15 bg-gray-50" />
                                            <button class="absolute top-[7px] right-[10px]">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </form>
                                        <ul class="flex flex-wrap mt-[10px]">
                                            <li class="mr-[5px]">
                                                <a href=""><img
                                                        src="<?php echo e(asset('assets/img/icon-2.png')); ?>" /></a>
                                            </li>
                                            <li>
                                                <a href=""><img
                                                        src="<?php echo e(asset('assets/img/icon-3.png')); ?>" /></a>
                                            </li>
                                        </ul>
                                        <div class="img mt-[10px]">
                                            <img src="<?php echo e(asset('assets/img/handle_cert.png')); ?>"
                                                style="width: 150px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </footer>

                        <div class="copy-right bg-gray-200 p-[10px] text-center">
                            <p class="text-f13">
                                © 2018. Công Ty Cổ Phần Thương Mại Bách Hoá Xanh. GPDKKD:
                                0310471746 do sở KH & ĐT TP.HCM cấp ngày 23/11/2010. Giấy
                                phép thiết lập mạng xã hội trên mạng (Số 20/GP-BTTTT) do Bộ
                                Thông Tin Và Truyền Thông cấp ngày 11/01/2021. Trụ sở chính:
                                128 Trần Quang Khải, P.Tân Định, Quận.1, TP.HCM. Địa chỉ
                                liên hệ: Toà nhà MWG, Lô T2-1.2, Đường D1, Khu Công Nghệ
                                Cao, P. Tân Phú, TP.Thủ Đức, TP.HCM.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\khangdien\resources\views/homepage/common/bodymain.blade.php ENDPATH**/ ?>