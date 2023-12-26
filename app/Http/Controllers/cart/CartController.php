<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductVersion;
use Illuminate\Support\Facades\DB;
use Session;
use App\Components\Coupon as CouponHelper;
use App\Components\System;
use Auth;
use Cache;
use Validator;

class CartController extends Controller
{
    protected $coupon;
    public function __construct()
    {
        $this->coupon = new CouponHelper();
        $this->system = new System();
    }
    //trang giỏ hàng
    public function index()
    {
        $dropdown = getFunctions();
        $cartController = Session::get('cart');
        $coupon = Session::get('coupon');
        //page: giỏ hàng
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'cart_index'])->select('meta_title', 'meta_description', 'image', 'title')->first();
        $seo['canonical'] = route('cart.index');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();

        $slideHome = Cache::remember('slideHome', 600, function () {
            $slideHome = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'slide-home'])->with('slides')->first();
            return $slideHome;
        });

        // ĐỐI TÁC:
        $partners = Cache::remember('partners', 600, function () {
            $partners = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'partner'])->with('slides')->first();
            return $partners;
        });

        $OurFeatures = Cache::remember('OurFeatures', 600, function () {
            $OurFeatures = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'OurFeatures'])->with('slides')->first();
            return $OurFeatures;
        });

        return view('cart.index', compact('page', 'seo', 'fcSystem', 'cartController', 'coupon', 'dropdown','slideHome','OurFeatures','partners'));
    }
    //trang checkout
    public function checkout()
    {
        $shipLocation = Session::get('location');
        $customer_id = !empty(Auth::guard('customer')->user()) ? Auth::guard('customer')->user()->id : 0;
        $addressCustomer = [];
        if ($customer_id) {
            $addressCustomer = \App\Models\CustomerAddress::where(['publish' => 1, 'customer_id' => $customer_id])->first();
        }
        $cartController = Session::get('cart');
        if (!isset($cartController)) {
            return redirect()->route('homepage.index')->with('error', "Có lỗi xảy ra");
        }

        $slideHome = Cache::remember('slideHome', 600, function () {
            $slideHome = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'slide-home'])->with('slides')->first();
            return $slideHome;
        });

        // ĐỐI TÁC:
        $partners = Cache::remember('partners', 600, function () {
            $partners = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'partner'])->with('slides')->first();
            return $partners;
        });

        $OurFeatures = Cache::remember('OurFeatures', 600, function () {
            $OurFeatures = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'OurFeatures'])->with('slides')->first();
            return $OurFeatures;
        });

        $dropdown = getFunctions();
        $orderInfo =  Session::get('orderinfo');
        $coupon = Session::get('coupon');
        //get tỉnh/thành phố,....
        $city_id = $district_id = $ward_id = '';

        if( $shipLocation ){
            $city_id = $shipLocation['cityid'];
            $district_id = $shipLocation['districtid'];
            $ward_id = $shipLocation['wardid'];
        }

        if (old('city_id')) {
            $city_id = old('city_id');
        } else {
            if (!empty($orderInfo['city_id'])) {
                $city_id = $orderInfo['city_id'];
            } else {
                if (!empty($addressCustomer)) {
                    $city_id = $addressCustomer->city_id;
                }
            }
        }
        if (old('district_id')) {
            $district_id = old('district_id');
        } else {
            if (!empty($orderInfo['district_id'])) {
                $district_id = $orderInfo['district_id'];
            } else {
                if (!empty($addressCustomer)) {
                    $district_id = $addressCustomer->district_id;
                }
            }
        }
        if (old('ward_id')) {
            $ward_id = old('ward_id');
        } else {
            if (!empty($orderInfo['ward_id'])) {
                $ward_id = $orderInfo['ward_id'];
            } else {
                if (!empty($addressCustomer)) {
                    $ward_id = $addressCustomer->ward_id;
                }
            }
        }
        $getCity = \App\Models\VNCity::orderBy('name', 'asc')->get();
        $getDistrict = \App\Models\VNDistrict::where('ProvinceID', $city_id)->orderBy('name', 'asc')->get();
        $getWard = \App\Models\VNWard::where('DistrictID', $district_id)->orderBy('name', 'asc')->get();
        $listCity['0'] = trans('index.City');
        $listDistrict['0'] = trans('index.District');
        $listWard['0'] = trans('index.Ward');
        if (isset($getCity)) {
            foreach ($getCity as $key => $val) {
                $listCity[$val->id] = $val->name;
            }
        }
        if (isset($getDistrict)) {
            foreach ($getDistrict as $key => $val) {
                $listDistrict[$val->id] = $val->name;
            }
        }
        if (isset($getWard)) {
            foreach ($getWard as $key => $val) {
                $listWard[$val->id] = $val->name;
            }
        }
        //end
        //lấy phí vận chuyển
        $getFeeShip = getFeeShip($city_id, $district_id);
        // Session::forget('coupon');
        // Session::save();
        $detail = Page::find(4);
        $dataview = 'checkout';
        //get "Phương thức thanh toán"
        $payments = \App\Models\orderConfig::select('id', 'title', 'description', 'image', 'keyword')->where('publish', 0)->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        //page: giỏ hàng
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'cart_checkout'])->select('meta_title', 'meta_description', 'image', 'title')->first();
        $seo['canonical'] = route('cart.checkout');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('cart.checkout', compact('page', 'seo', 'dataview' , 'fcSystem', 'cartController', 'coupon', 'city_id', 'district_id', 'ward_id', 'listCity', 'listDistrict', 'listWard', 'orderInfo', 'dropdown', 'payments', 'addressCustomer', 'getFeeShip','slideHome','OurFeatures','partners'));
    }
    //trang thanh toán thành công
    public function success($id)
    {
        if (empty($id)) {
            return redirect()->route('homepage.index')->with('error', trans('index.OrderDoesNotExist'));
        }
        $detail = Order::with('city_name')->with('district_name')->with('ward_name')->find($id);
        if (!isset($detail)) {
            return redirect()->route('homepage.index')->with('error', trans('index.OrderDoesNotExist'));
        }

        $slideHome = Cache::remember('slideHome', 600, function () {
            $slideHome = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'slide-home'])->with('slides')->first();
            return $slideHome;
        });

        // ĐỐI TÁC:
        $partners = Cache::remember('partners', 600, function () {
            $partners = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'partner'])->with('slides')->first();
            return $partners;
        });

        $OurFeatures = Cache::remember('OurFeatures', 600, function () {
            $OurFeatures = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'OurFeatures'])->with('slides')->first();
            return $OurFeatures;
        });

        //page: đặt hàng thành công
        $page = Page::where(['page' => 'cart_success', 'alanguage' => config('app.locale')])->select('meta_title', 'meta_description', 'image', 'title')->first();
        $seo['canonical'] = route('cart.checkout');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('cart.success', compact('page', 'fcSystem', 'seo', 'detail','slideHome','OurFeatures','partners'));
    }
    public function getLocation(Request $request)
    {
        $param = $request->param;
        $type = $param['type'];
        $table  = '';
        $textWard  = '';
        $temp = '';
        if ($type == 'city') {
            $table = 'vn_district';
            $where = ['ProvinceID' => $param['id']];
            $textWard  =  '<option value="">' . trans('index.Ward') . '</option>';
            $temp = $temp . '<option value="0">' . trans('index.District') . '</option>';
        } else if ($type == 'district') {
            $table = 'vn_ward';
            $where = ['DistrictID' => $param['id']];
            $temp = $temp . '<option value="0">' . trans('index.Ward') . '</option>';
        }
        $getData = DB::table($table)->select('id', 'name')->where($where)->orderBy('name', 'asc')->get();

        if (isset($getData)) {
            foreach ($getData as  $val) {
                $temp = $temp . '<option value="' . $val->id . '">' . $val->name . '</option>';
            }
        }
        echo json_encode(array(
            'html' => $temp,
            'textWard' => $textWard,
        ));
        die();
    }

    //add to cart ajax
    public function addToCart(Request $request)
    {
        $alert = array(
            'error' => '',
            'message' => '',
            'total' => 0,
            'total_coupon' => 0,
            'total_items' => 0,
            'coupon_price' => 0
        );

        $id = $request->id;
        $quantity = $request->quantity;
        $title_version = $request->title_version;
        $id_version = $request->id_version;
        //dd($quantity);
        $product = Product::select('id', 'title', 'slug', 'price', 'price_sale', 'price_contact', 'unit', 'inventory', 'inventoryPolicy', 'inventoryQuantity', 'catalogue_id', 'image', 'ships')->find($id);
        if (!$product) {
            $alert['error'] = trans('index.ProductDoesNotExist');
        }
        //START: check tồn kho => products_versions
        if ($request->type == 'variable') {
            $getVersionProduct = ProductVersion::where('product_id', $id)->where('id_version', $id_version)->first();
            if (!$getVersionProduct) {
                $alert['error'] = trans('index.ProductVersionDoesNotExist');
            }
            //check cart
            $checkCartVariable = checkCart($getVersionProduct, $quantity);
            if (!empty($checkCartVariable['status'])) {
                $alert['error'] = $checkCartVariable['message'];
                echo json_encode($alert);
                die();
            }
            //end
            $ships = array(
                'weight' => !empty($getVersionProduct['_ships_weight']) ? $getVersionProduct['_ships_weight'] : 200,
                'length' => !empty($getVersionProduct['_ships_length']) ? $getVersionProduct['_ships_length'] : 1,
                'width' => !empty($getVersionProduct['_ships_width']) ? $getVersionProduct['_ships_width'] : 2,
                'height' => !empty($getVersionProduct['_ships_height']) ? $getVersionProduct['_ships_height'] : 3,
            );
            $priceProduct = getPrice(array('price' => $getVersionProduct['price_version'], 'price_sale' => $getVersionProduct['price_sale_version'], 'price_contact' =>
            0));
        } else if ($request->type == 'simple') {
            //check stock
            $checkCartVariable = checkCart($product, $quantity, 'simple');
            if (!empty($checkCartVariable['status'])) {
                $alert['error'] = $checkCartVariable['message'];
                echo json_encode($alert);
                die();
            }
            //end
            $ships = json_decode($product->ships, TRUE);
            $priceProduct = getPrice(array('price' => $product['price'], 'price_sale' => $product['price_sale'], 'price_contact' =>
            $product['price_contact']));
        }
        //END: check tồn kho
        $cart = Session::get('cart');
        //tạo rowid
        $rowid = md5($product->id . $title_version);
        if (isset($cart[$rowid])) {
            $quantity = $cart[$rowid]['quantity'] + $request->quantity;
            if ($request->type == 'variable') {
                $getVersionProduct = ProductVersion::where('product_id', $id)->where('id_version', $id_version)->first();
                if (!$getVersionProduct) {
                    $alert['error'] = trans('index.ProductVersionDoesNotExist');
                }
                //check cart
                $checkCartVariable = checkCart($getVersionProduct, $quantity);
                if (!empty($checkCartVariable['status'])) {
                    $alert['error'] = $checkCartVariable['message'];
                    echo json_encode($alert);
                    die();
                }
                //end
            } else if ($request->type == 'simple') {
                //check stock
                $checkCartVariable = checkCart($product, $quantity, 'simple');
                if (!empty($checkCartVariable['status'])) {
                    $alert['error'] = $checkCartVariable['message'];
                    echo json_encode($alert);
                    die();
                }
                //end
            }
            //update
            $cart[$rowid]['quantity'] =  $quantity;
            $cart[$rowid]['image'] =  !empty($request->image) ? $request->image : $product->image;
            $cart[$rowid]['price'] = $priceProduct['price_final_none_format'];
            $cart[$rowid]['ships'] = $ships;
        } else {
            if ($request->type == 'simple') {
                $cart[$rowid] = [
                    "id" => $product->id,
                    "title" => $product->title,
                    "slug" => $product->slug,
                    "image" => !empty($request->image) ? $request->image : $product->image,
                    "quantity" => $request->quantity,
                    "price" => $priceProduct['price_final_none_format'],
                    "ships" => $ships,
                    "unit" => $product->unit,
                ];
            } else {
                $cart[$rowid] = [
                    "id" => $product->id,
                    "title" => $product->title,
                    "slug" => $product->slug,
                    "image" => !empty($request->image) ? $request->image : $product->image,
                    "quantity" => $request->quantity,
                    "price" => $priceProduct['price_final_none_format'],
                    "options" => array(
                        'id_version' => $id_version,
                        'title_version' => $title_version,
                    ),
                    "ships" => $ships,
                    "unit" => $product->unit,
                ];
            }
        }
        Session::put('cart', $cart);
        Session::save();

        $cartData = Session::get('cart');
        $htmlActionAddCart = '';
        $checkProductInCart = checkProductIncart($id, $cartData);
        if( isset($checkProductInCart) && is_array($checkProductInCart) && count($checkProductInCart) ){
            $htmlActionAddCart = htmlItemProductActionInCart($product, $checkProductInCart, $request->type );
        }
        $getUpdateCart = $this->getUpdateCart($cart, $alert);
        $alert['message'] = trans('index.ProductAddedToCartSuccessfully');
        $alert['total'] = !empty($getUpdateCart['total']) ? $getUpdateCart['total'] : 0;
        $alert['total_items'] = !empty($getUpdateCart['total_items']) ? $getUpdateCart['total_items'] : 0;
        $alert['total_coupon'] = !empty($getUpdateCart['total_coupon']) ? $getUpdateCart['total_coupon'] : 0;
        $alert['html_header'] = !empty($getUpdateCart['html_header']) ? $getUpdateCart['html_header'] : '';
        $alert['html_action_add_cart'] = $htmlActionAddCart;
        echo json_encode($alert);
        die();
    }
    //update: tăng giảm số lương, xóa giỏ hàng
    public function updateCart(Request $request)
    {
        $alert = array(
            'error' => '',
            'message' => '',
            'html' => '',
            'total' => 0,
            'total_coupon' => 0,
            'total_items' => 0,
            'total_rowid' => 0,
            'coupon_price' => 0
        );
        $cart = Session::get('cart');
        $quantity = $request->quantity;
        $htmlActionAddCart = '';
        if ($request->type == 'update') {
            if ($request->rowid and $quantity) {
                //check tồn kho sản phẩm biến thể
                if (!empty($cart[$request->rowid]["options"])) {
                    $getVersionProduct = ProductVersion::select('id', '_stock_status', '_stock', '_outstock_status')
                        ->where('product_id', $cart[$request->rowid]["id"])
                        ->where('id_version',  $cart[$request->rowid]["options"]['id_version'])->first();
                    if (!$getVersionProduct) {
                        $alert['error'] = trans('index.ProductVersionDoesNotExist');
                    }
                    //check stock
                    $checkCartVariable = checkCart($getVersionProduct, $quantity);
                    if (!empty($checkCartVariable['status'])) {
                        $alert['error'] = $checkCartVariable['message'];
                        echo json_encode($alert);
                        die();
                    }
                    //end
                } else {
                    //check tồn kho sản phẩm đơn giản
                    $product = Product::select('inventory', 'inventoryPolicy', 'inventoryQuantity')->find($cart[$request->rowid]['id']);
                    //check stock
                    $checkCartVariable = checkCart($product, $quantity, 'simple');
                    if (!empty($checkCartVariable['status'])) {
                        $alert['error'] = $checkCartVariable['message'];
                        echo json_encode($alert);
                        die();
                    }
                    //end
                }
                //end
                $cart[$request->rowid]["quantity"] = $quantity;
                $alert["total_rowid"] = $quantity;
                //return
                $alert = $this->getUpdateCart($cart, $alert);
            } else {
                $alert['error'] = trans('index.CartUpdateFailed');
            }
        } else if ($request->type == 'delete') {
            $product = Product::select('id', 'title', 'slug', 'price', 'price_sale', 'price_contact', 'unit', 'inventory', 'inventoryPolicy', 'inventoryQuantity', 'catalogue_id', 'image', 'ships')->find($cart[$request->rowid]['id']);
            //dd($product);
            if ($request->rowid) {
                if (isset($cart[$request->rowid])) {
                    unset($cart[$request->rowid]);
                    //return
                    $alert = $this->getUpdateCart($cart, $alert);
                    $alert['message'] = 'Xóa giỏ hàng thành công';
                    $htmlActionAddCart = htmlItemProductActionDefault($product, 'simple' );
                    $alert['htmlActionAddCart'] = $htmlActionAddCart;
                } else {
                    $alert['error'] = trans('index.CartDeletionFailed');
                }
            } else {
                $alert['error'] = trans('index.CartDeletionFailed');
            }
        } else {
            $alert['error'] = trans('index.AnErrorOccurred');
        }
        echo json_encode($alert);
        die();
    }
    //ajax thêm mã giảm giá
    public function addCoupon(Request $request)
    {
        $name = $request->name;
        $fee_ship = $request->fee_ship;
        if (!empty($name)) {
            $alert = $this->coupon->getCoupon($name, TRUE, $fee_ship);
        } else {
            $alert['error'] = trans('index.PromoCodeCannotBeBlank');
        }
        echo json_encode($alert);
        die();
    }
    //ajax xóa mã giảm giá
    public function deleteCoupon(Request $request)
    {
        $alert = array(
            'error' => '',
            'message' => '',
            'price' => 0,
            'total' =>  0
        );
        $id  = $request->id;
        $fee_ship  = $request->fee_ship;
        $cart = Session::get('cart');
        $total = 0;
        if ($cart) {
            foreach ($cart as $v) {
                $total += $v['price'] * $v['quantity'];
            }
        }
        $coupon = Session::get('coupon');
        if (!in_array($id, array_keys($coupon))) {
            $alert['error'] = trans('index.Discountcodedoesnotexist');
        } else {
            unset($coupon[$id]);
            Session::put('coupon', $coupon);
            Session::save();
            //return
            $price_counpon = 0;
            $html = '';
            if (isset($coupon)) {
                foreach ($coupon as $v) {
                    $price_counpon += $v['price'];
                    $html .= '<tr>
                        <th>' . trans('index.DiscountCode') . ' : <span class="cart-coupon-name">' . $v['name'] . '</span></th>
                        <td>-<span class="amount cart-coupon-price">' . number_format($v['price']) . '₫</span> <a href="javascript:void(0)" data-id="' . $v['id'] . '" class="remove-coupon">[' . trans('index.Delete') . ']</a></td>
                    </tr>';
                }
            }
            $alert['price'] = $price_counpon;
            $alert['html'] = $html;
            $alert['total'] = number_format($total + $fee_ship - $price_counpon) . '₫';
            $alert['message'] = trans('index.SuccessfullyDeletedDiscountCode');
        }
        echo json_encode($alert);
    }
    //cập nhập lại toàn bộ giỏ hàng nếu add coupon
    public function getUpdateCart($cart = [], $alert = [])
    {
        $coupon = Session::get('coupon');
        $html = $html_header =  '';
        $html = $html_checkout = '' ;
        Session::put('cart', $cart);
        Session::save();
        $total = 0;
        $total_items = 0;
        if ($cart) {
            foreach ($cart as $k => $v) {
                $total += $v['price'] * $v['quantity'];
                $total_items += $v['quantity'];
                $html .= htmlItemCart($k, $v);
                $html_header .= htmlItemCartHeader($k, $v);
            }
            //nếu tồn tại mã giảm giá thì tính toán lại
            $coupon_price = 0;
            $coupon_html = '';
            if (!empty($coupon)) {
                foreach ($coupon as $v) {
                    $this->coupon->getCoupon($v['name'], FALSE);
                }
            }
            $coupon = Session::get('coupon');
            if (!empty($coupon)) {
                foreach ($coupon as $v) {
                    $coupon_price += $v['price'];
                    $coupon_html .= '<tr>
                        <th>' . trans('index.DiscountCode') . ' : <span class="cart-coupon-name">' . $v['name'] . '</span></th>
                        <td>-<span class="amount cart-coupon-price">' . number_format($v['price']) . '₫</span> <a href="javascript:void(0)" data-id="' . $v['id'] . '" class="remove-coupon">[' . trans('index.Delete') . ']</a></td>
                    </tr>';
                }
            }
            //end
            $alert['html'] = $html;
            $alert['html_header'] = $html_header;
            $alert['message'] = trans('index.ProductUpdate');
            $alert['total'] = $total;
            $alert['total_coupon'] = $total - $coupon_price;
            $alert['total_items'] = $total_items;
            $alert['coupon_price'] = $coupon_price;
            $alert['coupon_html'] = $coupon_html;
        }
        return $alert;
    }
    public function validateFormCopyCart(Request $request)
    {
        $cart = Session::get('cart');
        if (empty($cart)) {
            return response()->json(['error' => trans('index.YouHaveNotSelectedProduct')]);
        }
        if (config('app.locale') == 'vi') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric', 'regex:/^(03|02|05|07|08|09|01[2|6|8|9])+([0-9]{8})$/'],
                'address' => 'required',
                'city_id' => 'required|gt:0',
                'district_id' => 'required|gt:0',
                'ward_id' => 'required|gt:0',
            ], [
                'fullname.required' => 'Họ và tên là trường bắt buộc.',
                'email.required' => 'Email là trường bắt buộc.',
                'email.email' => 'Email không đúng định dạng',
                'phone.required' => 'Số điện thoại không được để trống.',
                'phone.regex'        => 'Số điện thoại không hợp lệ.',
                'phone.numeric' => 'Số điện thoại không đúng định dạng.',
                'address.required' => 'Địa chỉ là trường bắt buộc.',
                'city_id.required' => 'Tỉnh/Thành Phố là trường bắt buộc.',
                'city_id.gt' => 'Tỉnh/Thành Phố là trường bắt buộc.',
                'district_id.required' => 'Quận/Huyện là trường bắt buộc.',
                'district_id.gt' => 'Quận/Huyện là trường bắt buộc.',
                'ward_id.required' => 'Phường/Xã là trường bắt buộc.',
                'ward_id.gt' => 'Phường/Xã là trường bắt buộc.',
            ]);
        } else if (config('app.locale') == 'gm') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric'],
                'address' => 'required',
                'city_id' => 'required|gt:0',
                'district_id' => 'required|gt:0',
                'ward_id' => 'required|gt:0',
            ], [
                'fullname.required' => 'Vor- und Nachname sind Pflichtfelder.',
                'email.required' => 'E-Mail ist ein Pflichtfeld.',
                'email.email' => 'Ungültiges E-Mail-Format',
                'phone.required' => 'Telefonnummer darf nicht leer sein.',
                'phone.numeric' => 'Telefonnummer hat nicht das richtige Format.',
                'address.required' => 'Adresse ist ein Pflichtfeld.',
                'city_id.required' => 'Provinz/Stadt ist Pflichtfeld.',
                'city_id.gt' => 'Provinz/Stadt ist Pflichtfeld.',
                'district_id.required' => 'Distrikt/Distrikt ist ein Pflichtfeld.',
                'district_id.gt' => 'Bezirk/Bezirk ist ein Pflichtfeld.',
                'ward_id.required' => 'Gemeinde/Gemeinde ist ein Pflichtfeld.',
                'ward_id.gt' => 'Gemeinde/Gemeinde ist ein Pflichtfeld.',
            ]);
        } else if (config('app.locale') == 'tl') {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric'],
                'address' => 'required',
                'city_id' => 'required|gt:0',
                'district_id' => 'required|gt:0',
                'ward_id' => 'required|gt:0',
            ], [
                'fullname.required' => 'ชื่อและนามสกุลเป็นฟิลด์บังคับ',
                'email.required' => 'อีเมลเป็นฟิลด์บังคับ',
                'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
                'phone.required' => 'หมายเลขโทรศัพท์ต้องไม่เว้นว่าง',
                'phone.numeric' => 'หมายเลขโทรศัพท์ไม่อยู่ในรูปแบบที่ถูกต้อง',
                'address.required' => 'ที่อยู่เป็นฟิลด์บังคับ',
                'city_id.required' => 'จังหวัด/เมือง เป็นฟิลด์บังคับ',
                'city_id.gt' => 'จังหวัด/เมือง จำเป็นต้องกรอก',
                'district_id.required' => 'เขต/เขตเป็นฟิลด์บังคับ',
                'district_id.gt' => 'เขต/เขตเป็นฟิลด์บังคับ',
                'ward_id.required' => 'วอร์ด/ชุมชนเป็นฟิลด์บังคับ',
                'ward_id.gt' => 'วอร์ด/ชุมชนเป็นฟิลด์บังคับ',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required',
                'email' => 'required|email',
                'phone' => ['required', 'numeric'],
                'address' => 'required',
                'city_id' => 'required|gt:0',
                'district_id' => 'required|gt:0',
                'ward_id' => 'required|gt:0',
            ]);
        }
        if ($validator->passes()) {
            //thuc hien check ton kho
            $arrStock = [];
            if (isset($cart)) {
                foreach ($cart as $key => $value) {
                    if (!empty($value['options'])) {
                        $getVersionproduct = \App\Models\ProductVersion::select('id', '_stock_status', '_stock', '_outstock_status')
                            ->where('product_id', $value["id"])
                            ->where('id_version',  $value["options"]['id_version'])->first();
                        //quản lý kho hàng - không cho đặt hàng khi hết hàng - số lượng bằng 0
                        if ($getVersionproduct['_stock_status'] == 1 && $getVersionproduct['_outstock_status']  == 0 && $getVersionproduct['_stock'] == 0) {
                            array_push($arrStock, 'Sản phẩm ' . $value['title'] . '-' . $value['options'] . ' đã hết hàng');
                        }
                        //check số lượng so với tồn kho
                        if ($getVersionproduct['_stock_status'] == 1 && $getVersionproduct['_outstock_status']  == 0) {
                            if ($value['quantity'] > $getVersionproduct['_stock']) {
                                array_push($arrStock, 'Sản phẩm ' . $value['title'] . '-' . $value['options'] . ' mua tối đa ' . $getVersionproduct['_stock'] . ' sản phẩm');
                            }
                        }
                    } else {
                        $product = \App\Models\Product::select('id', 'inventory', 'inventoryPolicy', 'inventoryQuantity')->find($value["id"]);
                        if ($product['inventory'] == 1 && $product['inventoryPolicy']  == 0 && $product['inventoryQuantity'] == 0) {
                            array_push($arrStock, 'Sản phẩm ' . $value['title'] . ' đã hết hàng');
                        }
                        //check số lượng so với tồn kho
                        if ($product['inventory'] == 1 && $product['inventoryPolicy']  == 0) {
                            if ($value['quantity'] > $product['inventoryQuantity']) {
                                array_push($arrStock, 'Sản phẩm ' . $value['title'] . ' mua tối đa ' . $product['inventoryQuantity'] . ' sản phẩm');
                            }
                        }
                    }
                }
            }
            if (!empty($arrStock)) {
                $html = '';
                foreach ($arrStock as $item) {
                    $html .= $item . '/';
                }
                return response()->json(['error' => $html]);
            } else {
                return response()->json(['status' => '200']);
            }
            //endif
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
}