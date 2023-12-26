<?php $__env->startSection('content'); ?>
<main class="py-8 bg-white">
    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-center">
            <div class="w-[580px] max-w-full bg-[#f4f6f8] p-6 rounded-xl " style="border: solid 1px orange">

                <div class="text-center py-[10px] text-f25 mb-10 font-bold ">
                    <h1 class="text-Pimary_color">ĐĂNG NHẬP ĐỂ THEO DÕI ĐƠN HÀNG CỦA BẠN</h1>
                </div>

                <div class="flex mb-10">
                    <div class="w-1/2 text-center" style="border-right: solid 1px">
                        <a href="<?php echo e(route('customer.login')); ?>" class="font-bold uppercase h-[50px] leading-[50px]  float-left w-full" style="text-decoration: revert"><?php echo e(trans('index.Login')); ?></a>
                    </div>
                    <div class="w-1/2 text-center">
                        <a href="<?php echo e(route('customer.register')); ?>" class="font-semibold uppercase h-[50px] leading-[50px] float-left w-full " style="text-decoration: revert"><?php echo e(trans('index.Register')); ?></a>
                    </div>
                </div>
                <form action="<?php echo e(route('customer.login-store')); ?>" method="POST" id="form-auth">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <?php if(session('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700-700 px-4 py-3 rounded relative mt-2" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">
                            <?php echo e(session('success')); ?>

                        </span>
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
                        <label class="font-bold text-f14">Email <?php echo e(trans('index.OR')); ?> <?php echo e(trans('index.Phone')); ?><span class="text-f13 text-red-600">*</span></label>
                        <input type="text" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="email" value="<?php echo e(old('email')); ?>" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="mt-5">
                        <label class="font-bold text-f14"><?php echo e(trans('index.Password')); ?><span class="text-f13 text-red-600">*</span></label>
                        <input type="password" class="  border w-full h-11 px-3 focus:outline-none focus:ring focus:ring-red-300  hover:outline-none hover:ring hover:ring-red-300  rounded-lg" name="password" aria-describedby="emailHelp" placeholder="">
                    </div>
                    <div class="flex mt-5 justify-end">
                        <a href="<?php echo e(route('customer.reset-password')); ?>" class="text-[#3bb77e] font-bold" title="<?php echo e(trans('index.ForgotPassword')); ?>?"><?php echo e(trans('index.ForgotPassword')); ?>?</a>
                    </div>
                    <div class="mt-5 flex justify-center ">
                        <button type="submit" class=" bg-Pimary_color btn-submit-contact py-4 px-1 md:px-8 rounded-lg block bg-[#3bb77e]  text-white transition-all leading-none text-f15 font-bold  w-full"> <?php echo e(trans('index.Login')); ?></button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/customer/frontend/auth/login.blade.php ENDPATH**/ ?>