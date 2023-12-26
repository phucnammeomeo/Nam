<?php
    $menu_header = getMenus('menu-header');
?>

<header class="block md:hidden header-mobile">
    <div class="relative flex justify-center px-2 py-[10px] header-22">
      <style>
        /* Micro Clearfix */
        .cf:before,
        .cf:after {
          content: "";
          display: table;
          visibility: hidden;
        }
        .cf:after {
          clear: both;
        }
        .cf {
          *zoom: 1;
        }
        .wrap {
          text-align: center;
        }

        .menu li {
          float: left;
          margin-right: 10px;
          position: relative;
        }
        .menu li:last-child {
          margin-right: 0;
        }
        .menu .sub-menu li {
          width: 100%;
        }
        .menu li a {
          display: block;
          text-decoration: none;
        }
        #top-nav li a {
          color: rgba(51, 51, 51, 0.9);
          padding: 5px 0;
        }
        #top-nav .sub-menu {
          background: #fff;
        }
        #top-nav .sub-menu li a {
          padding: 5px;
        }
        #top-nav .sub-menu li > a:hover,
        #top-nav .sub-menu li.selected > a {
          background: #000f1d;
          color: #fff;
        }
        #primary-nav li a {
          color: #fff;
          padding: 10px;
        }
        #primary-nav li.active > a,
        #primary-nav li > a:hover,
        #primary-nav li.selected > a {
          background: #000f1d;
          color: #fff;
        }
        .downarrow {
          background: none;
          display: inline-block;
          padding: 0;
          text-align: center;
          min-width: 3px;
        }
        .sub-menu .downarrow {
          position: absolute;
          right: 0;
          padding-right: 10px;
        }
        .downarrow:before {
          content: "\25be";
          color: inherit;
          display: block;
          font-family: sans-serif;
          font-size: 1em;
          line-height: 1.1;
          width: 1em;
          height: 1em;
        }
        .menu .sub-menu {
          display: none;
          position: absolute;
          left: 0;
          max-height: 1000px;
        }
        .menu .sub-menu.hide {
          display: none;
        }
        #primary-nav .sub-menu {
          background: #000f1d;
          min-width: 150px;
          z-index: 200;
        }
        #primary-nav.mobile ul {
          width: 100%;
        }
        #primary-nav .sub-menu li {
          border-bottom: 1px solid rgba(51, 51, 51, 0.9);
        }
        #primary-nav .sub-menu li:last-child {
          border-bottom: 0;
        }
        #primary-nav .sub-menu .downarrow:before {
          content: "\25b8";
        }
        #primary-nav.mobile {
          display: none;
          position: absolute;
          top: 100%;
          background: #000f1d;
          width: 100%;
          z-index: 999;
        }
        #primary-nav.mobile li {
          width: 100%;
          margin: 0;
          border-bottom: 1px solid rgba(51, 51, 51, 0.9);
        }
        #primary-nav.mobile li.selected > a {
          border-bottom: 1px solid rgba(51, 51, 51, 0.9);
        }
        #primary-nav.mobile li:last-child {
          border: none;
        }
        #primary-nav.mobile li a {
          padding: 5%;
        }
        #primary-nav.mobile .sub-menu li a {
          padding-left: 7%;
        }
        #primary-nav.mobile .sub-menu .submenu li a {
          padding-left: 9%;
        }
        #primary-nav.mobile .sub-menu .sub-menu .sub-menu li a {
          padding-left: 11%;
        }
        #primary-nav.mobile .sub-menu {
          float: left;
          position: relative;
          width: 100%;
        }
        .mobile .downarrow,
        .mobile .sub-menu .downarrow {
          position: absolute;
          right: 0;
          padding-right: 5%;
        }
        #primary-nav.mobile .sub-menu .downarrow:before {
          content: "\25be";
        }
        #primary-nav-button.mobile {
          display: inline-block;
        }
      </style>

      <div class="w-full text-center">
        <button
          id="primary-nav-button"
          type="button"
          class="mobile float-right mt-[13px]"
        >
          <span><i class="fa-solid fa-bars"></i></span>
        </button>
        <a href="/" class="logo"
          ><img src="<?php echo e(asset($fcSystem['homepage_logo'])); ?>" alt="" class="inline-block"
        /></a>
      </div>
      <div class="absolute top-0 right-[10px]">
        <div class="right-header">
          <ul class="flex lg:flex-grow space-x-4 float-right">
            <li class="relative">
              <a class="cursor-pointer click-search">
                <img src="<?php echo e(asset('assets/img/LOGO/search.png')); ?>" alt="" class="w-[25px]" />
              </a>
              <div
                class="nav-search absolute top-[33px] right-0"
                style="display: none"
              >
                <form action="" class="relative">
                  <input type="text" placeholder="Tìm kiếm" />
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <nav id="primary-nav" class="dropdown cf mobile" style="display: none">
        <?php if(count($menu_header->menu_items) > 0): ?>
            <ul class="dropdown menu">
                <?php $__currentLoopData = $menu_header->menu_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="<?php echo e(url($item->slug)); ?>"><?php echo e($item->title); ?></a>

                        <?php if(count($item->children) > 0): ?>
                        <span class="downarrow"></span>
                        <ul class="sub-menu">
                            <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : ''; ?>
                                    <li style="margin-left: 30px">
                                        <a href="<?php echo e(url($item2->slug)); ?>"
                                            <?php echo $_blank_2; ?>><?php echo e($item2->title); ?>

                                        </a>
                                    </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>
      </nav>
      <!-- / #primary-nav -->
    </div>
  </header>
<?php /**PATH /home/khangdien2/domains/khangdien.tamphat.edu.vn/public_html/resources/views/homepage/common/menuMobile.blade.php ENDPATH**/ ?>