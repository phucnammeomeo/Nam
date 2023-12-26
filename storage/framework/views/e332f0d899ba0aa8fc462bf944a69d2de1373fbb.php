<?php $__env->startSection('content'); ?>
<main class="py-8 bg-white">
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-center">
            <div class="w-[580px] max-w-full bg-[#f4f6f8] p-6 rounded-xl" style="border: solid 1px orange">
                <div class="text-center py-[10px] text-f25 mb-10 font-bold ">
                    <h1 class="text-Pimary_color">ĐĂNG KÍ TÀI KHOẢN CỦA BẠN</h1>
                </div>

                <div class="flex mb-10">
                    <div class="w-1/2 text-center" style="border-right: solid 1px">
                        <a href="<?php echo e(route('customer.login')); ?>" class="font-bold uppercase h-[50px] leading-[50px]  float-left w-full" style="text-decoration: revert"><?php echo e(trans('index.Login')); ?></a>
                    </div>
                    <div class="w-1/2 text-center">
                        <a href="<?php echo e(route('customer.register')); ?>" class="font-semibold uppercase h-[50px] leading-[50px] float-left w-full " style="text-decoration: revert"><?php echo e(trans('index.Register')); ?></a>
                    </div>
                </div>
                <div class="text-center py-[10px] text-f14">
                    <?php echo e(trans('index.PleaseInfoRegister')); ?> <?php echo e($fcSystem['homepage_brandname']); ?>

                </div>
                <form action="<?php echo e(route('customer.register-store')); ?>" method="POST" id="form-auth">
                    <?php echo csrf_field(); ?>
                    <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissable mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>Success!</b> <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">ERROR!</strong>
                        <span class="block sm:inline">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($error); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                    </div>
                    <?php endif; ?>
                    <div class="mt-2">
                        <label class="font-bold text-f14"><?php echo e(trans('index.Fullname')); ?><span class="text-f13 text-red-600">*</span></label>
                        <input type="text" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="name" aria-describedby="emailHelp" placeholder="" value="<?php echo e(old('name')); ?>">
                    </div>
                    <div class="mt-5">
                        <label class="font-bold text-f14"><?php echo e(trans('index.Phone')); ?><span class="text-f13 text-red-600">*</span></label>
                        <input type="text" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="phone" aria-describedby="emailHelp" placeholder="" value="<?php echo e(old('phone')); ?>">
                    </div>
                    <div class="mt-5">
                        <label class="font-bold text-f14">Email<span class="text-f13 text-red-600">*</span></label>
                        <input type="text" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="email" aria-describedby="emailHelp" placeholder="" value="<?php echo e(old('email')); ?>">
                    </div>
                    <div class="mt-5">
                        <label class="font-bold text-f14"><?php echo e(trans('index.Password')); ?><span class="text-f13 text-red-600">*</span></label>
                        <input type="password" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="password" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="mt-5">
                        <label class="font-bold text-f14"><?php echo e(trans('index.EnterPassword')); ?><span class="text-f13 text-red-600">*</span></label>
                        <input type="password" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="confirm_password" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="mt-5 flex justify-center">
                        <button type="submit" class="bg-Pimary_color btn-submit-contact py-4 px-1 md:px-8 rounded-lg block bg-[#3bb77e]  text-white transition-all leading-none text-f15 font-bold" style="width: 50%"> <?php echo e(trans('index.Register')); ?></button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/customer/frontend/auth/register.blade.php ENDPATH**/ ?>