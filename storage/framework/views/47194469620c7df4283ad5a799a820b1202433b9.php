<?php $__env->startSection('content'); ?>

<div class="content-new-detail mt-[30px] bg-white p-[10px]">
    <h1 class="text-f20 font-bold">
        <?php echo e($detail->title); ?>

    </h1>
    <p class="date text-gray-600 my-[10px]">
      Ngày đăng: <?php echo \Carbon\Carbon::parse($detail->created_at)->format('d'); ?> - <?php echo \Carbon\Carbon::parse($detail->created_at)->format('m'); ?> - <?php echo \Carbon\Carbon::parse($detail->created_at)->format('Y'); ?>
    </p>
    <div class="content-content">
      <p>
        <?php echo $detail->content ?>
      </p>

    </div>
    <div class="other-new pt-[30px]">
      <div class="title-title bg-Pimary_color py-[8px] px-[15px]">
        <a href="" class="text-white font-bold">BÀI VIẾT LIÊN QUAN</a>
      </div>
      <div class="slider-new owl-carousel mt-[20px]">
        <?php $__currentLoopData = $sameArticle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div
          class="item border border-gray-300 mb-[15px] md:mb-[20px]"
        >
          <div class="img hover-zoom">
            <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>">
              <img
                src="<?php echo e(getImageUrl('articles', $item['image'], 'small')); ?>"
                alt="<?php echo e($item->title); ?>"
                class="w-full object-cover"
              />
            </a>
          </div>
          <div class="p-[15px]">
            <h3
              class="text-f15 font-bold overflow-hidden"
              style="
                text-overflow: ellipsis;
                line-height: 20px;
                -webkit-line-clamp: 2;
                height: 40px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
              "
            >
              <a href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>" class="hover:text-Pimary_color transition-all">
                <?php echo e($item->title); ?></a
              >
            </h3>
            <ul
              class="admin-date flex flex-wrap text-gray-500 my-[10px]"
            >
            <?php if(!empty($detail->user->name)): ?>
              <li class="mr-[10px]">
                <span class="mr-[5px]"
                  ><i class="fa-solid fa-user"></i></span
                ><?php echo e($detail->user->name); ?>

              </li>
            <?php endif; ?>

              <li>
                <span class="mr-[5px]"
                  ><i class="fa-solid fa-calendar-days"></i></span
                ><?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('M')); ?> <?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('d')); ?>, <?php echo e(\Carbon\Carbon::parse($item['created_at'])->format('Y')); ?>

              </li>
            </ul>
            <div
              class="article-desc overflow-hidden"
              style="
                text-overflow: ellipsis;
                line-height: 20px;
                -webkit-line-clamp: 3;
                height: 60px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
              "
            >
                <?php echo $item->description ?>
        </div>
            <a
              href="<?php echo e(route('routerURL',['slug' => $item->slug])); ?>"
              class="readmore bg-Pimary_color py-[6px] px-[13px] text-white rounded-[5px] mt-[10px] inline-block border border-Pimary_color transition-all hover:text-Pimary_color hover:bg-white"
              >Xem thêm<i
                class="fa-solid fa-angles-right text-f10 ml-[5px]"
              ></i
            ></a>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    </div>

  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('javascript'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>
    <style type="text/css">
        .content-content img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: auto !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('homepage.layout.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/khangdien2/domains/agri-raw.com/public_html/resources/views/article/frontend/article/index.blade.php ENDPATH**/ ?>