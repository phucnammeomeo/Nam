<?php
$data['homepage'] =  array(
    'label' => 'Thông tin chung',
    'description' => 'Cài đặt đầy đủ thông tin chung của website. Tên thương hiệu website. Logo của website và icon website trên tab trình duyệt',
    'value' => array(
        // 'brandname' => array('type' => 'text', 'label' => 'Tên thương hiệu'),
        // 'company' => array('type' => 'text', 'label' => 'Tên công ty'),
        'logo' => array('type' => 'images', 'label' => 'Logo'),
        'logo_footer_1' => array('type' => 'images', 'label' => 'Logo Menu Footer'),
        'logo_footer_2' => array('type' => 'images', 'label' => 'Logo Menu Footer'),
        'marquee' => array('type' => 'textarea', 'label' => 'Chữ chạy (Trang chủ)'),
        'favicon' => array('type' => 'images', 'label' => 'Favicon'),
        'copyright' => array('type' => 'textarea', 'label' => 'Copyright'),
        // 'aboutus' => array('type' => 'editor', 'label' => 'Giới thiệu footer'),
    ),
);
$data['contact'] =  array(
    'label' => 'Thông tin liên lạc',
    'description' => 'Cấu hình đầy đủ thông tin liên hệ giúp khách hàng dễ dàng tiếp cận với dịch vụ của bạn',
    'value' => array(
        'address' => array('type' => 'text', 'label' => 'Địa chỉ'),
        'hotline' => array('type' => 'text', 'label' => 'Hotline'),
        'hotline2' => array('type' => 'text', 'label' => 'Số điện thoại tư vấn'),
        // 'phone' => array('type' => 'text', 'label' => 'Số điện thoại'),
        'email' => array('type' => 'text', 'label' => 'Email'),
         'tglv' => array('type' => 'text', 'label' => 'Thời gian làm việc'),
        'map' => array('type' => 'textarea', 'label' => 'Bản đồ'),
        // 'website' => array('type' => 'text', 'label' => 'website'),

    ),
);
$data['seo'] =  array(
    'label' => 'Cấu hình thẻ tiêu đề',
    'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
    'value' => array(
        'meta_title' => array('type' => 'text', 'label' => 'Tiêu đề trang', 'extend' => ' trên 70 kí tự', 'class' => 'meta-title', 'id' => 'titleCount'),
        'meta_description' => array('type' => 'textarea', 'label' => 'Mô tả trang', 'extend' => ' trên 320 kí tự', 'class' => 'meta-description', 'id' => 'descriptionCount'),
        'meta_images' => array('type' => 'images', 'label' => 'Ảnh'),
    ),
);
$data['social'] =  array(
    'label' => 'Cấu hình mạng xã hội',
    'description' => 'Cài đặt đầy đủ Thẻ tiêu đề và thẻ mô tả giúp xác định cửa hàng của bạn xuất hiện trên công cụ tìm kiếm.',
    'value' => array(
        'facebook' => array('type' => 'text', 'label' => 'Link Facebook'),
        // 'tiktok' => array('type' => 'text', 'label' => 'Tiktok'),
        //       'facebookm' => array('type' => 'text', 'label' => 'Facebook message'),
        // 'instagram' => array('type' => 'text', 'label' => 'Instagram'),
        // 'twitter' => array('type' => 'text', 'label' => 'Twitter'),
        // 'google_plus' => array('type' => 'text', 'label' => 'Google plus'),
        // 'pinterest' => array('type' => 'text', 'label' => 'Pinterest'),
         'youtube' => array('type' => 'text', 'label' => 'Youtube'),
        // 'rss' => array('type' => 'text', 'label' => 'RSS'),
        // 'vimeo' => array('type' => 'text', 'label' => 'Vimeo'),
        //      'skype' => array('type' => 'text', 'label' => 'Skype'),
        'zalo' => array('type' => 'text', 'label' => 'Zalo'),
        // 'shopee' => array('type' => 'text', 'label' => 'Shopee'),
        // 'tiki' => array('type' => 'text', 'label' => 'Tiki'),
        // 'lazada' => array('type' => 'text', 'label' => 'Lazada'),
    ),
);

// $data['script'] =  array(
//     'label' => 'Script',
//     'description' => '',
//     'value' => array(
//         'header' => array('type' => 'textarea', 'label' => 'Script header'),
//         'footer' => array('type' => 'textarea', 'label' => 'Script footer'),
//     ),
// );
/*
$data['message'] =  array(
    'label' => 'Thông báo',
    'description' => '',
    'value' => array(
        '1' => array('type' => 'text', 'label' => 'Thông báo đăng kí email thành công'),
        '2' => array('type' => 'text', 'label' => 'Gửi thông tin liên hệ thành công'),
    ),
);
*/
$data['title'] =  array(
    'label' => 'Tiêu đề',
    'description' => '',
    'value' => array(
         '1' => array('type' => 'text', 'label' => 'Tiêu đề tìm kiếm'),
        // '2' => array('type' => 'text', 'label' => 'TIÊU ĐỀ SẢN PHẨM 2'),
        // '3' => array('type' => 'text', 'label' => 'TIÊU ĐỀ SẢN PHẨM 3'),
        // '4' => array('type' => 'text', 'label' => 'TIÊU ĐỀ TIN TỨC '),
        //'5' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( thông tin liên kết ) '),
        //'6' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( thông tin liên hệ )'),
//        '7' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( thông tin email ) '),
//        '8' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( liên hệ hotline ) '),
//        '9' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER '),
//        '10' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER '),
//        '11' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER '),
//        '12' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER '),
//        '13' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER '),
//        '14' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( thông tin thành viên )'),
//        '15' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( liên hệ số cá nhân )'),
//        '16' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( liên hệ email )'),
//        '17' => array('type' => 'text', 'label' => 'TIÊU ĐỀ MENU FOOTER ( liên hệ địa chỉ )'),
    ),
);
// $data['banner'] =  array(
//     'label' => 'Banner',
//     'description' => '',
//     'value' => array(
//         '3' => array('type' => 'images', 'label' => 'Banner default Blog'),
//     ),
// );
$data['cart'] =  array(
    'label' => 'Đơn hàng',
    'description' => '',
    'value' => array(
        '1' => array('type' => 'editor', 'label' => 'Đặt hàng thành công'),        
    ),
);
// $data['404'] =  array(
//     'label' => '404',
//     'description' => '',
//     'value' => array(
//         '1' => array('type' => 'text', 'label' => 'Tiêu đề'),
//         '3' => array('type' => 'textarea', 'label' => 'Mô tả'),
//         '4' => array('type' => 'textarea', 'label' => 'Chi tiết'),
//         '2' => array('type' => 'images', 'label' => 'Background image'),
//     ),
// );
return $data;
