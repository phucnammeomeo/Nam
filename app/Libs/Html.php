<?php

if (!function_exists('svl_ismobile')) {

    function svl_ismobile()
    {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
        );

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }

        if ($tablet_browser > 0) {
            // do something for tablet devices
            return 'is tablet';
        } else if ($mobile_browser > 0) {
            // do something for mobile devices
            return 'is mobile';
        } else {
            // do something for everything else
            return 'is desktop';
        }
    }
}
if (!function_exists('getImageUrl')) {
    function getImageUrl($module = '', $src = '', $type = '')
    {
        $path = '';
        $dir = explode("/", $src);
        $file = collect($dir)->last();
        if (svl_ismobile() == 'is mobile') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is tablet') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is desktop') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else {
            $path = $src;
        }
        if (File::exists(base_path($path))) {
            $path = $path;
        } else {
            $path = $src;
        }
        return asset($path);
    }
}
if (!function_exists('getFunctions')) {
    function getFunctions()
    {
        $data = [];
        $getFunctions = \App\Models\Permission::select('title')->where('publish', 0)->where('parent_id', 0)->get()->pluck('title');
        if (!$getFunctions->isEmpty()) {

            foreach ($getFunctions as $v) {
                $data[] = $v;
            }
        }
        return $data;
    }
}
if (!function_exists('htmlArticle')) {
    function htmlArticle($item = [], $viewed = 'lượt xem')
    {
        $html = '';
        $html .= '<div class="md:flex space-x-0 md:space-x-8 ">
        <div class="w-full md:w-[220px] overflow-hidden">
            <a href="' . route('routerURL', ['slug' => $item->slug]) . '">
                <img src="' . asset($item->image) . '" alt="' . $item->title . '"
                    class="w-full h-[223px] md:h-[160px] object-cover">
            </a>
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-base text-c8252c mt-2 md:mt-0">
                <a href="' . route('routerURL', ['slug' => $item->slug]) . '"
                    class="hover:text-d61c1f">' . $item->title . '
                </a>
            </h3>
            <div class="flex items-center space-x-5 my-1">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
                    <span>
                        ' . $item->created_at . '
                    </span>

                </div>
                <div class="flex items-center space-x-1">


                </div>

            </div>
            <div class="line-clamp line-clamp-3">
                ' . $item->description . '
</div>
</div>
</div>';
        return $html;
    }
}
if (!function_exists('htmlAddress')) {
    function htmlAddress($data = [])
    {
        $html = '';
        if (isset($data)) {
            foreach ($data as $k => $v) {
                $html .= ' <li class="showroom-item loc_link result-item" data-brand="' . $v->title . '"
    data-address="' . $v->address . '" data-phone="' . $v->hotline . '" data-lat="' . $v->lat . '"
    data-long="' . $v->long . '">
    <div class="heading" style="display: flex">

        <p class="name-label" style="flex: 1">
            <strong>' . ($k + 1) . '. ' . $v->title . '</strong>
        </p>
    </div>
    <div class="details">
        <p class="address" style="flex:1"><em>' . $v->address . '</em>
        </p>

        <p class="button-desktop button-view hidden-xs">
            <a href="javascript:void(0)" onclick="return false;">Tìm đường</a>
            <a class="arrow-right"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
        <p class="button-mobile button-view visible-xs">
            <a target="_blank" href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '">Tìm đường</a>
            <a class="arrow-right" target="_blank"
                href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '"><span><i
                        class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
    </div>
</li>';
            }
        }
        return $html;
    }
}

/**HTML: item sản phẩm */
if (!function_exists('htmlProduct')) {
    function htmlProduct($key = '', $item = [], $class = 'group product-item bg-white rounded-2xl shadowC hover-box')
    {
        $html = '';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
            $item['price_contact']));
        $image = getImageUrl('products', $item['image'], 'large');
        // $countCmt = $item->comments->count();
        // $sumCmt = $item->comments->sum('rating');
        // $star = 0;

        // if (!empty($countCmt)) {
        //     $star = $sumCmt / $countCmt;
        // }
        $html .= '<div class="img hover-zoom">

                    <a href="' . route('routerURL', ['slug' => $item['slug']]) . '" tabindex="-1">
                        <img class="w-full object-cover" src="' . asset($image) . '" alt="' . $item['title'] . '"height="225">
                    </a>
                 </div>';


        // if ($item['isaside'] == 0) {
        //     $html .= '<div class="flash"><span class="onnew"><span class="text">New</span></span></div>';
        // }
        $html .= ' <div class="nav-img mt-[10px]">
                        <h3
                        class="font-bold"
                        style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            line-height: 22px;
                            -webkit-line-clamp: 2;
                            height: 44px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;
                        "
                        >
                            <a class="hover:text-Pimary_color transition-all"
                                href="' . route('routerURL', ['slug' => $item['slug']]) . '" tabindex="-1">' . $item['title'] . '</a>
                        </h3>';

        // Có giá khuyến mãi:
        if (!empty($price['price_old'])) {
            $html .= '<p class="price text-f15 mt-[10px] mb-[10px]">
                        <span class="text-red font-bold">' . $price['price_final'] . '</span>
                        <del class="pl-[10px] text-gray-500">' . $price['price_old'] . '</del>
                      </p>
                            <a
                                href="' . route('routerURL', ['slug' => $item['slug']]) . '" data-title="' . $item['title'] . '" data-id="' . $item['id'] . '"
                                class="add-cart border border-Pimary_color w-full py-[6px] inline-block text-center text-Pimary_color rounded-[5px] transition-all hover:bg-Pimary_color hover:text-white"
                                >Chọn mua
                            </a>
                    </div>';
        }

        // Không có giá khuyến mãi:
        if (empty($price['price_old'])) {
            $html .= '<p class="price text-f15 mt-[10px] mb-[10px]">
                        <span class="text-red font-bold">' . $price['price_final'] . '</span>
                      </p>
                            <a
                                href="' . route('routerURL', ['slug' => $item['slug']]) . '" data-title="' . $item['title'] . '" data-id="' . $item['id'] . '"
                                class="add-cart border border-Pimary_color w-full py-[6px] inline-block text-center text-Pimary_color rounded-[5px] transition-all hover:bg-Pimary_color hover:text-white"
                                >Chọn mua</a
                            >
                    </div>';
        }
        return $html;
    }
}

if (!function_exists('htmlItemProduct')) {
    function htmlItemProduct($item = [], $check = [])
    {
        $html = '';
        $percent = '';
        $type = 'simple';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
            $item['price_contact']));
        $image = getImageUrl('products', $item['image'], 'large');
        $title = $item['title'];
        $dvt = $item['unit'];
        $url = route('routerURL', ['slug' => $item['slug']]);
        if ($price['percent'] != '') {
            $percent = '<span class="bg-Pimary_color text-white py-[2px] px-[6px] inline-block absolute top-[10px] left-[10px] rounded-[5px] text-f13">-' . $price['percent'] . '</span>';
        }
        if( !$item->product_versions->isEmpty() ){
            $type = 'variable';
        }
        $html .= '<div class="item p-[10px] mb-[15px] product-item">
                    <div class="img hover-zoom relative">
                        <a href="' . $url . '" title="' . $title . '">
                            <img src="' . asset($image) . '" alt="" class="w-full flying-image object-contain" style="height: 180px">
                        </a>
                        ' . $percent . '
                    </div>
                    <div class="nav-img mt-[10px]">
                        <h3 class="text-f14" style="
                    overflow: hidden;
                    text-overflow: ellipsis;
                    line-height: 23px;
                    -webkit-line-clamp: 1;
                    height: 23px;
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    ">
                            <a href="' . $url . '" title="' . $title . '" class="hover:text-Pimary_color transition-all">' . $title . '</a>
                        </h3>
                        <p class="dvt text-f14" style="'.($dvt==''?'opacity:0':'').'">ĐVT: '.$dvt.'</p>
                        <p class="price text-f14 mt-[10px] mb-[10px]">
                            <span class="text-Pimary_color">' . $price['price_final'] . '</span>
                            <del class="pl-[10px] text-gray-400">' . $price['price_old'] . '</del>
                        </p>';
                    if( isset($check) && is_array($check) && count($check) > 0 ){
                        $html .= htmlItemProductActionInCart( $item, $check, $type );
                    } else {
                        $html .= htmlItemProductActionDefault( $item, $type );
                    }
            $html .='</div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemProductActionDefault')) {
    function htmlItemProductActionDefault( $item = [],  $type = '' )
    {
        $html = '';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
            $item['price_contact']));
        $url = route('routerURL', ['slug' => $item['slug']]);
        $html .= '<a href="'.($type=='variable'?$url:'javascript:void(0)').'" data-quantity="1" data-id="'.$item['id'].'" data-title="'.$item['title'].'"
                            data-price="'. (!empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0) .'" data-cart="0" data-src="" data-type="'.$type.'" class="'.($type=='variable'?'':'addtocart').' add-cart border border-Pimary_color w-full py-[6px] inline-block text-center text-Pimary_color transition-all hover:bg-Pimary_color hover:text-white">
                        <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv"
                             focusable="false" aria-hidden="true" viewBox="0 0 24 24"
                             data-testid="AddShoppingCartIcon"
                             style="font-size: 16px; margin-right: 4px; vertical-align: text-bottom;">
                            <path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"></path>
                        </svg>
                        Thêm vào giỏ
                    </a>';
        return $html;
    }
}

if (!function_exists('htmlItemProductActionInCart')) {
    function htmlItemProductActionInCart( $item = [], $data = [], $type = '' )
    {
        $html = '';
        $url = route('routerURL', ['slug' => $item['slug']]);
        $html .= '<a href="'.($type=='variable'?$url:'javascript:void(0)').'" data-rowid="'.$data['rowid'].'" data-quantity="1" data-id="'.$item['id'].'" data-title="'.$item['title'].'"
                            data-price="'. (!empty($price['price_final_none_format']) ? $price['price_final_none_format'] : 0) .'" data-cart="0" data-src="" data-type="'.$type.'" class="'.($type=='variable'?'':'addtocart_').' action-product border border-Pimary_color w-full inline-block text-center text-Pimary_color transition-all flex flex-wrap justify-between" style="height: 37px">
                        <span class="minus action"><i class="fa-solid fa-minus"></i></span>
                        <span class="data" data-quantity="'.$data['quantity'].'">'.$data['quantity'].'</span>
                        <span class="plus action"><i class="fa-solid fa-plus"></i></span>
                    </a>';
        return $html;
    }
}
