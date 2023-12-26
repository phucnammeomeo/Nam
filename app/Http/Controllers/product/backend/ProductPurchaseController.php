<?php

namespace App\Http\Controllers\product\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductPurchase;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Session;

class ProductPurchaseController extends Controller
{
    protected $module = 'product_purchases';
    public function __construct()
    {
        $listUsers = dropdown(\App\Models\User::orderBy('id', 'asc')->get(), 'Chọn nhân viên', 'id', 'name');
        $dropdown = getFunctions();
        $paymentMethod = config('payment.method');
        View::share(['module' => $this->module, 'listUsers' => $listUsers, 'paymentMethod' => $paymentMethod, 'dropdown' => $dropdown]);
    }
    public function index()
    {
        $listAddress = dropdown(\App\Models\Address::orderBy('active', 'desc')->get(), 'Chi nhánh', 'id', 'title');
        $listSuppliers = dropdown(\App\Models\Suppliers::orderBy('id', 'desc')->get(), 'Nhà cung cấp', 'id', 'title');
        $data = ProductPurchase::orderBy('id', 'desc');
        $data = $data->paginate(env('APP_paginate'));
        return view('product.backend.purchases.index', compact('data', 'listAddress', 'listSuppliers'));
    }

    public function show($id)
    {
        $detail = ProductPurchase::with('product_purchases_financials')->find($id);
        if (empty($detail)) {
            return redirect()->route('product_purchases.index')->with('error', "Đơn nhập hàng không tồn tại");
        }
        $discount = json_decode($detail->discount, TRUE);
        $surcharge = json_decode($detail->surcharge, TRUE);
        $discount = json_decode($detail->discount, TRUE);
        $request = array(
            'discountValue' =>  !empty($discount['value']) ? $discount['value'] : 0,
            'discountType' =>  !empty($discount['type']) ? $discount['type'] : '',
        );
        $products = $this->loadDataPurchases(
            json_decode($detail->products, TRUE),
            !empty($surcharge) ? (!empty($surcharge['sum']) ? str_replace('.', '', $surcharge['sum']) : 0) : 0,
            !empty($discount) ? (!empty($discount['price']) ? str_replace('.', '', $discount['price']) : 0) : 0,
        );
        // dD($products);
        $price = $detail->price_total - $detail->product_purchases_financials->sum('price');
        // dd($detail->price_total);
        return view('product.backend.purchases.show', compact('detail', 'products', 'price'));
    }
    public function create()
    {
        //Khởi tạo session
        Session::put('cartPurchases', []);
        Session::put('surcharge', []);
        Session::put('discount', []);
        Session::save();
        //end
        $suppliers = \App\Models\Suppliers::orderBy('id', 'desc')->paginate(6);
        $listAddress = \App\Models\Address::select('id', 'title', 'active')->orderBy('active', 'desc')->get();
        $products = \App\Models\Product::select('id', 'title', 'image', 'price_import', 'inventoryQuantity', 'unit')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->orderBy('id', 'desc')
            ->with('product_versions')
            ->paginate(10);
        return view('product.backend.purchases.create', compact('suppliers', 'products', 'listAddress'));
    }
    public function store(Request $request)
    {

        //danh sách sản phẩm
        $products = Session::get('cartPurchases');
        $cart = $this->loadDataPurchases($products);
        //danh sách chi phí
        $surcharge = Session::get('surcharge');
        $discount = Session::get('discount');
        if (empty($products)) {
            return redirect()->route('product_purchases.create')->with('error', "Vui lòng chọn sản phẩm vào đơn nhập");
        }
        $request->validate([
            'suppliers_id' => 'required',
        ], [
            'suppliers_id.required' => 'Vui lòng thêm nhà cung cấp!.',
        ]);
        //số tiền thanh toán cho nhà cung cấp
        $price_suppliers = !empty($request->price_suppliers) ? str_replace('.', '', $request->price_suppliers) : 0;
        //tích "Thanh toán với nhà cung cấp"
        $financialStatusValue = $request->financialStatusValue;
        $financialInfo = !empty($request->financialInfo) ? $request->financialInfo : [];
        //tích "Nhập hàng vào kho"
        $receiveStatusValue = $request->receiveStatusValue;
        //tổng tiền
        $price_total = !empty($cart) ? (!empty($cart['total']) ? $cart['total'] : 0) : 0;
        $status = 'active';
        $receiveStatus = 'pending';
        $financialStatus = 'pending';
        //trạng thái
        if (!empty($financialStatusValue) && !empty($receiveStatusValue) && $price_total == $price_suppliers) {
            $status = 'completed';
        }
        //thanh toán
        if (!empty($financialStatusValue)) {
            if ($price_total == $price_suppliers) {
                $financialStatus = 'paid';
            } else if ($price_suppliers < $price_total) {
                $financialStatus = 'partially_paid';
            }
        }
        //nhập kho
        if (!empty($receiveStatusValue)) {
            $receiveStatus = 'received';
        }
        $address_id = $request->address_id;
        dD($address_id);
        $_data = array(
            'suppliers_id' => $request->suppliers_id,
            'code' => $request->code,
            'address_id' => $address_id,
            'products' => json_encode($products),
            //THANH TOÁN
            'price_suppliers' => $price_suppliers,
            'price_total' => $price_total,
            //chiết khấu
            'discount' => !empty($discount) ? json_encode($discount) : '',
            'reference' => $request->reference,
            'dueOn' => $request->dueOn,
            'note' => $request->note,
            //chi phí
            'surcharge' => !empty($surcharge) ? json_encode($surcharge) : '',
            'status' => $status,
            'financialStatusValue' => !empty($financialStatusValue) ? $financialStatusValue : 0,
            'financialStatus' => $financialStatus,

            'receiveStatusValue' => !empty($receiveStatusValue) ? $receiveStatusValue : 0,
            'receiveStatus' => $receiveStatus,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        );

        $id = \App\Models\ProductPurchase::insertGetId($_data);
        if (!empty($id)) {
            /**
             * Cập nhập công nợ của nhà cung cấp: DONE
             * Cập nhập hàng đang về bảng product_stocks cho mỗi vào sản phẩm: trong trường hợp không tích nút kho hàng: DONE
             * Cập nhập số lượng tồn kho vào bảng product_stocks cho mỗi vào sản phẩm: trong trường hợp tích nút kho hàng: DONE
             * Cập nhập vào bảng product_stock_history (lịch sử tồn kho) (trong trường hợp tích nút kho hàng)
             * Tạo phiếu chi (trong trường hợp thanh toán đầy đủ và thanh toán 1 phần)
             */
            /**Cập nhập công nợ của nhà cung cấp */
            //tích nút "Thanh toán với nhà cung cấp"
            $priceFinancial  = 0;
            if (!empty($financialStatusValue)) {
                //Số tiền thanh toán nhỏ hơn Tổng tiền
                if ($price_suppliers < $price_total) {
                    $detailSuppliers = \App\Models\Suppliers::select('id', 'debt')->find($request->suppliers_id);
                    if (!empty($detailSuppliers)) {
                        $priceFinancial = $price_total - $price_suppliers;
                        \App\Models\Suppliers::where('id', $detailSuppliers->id)->update([
                            'debt' => !empty($detailSuppliers->debt) ? $detailSuppliers->debt : 0 + $priceFinancial
                        ]);
                    }
                }
                //ghi log bảng: product_purchases_financials
                \App\Models\ProductPurchasesFinancial::insertGetId(array(
                    'price' => $price_suppliers,
                    'method' => !empty($financialInfo['method']) ? $financialInfo['method'] : '',
                    'reference' => !empty($financialInfo['reference']) ? $financialInfo['reference'] : '',
                    'product_purchases_id' => $id,
                    'userid_created' => Auth::user()->id,
                    'created_at' => Carbon::now()
                ));
                //thêm mới vào bảng "Phiếu chi": payment_vouchers
                if (!empty($price_suppliers)) {
                    \App\Models\PaymentVouchers::insertGetId(array(
                        'address_id' => $address_id,
                        'code' => CodeRender('payment_vouchers'),
                        'module' => 'product_purchases',
                        'module_id' => $id,
                        'group_id' => 11,
                        'price' => $price_suppliers,
                        'type' => !empty($financialInfo['method']) ? $financialInfo['method'] : '',
                        'reference' => !empty($financialInfo['reference']) ? $financialInfo['reference'] : '',
                        'checked' => 1,
                        'status' => 'completed',
                        'userid_created' => Auth::user()->id,
                        'created_at' => Carbon::now()
                    ));
                }
            } else {
                $detailSuppliers = \App\Models\Suppliers::select('id', 'debt')->find($request->suppliers_id);
                if (!empty($detailSuppliers)) {
                    \App\Models\Suppliers::where('id', $detailSuppliers->id)->update([
                        'debt' => !empty($detailSuppliers->debt) ? $detailSuppliers->debt : 0 + $price_suppliers,
                        'updated_at' =>  Carbon::now()
                    ]);
                }
            }
            /**END: Cập nhập công nợ của nhà cung cấp */
            /**START: Cập nhập số lượng tồn kho */
            if (!empty($receiveStatusValue)) {
                //tích nút: "Nhập hàng vào kho" => Cập nhập số lượng stock
                foreach ($products as $item) {
                    $id_version = !empty($item['options']['id_version']) ? $item['options']['id_version'] : '';
                    if (!empty($id_version)) {
                        $detailStock = \App\Models\ProductStock::select('id', 'value')
                            ->where(['product_id' => $item['id'], 'product_version_id' => $id_version, 'address_id' => $address_id])
                            ->first();
                        \App\Models\ProductStock::where(['product_id' => $item['id'], 'product_version_id' => $id_version, 'address_id' => $address_id])->update([
                            'value' => !empty($detailStock['value']) ? $detailStock['value'] : 0 + (int)$item['quantity'], 'updated_at' =>  Carbon::now()
                        ]);
                        //ghi lịch sử
                        \App\Models\ProductStockHistory::insertGetId(array(
                            'product_id' => $item['id'],
                            'product_version_id' => $id_version,
                            'address_id' =>  $address_id,
                            'purchase_id' => $id,
                            'user_id' =>  Auth::user()->id,
                            'quantity' => (int)$item['quantity'],
                            'type' => 'plus',
                            'stock' => !empty($detailStock['value']) ? $detailStock['value'] : 0 + (int)$item['quantity'],
                            'created_at' => Carbon::now()
                        ));
                    } else {
                        $detailStock = \App\Models\ProductStock::select('id', 'value')
                            ->where(['product_id' => $item['id'], 'address_id' => $address_id])
                            ->first();
                        \App\Models\ProductStock::where(['product_id' => $item['id'], 'address_id' => $address_id])->update([
                            'value' => !empty($detailStock['value']) ? $detailStock['value'] : 0 + (int)$item['quantity'], 'updated_at' =>  Carbon::now()
                        ]);
                        //ghi lịch sử
                        \App\Models\ProductStockHistory::insertGetId(array(
                            'product_id' => $item['id'],
                            'address_id' =>  $address_id,
                            'purchase_id' => $id,
                            'user_id' =>  Auth::user()->id,
                            'quantity' => (int)$item['quantity'],
                            'type' => 'plus',
                            'stock' => !empty($detailStock['value']) ? $detailStock['value'] : 0 + (int)$item['quantity'],
                            'created_at' => Carbon::now()
                        ));
                    }
                }
                \App\Models\ProductPurchase::where('id', '=', $id)->update(array(
                    'created_stock_at' => Carbon::now()
                ));
            } else {
                //tích nút: "Nhập hàng vào kho" => Cập nhập số lượng "hàng đang về"
                foreach ($products as $item) {
                    $id_version = !empty($item['options']['id_version']) ? $item['options']['id_version'] : '';
                    if (!empty($id_version)) {
                        $detailStock = \App\Models\ProductStock::select('id', 'stockComing')
                            ->where(['product_id' => $item['id'], 'product_version_id' => $id_version, 'address_id' => $address_id])
                            ->first();
                        \App\Models\ProductStock::where(['product_id' => $item['id'], 'product_version_id' => $id_version, 'address_id' => $address_id])->update([
                            'stockComing' => $detailStock['stockComing'] + (int)$item['quantity'],
                            'updated_at' =>  Carbon::now()
                        ]);
                    } else {
                        $detailStock = \App\Models\ProductStock::select('id', 'stockComing')
                            ->where(['product_id' => $item['id'], 'address_id' => $address_id])
                            ->first();
                        \App\Models\ProductStock::where(['product_id' => $item['id'], 'address_id' => $address_id])->update([
                            'stockComing' => $detailStock['stockComing'] + (int)$item['quantity'],
                            'updated_at' =>  Carbon::now()
                        ]);
                    }
                }
            }
            /**END : Cập nhập số lượng tồn kho */
            if (!empty($financialStatusValue) && !empty($receiveStatusValue) && $price_total == $price_suppliers) {
                \App\Models\ProductPurchase::where('id', '=', $id)->update(array(
                    'created_completed_at' => Carbon::now()
                ));
            }

            return redirect()->route('product_purchases.index')->with('success', "Thêm mới đơn nhập hàng thành công");
        }
    }
    //ajax list Nhà cung cấp
    public function ajaxListSuppliers(Request $request)
    {
        $keyword = removeutf8($request->keyword);
        $suppliers =  \App\Models\Suppliers::query()->orderBy('id', 'DESC');
        if (!empty($keyword)) {
            $suppliers =  $suppliers->where('code', 'like', '%' . $keyword . '%')
                ->orWhere('title', 'like', '%' . $keyword . '%')
                ->orWhere('phone', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        }
        $suppliers =  $suppliers->paginate(6);
        return view('product.backend.purchases.create.suppliers', compact('suppliers'))->render();
    }
    //Ajax List product
    public function ajaxListProducts(Request $request)
    {
        $keyword = $request->keyword;
        $type = $request->type;
        $products =  \App\Models\Product::query()
            ->select('id', 'title', 'image', 'price_import', 'inventoryQuantity', 'unit')
            ->where('alanguage', config('app.locale'))
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC')
            ->with('product_versions');
        if (!empty($keyword)) {
            $products =  $products->where('products.title', 'like', '%' . $keyword . '%');
            $products =  $products->orWhere('products.code', 'like', '%' . $keyword . '%');
        }
        $products =  $products->paginate(10);

        return view('product.backend.purchases.create.' . $type, compact('products'))->render();
    }
    //Thêm sản phẩm
    public function addToCartPurchases(Request $request)
    {
        $cart = Session::get('cartPurchases');
        $quantity = 1;
        $id = $request->id;
        $id_version = $request->id_version;
        $title_version = $request->title_version;
        $type = $request->type;
        $price = $request->price;
        $image = $request->image;
        $unit = !empty($request->unit) ? $request->unit : '';
        $product = \App\Models\Product::select('id', 'title', 'unit', 'code')->with('TaxesRelationships')->find($id);
        if (!$product) {
            return response()->json(['error' => 'Sản phẩm không tồn tại']);
        }
        //tạo rowid
        $rowid = md5($product->id . $id_version);
        if ($type == 'variable') {
            $getVersionProduct = \App\Models\ProductVersion::where('product_id', $id)->where('id_version', $id_version)->first();
            if (!$getVersionProduct) {
                return response()->json(['error' => 'Phiên bản sản phẩm không tồn tại']);
            }
        }
        $taxes_import = !empty($product->TaxesRelationships->taxes_import) ? $product->TaxesRelationships->taxes_import : 0;
        $taxes_type = !empty($product->TaxesRelationships->taxes_type) ? $product->TaxesRelationships->taxes_type : '';
        $taxes_value = 0;
        $price_taxes = $price;
        if ($taxes_type == 'tax') {
            $priceProduct = round($quantity * $price) / (1 + ($taxes_import / 100));
            $taxes_value = round(($priceProduct / 100) * $taxes_import);
            $price_taxes = round(($price) / (1 + ($taxes_import / 100)));
        } else if ($taxes_type == 'notax') {
            $taxes_value = round((($quantity * $price) / 100) * $taxes_import);
        }
        if (isset($cart[$rowid])) {
            $cart[$rowid]['quantity'] =  $cart[$rowid]['quantity'] + $quantity;
            $cart[$rowid]['image'] =  $image;
            $cart[$rowid]['price'] = $price;
            $cart[$rowid]['price_taxes'] = $price_taxes;
            $cart[$rowid]['taxes_import'] = $taxes_import;
            $cart[$rowid]['taxes_type'] = $taxes_type;
            $cart[$rowid]['taxes_value'] = $taxes_value;
        } else {
            if ($request->type == 'simple') {
                $cart[$rowid] = [
                    "code" => $product->code,
                    "id" => $product->id,
                    "title" => $product->title,
                    "image" => $image,
                    "quantity" => $quantity,
                    "price" => $price,
                    "unit" => $unit,
                    "price_taxes" => $price_taxes,
                    "taxes_import" => $taxes_import,
                    "taxes_type" => $taxes_type,
                    "taxes_value" => $taxes_value,
                ];
            } else {
                $cart[$rowid] = [
                    "code" => $getVersionProduct->code_version,
                    "id" => $product->id,
                    "title" => $product->title,
                    "image" => $image,
                    "quantity" => $quantity,
                    "price" => $price,
                    "options" => array(
                        'id_version' => $id_version,
                        'title_version' => $title_version,
                    ),
                    "unit" => $unit,
                    "price_taxes" => $price_taxes,
                    "taxes_import" => $taxes_import,
                    "taxes_type" => $taxes_type,
                    "taxes_value" => $taxes_value,
                ];
            }
        }
        Session::put('cartPurchases', $cart);
        Session::save();
        return response()->json($this->loadDataPurchases($cart));
    }
    //Thêm nhiều sản phẩm
    public function ajaxAddToCartModalPopup(Request $request)
    {
        $cart = Session::get('cartPurchases');
        $quantity = 1;
        $sList = !empty($request->sList) ? $request->sList : '';
        if (!empty($sList)) {
            foreach ($sList as $item) {
                $data = json_decode($item, TRUE);
                $id = $data['id'];
                $id_version = !empty($data['id_version']) ? $data['id_version'] : '';
                $title_version = !empty($data['title_version']) ? $data['title_version'] : '';
                $type = $data['type'];
                $price = $data['price'];
                $image = $data['image'];
                $unit = !empty($data['unit']) ? $data['unit'] : '';
                $product = \App\Models\Product::select('id', 'title', 'unit', 'code')->with('TaxesRelationships')->find($id);
                if (!$product) {
                    return response()->json(['error' => 'Sản phẩm không tồn tại']);
                }
                //tạo rowid
                $rowid = md5($product->id . $id_version);
                if ($type == 'variable') {
                    $getVersionProduct = \App\Models\ProductVersion::where('product_id', $id)->where('id_version', $id_version)->first();
                    if (!$getVersionProduct) {
                        return response()->json(['error' => 'Phiên bản sản phẩm không tồn tại']);
                    }
                }
                $taxes_import = !empty($product->TaxesRelationships->taxes_import) ? $product->TaxesRelationships->taxes_import : 0;
                $taxes_type = !empty($product->TaxesRelationships->taxes_type) ? $product->TaxesRelationships->taxes_type : '';
                $taxes_value = 0;
                $price_taxes = $price;
                if ($taxes_type == 'tax') {
                    $priceProduct = round($quantity * $price) / (1 + ($taxes_import / 100));
                    $taxes_value = round(($priceProduct / 100) * $taxes_import);
                    $price_taxes = round(($price) / (1 + ($taxes_import / 100)));
                } else if ($taxes_type == 'notax') {
                    $taxes_value = round((($quantity * $price) / 100) * $taxes_import);
                }
                if (isset($cart[$rowid])) {
                    $cart[$rowid]['quantity'] =  $cart[$rowid]['quantity'] + $quantity;
                    $cart[$rowid]['image'] =  $image;
                    $cart[$rowid]['price'] = $price;
                    $cart[$rowid]['price_taxes'] = $price_taxes;
                    $cart[$rowid]['taxes_import'] = $taxes_import;
                    $cart[$rowid]['taxes_type'] = $taxes_type;
                    $cart[$rowid]['taxes_value'] = $taxes_value;
                } else {
                    if ($type == 'simple') {
                        $cart[$rowid] = [
                            "code" => $product->code,
                            "id" => $product->id,
                            "title" => $product->title,
                            "image" => $image,
                            "quantity" => $quantity,
                            "price" => $price,
                            "unit" => $unit,
                            "price_taxes" => $price_taxes,
                            "taxes_import" => $taxes_import,
                            "taxes_type" => $taxes_type,
                            "taxes_value" => $taxes_value,
                        ];
                    } else {
                        $cart[$rowid] = [
                            "code" => $getVersionProduct->code_version,
                            "id" => $product->id,
                            "title" => $product->title,
                            "image" => $image,
                            "quantity" => $quantity,
                            "price" => $price,
                            "options" => array(
                                'id_version' => $id_version,
                                'title_version' => $title_version,
                            ),
                            "unit" => $unit,
                            "price_taxes" => $price_taxes,
                            "taxes_import" => $taxes_import,
                            "taxes_type" => $taxes_type,
                            "taxes_value" => $taxes_value,
                        ];
                    }
                }
                Session::put('cartPurchases', $cart);
                Session::save();
            }
        }
        return response()->json($this->loadDataPurchases($cart));
    }
    //cập nhập sản phẩm
    public function ajaxUpdateCartPurchases(Request $request)
    {
        $type = $request->type;
        $rowid = $request->rowid;
        $quantity = $request->quantity;
        $cart = Session::get('cartPurchases');
        if ($type == 'update') {
            if (!empty($rowid) && !empty($quantity)) {
                $cart[$rowid]["quantity"] = $quantity;
                //return
                Session::put('cartPurchases', $cart);
                Session::save();
                return response()->json($this->loadDataPurchases($cart));
            } else {
                return response()->json(['error' => 'Error: Có lỗi xảy ra']);
            }
        }
        if ($type == 'updatePrice') {
            if (!empty($rowid) && !empty($request->price)) {
                $cart[$rowid]["price"] = str_replace('.', '', $request->price);
                //return
                Session::put('cartPurchases', $cart);
                Session::save();
                return response()->json($this->loadDataPurchases($cart));
            } else {
                return response()->json(['error' => 'Error: Có lỗi xảy ra']);
            }
        } else if ($type == 'delete') {
            if ($rowid) {
                if (isset($cart[$rowid])) {
                    unset($cart[$rowid]);
                    Session::put('cartPurchases', $cart);
                    Session::save();
                    return response()->json($this->loadDataPurchases($cart));
                } else {
                    return response()->json(['error' => 'Error: Có lỗi xảy ra']);
                }
            } else {
                return response()->json(['error' => 'Error: Có lỗi xảy ra']);
            }
        } else {
            return response()->json(['error' => 'Error: Có lỗi xảy ra']);
        }
    }
    //Thêm chiết khấu
    public function addDiscount(Request $request)
    {
        $value = !empty($request->value) ? str_replace('.', '', $request->value) : 0;
        $type = $request->type;
        $priceDiscount = 0;
        $cart = Session::get('cartPurchases');
        if (!empty($type) && !empty($cart)) {
            $taxesArr = [];
            $provisional = 0;
            $tax = 0;
            $total = 0;
            if ($type == 'money' || $type == 'percent') {
                if (!empty($cart)) {
                    foreach ($cart as $key => $item) {
                        $provisional = $provisional + ((int)$item['quantity'] * (float)$item['price_taxes']);
                    }
                    $collectCart = collect($cart)->groupBy('taxes_import')->all();
                    if (!empty($collectCart)) {
                        foreach ($collectCart as $key => $item) {
                            if (!empty($item)) {
                                foreach ($item as $k => $v) {
                                    $taxesArr[$key][] = $v['taxes_value'];
                                }
                            }
                        }
                    }
                }
                if (!empty($taxesArr)) {
                    foreach ($taxesArr as $key => $item) {
                        if ($key > 0) {
                            $tax = $tax + collect($item)->sum();
                        }
                    }
                }
                //chi phí
                $surcharge = Session::get('surcharge');
                $priceSurcharge = 0;
                if (!empty($surcharge)) {
                    $priceSurcharge = $surcharge['sum'];
                }
                //tổng tiền
                $total = $provisional + $priceSurcharge + $tax;
                if ($type == 'money') {
                    if ($value > $total) {
                        return response()->json(['error' => 'Giá trị chiết khấu phải <= ' . number_format($total, '0', ',', '.') . 'đ']);
                    } else {
                        $total = $total - $value;
                        $priceDiscount = $value;
                        Session::put('discount', array('type' => $type, 'value' => $value, 'price' => $priceDiscount));
                        Session::save();
                        return response()->json([
                            'total' => $total,
                            'priceDiscount' =>  $priceDiscount,
                        ]);
                    }
                } else if ($type == 'percent') {
                    if ($value <= 100) {
                        $priceDiscount = round(($total / 100) * $value);
                        $total = $total - $priceDiscount;
                        Session::put('discount', array('type' => $type, 'value' => $value, 'price' => $priceDiscount));
                        Session::save();
                    } else {
                        return response()->json(['error' => 'Phần trăm chiết khấu phải <= 100']);
                    }
                    return response()->json([
                        'total' => $total,
                        'priceDiscount' => $priceDiscount,
                    ]);
                }
            } else {
                return response()->json(['error' => 'Error: Kiểu chiết khấu không tồn tại']);
            }
        } else {
            return response()->json(['error' => 'Không tồn tại giỏ hàng']);
        }
    }
    //Thêm chi phí
    public function ajaxSaveSessionSurcharge(Request $request)
    {
        $sum = !empty($request->sum) ? $request->sum : 0;
        $title = $request->title;
        $price = $request->price;
        Session::put('surcharge', array('sum' => $sum, 'title' => json_encode($title), 'price' => json_encode($price)));
        Session::save();
        $cart = Session::get('cartPurchases');
        return response()->json($this->loadDataPurchases($cart));
    }
    public function loadDataPurchases($cart =  [], $surchargeSum = 0, $discountSum = 0)
    {
        $taxesArr = [];
        $html = '';
        $htmlVAT = '';
        $quantity = $provisional = 0;
        $total = 0;
        $tax = 0;
        $totalOld = 0;
        if (!empty($cart)) {
            foreach ($cart as $key => $item) {
                $quantity = $quantity + (int)$item['quantity'];
                $provisional = $provisional + ((int)$item['quantity'] * (float)$item['price_taxes']);
                $html .= '<tr class="">';
                $html .= '<td class="" style="text-align:left">';
                $html .= $item['code'];
                $html .= '</td>';
                $html .= '<td class="w-40">';
                $html .= '<div class="flex space-x-2">';
                $html .= '<div class="flex">';
                $html .= '<div class="w-10 h-10 image-fit zoom-in">';
                $html .= '<img alt="' . $item['title'] . '" class="tooltip rounded-full" src="' . $item['image'] . '">';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div>';
                $html .= '<a href="" class="font-medium whitespace-nowrap">' . $item['title'] . '</a>';
                if ($item['taxes_type'] == 'tax') {
                    $html .= '<div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Giá đã bao gồm thuế(' . $item['taxes_import'] . '%)</div>';
                } else if ($item['taxes_type'] == 'notax') {
                    $html .= '<div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Giá chưa bao gồm thuế(' . $item['taxes_import'] . '%)</div>';
                }
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</td>';
                $html .= '<td class="text-center">' . $item['unit'] . '</td>';
                $html .= '<td class="text-center"><input type="number" class="form-control js_updateCartPurchase" value="' . $item['quantity'] . '" data-rowid="' . $key . '"></td>';
                $html .= '<td class="w-40 text-center">';
                $html .= '<input type="text" class="form-control int js_updateCartPricePurchase" value="' . number_format($item['price_taxes'], '0', ',', '.') . '" data-rowid="' . $key . '">';
                $html .= '</td>';
                $html .= '<td class="table-report__action w-56 text-center">';
                $html .= number_format($item['price_taxes'] * $item['quantity'], '0', ',', '.') . 'đ';
                $html .= '</td>';
                $html .= '<td class="table-report__action text-center cursor-pointer html_deletePurchase" >';
                $html .= '<a href="javascript:void(0)" class="js_removeCartPurchase" data-rowid="' . $key . '"><svg viewBox="0 0 20 20" focusable="false" aria-hidden="true" style="fill: red;width:20px;height:20px"> <path d = "M8 3.994c0-1.101.895-1.994 2-1.994s2 .893 2 1.994h4c.552 0 1 .446 1 .997a1 1 0 0 1-1 .997h-12c-.552 0-1-.447-1-.997s.448-.997 1-.997h4zm-3 10.514v-6.508h2v6.508a.5.5 0 0 0 .5.498h1.5v-7.006h2v7.006h1.5a.5.5 0 0 0 .5-.498v-6.508h2v6.508a2.496 2.496 0 0 1-2.5 2.492h-5c-1.38 0-2.5-1.116-2.5-2.492z" > < /path> </svg></a>';
                $html .= '</td>';
                $html .= '</tr>';
                /**$taxes_value = 0;
                $price_taxes = $item['price'];
                if ($item['taxes_type'] == 'tax') {
                    $priceProduct = round($item['quantity'] * $item['price']) / (1 + ($item['taxes_import'] / 100));
                    $taxes_value = round(($priceProduct / 100) * $item['taxes_import']);
                    $price_taxes = round(($item['price']) / (1 + ($item['taxes_import'] / 100)));
                } else if ($item['taxes_type'] == 'notax') {
                    $taxes_value = round((($item['quantity'] * $item['price']) / 100) * $item['taxes_import']);
                }
                $cart[$key] = collect($item)->put('taxes_value', $taxes_value)->put('price_taxes', $price_taxes)->toArray(); */
            }
            $collectCart = collect($cart)->groupBy('taxes_import')->all();
            if (!empty($collectCart)) {
                foreach ($collectCart as $key => $item) {
                    if (!empty($item)) {
                        foreach ($item as $k => $v) {
                            $taxesArr[$key][] = $v['taxes_value'];
                        }
                    }
                }
            }
        }
        if (!empty($taxesArr)) {
            foreach ($taxesArr as $key => $item) {
                if ($key > 0) {
                    $tax = $tax + collect($item)->sum();
                    $htmlVAT .= ' <div class="flex justify-between p-4">';
                    $htmlVAT .= '<span class="font-bold flex-1 text-danger" style="text-align: right;;border:0px">VAT(' . $key . '%)</span>';
                    $htmlVAT .= '<span style="text-align: center;;border:0px;width: 200px;" class="">' . number_format(collect($item)->sum(), '0', ',', '.') . 'đ</span>';
                    $htmlVAT .= '</div>';
                }
            }
        }
        //chiết khấu
        if (!empty($discountSum)) {
            $priceDiscount = !empty($discountSum) ? (float)$discountSum : 0;
        } else {
            $discount = Session::get('discount');
            $priceDiscount = !empty($discount) ? (!empty($discount['price']) ? (float)$discount['price'] : 0) : 0;
        }

        //chi phí
        $surcharge = Session::get('surcharge');
        $priceSurcharge = 0;
        if (!empty($surcharge)) {
            $priceSurcharge = $surcharge['sum'];
        } else {
            $priceSurcharge = $surchargeSum;
        }
        //tổng tiền
        $total = $provisional + $priceSurcharge + $tax - $priceDiscount;
        return [
            'cart' => $cart,
            'html' => $html,
            'htmlVAT' => $htmlVAT,
            'quantity' => $quantity,
            'provisional' => $provisional,
            'priceDiscount' => $priceDiscount,
            'priceSurcharge' => $priceSurcharge,
            'total' => $total
        ];
    }
    public function validateForm(Request $request)
    {
        $products = Session::get('cartPurchases');
        if (empty($products)) {
            return response()->json(['error' => "Vui lòng chọn sản phẩm vào đơn nhập"]);
        }
        $validator = Validator::make($request->all(), [
            'suppliers_id' => 'required',
        ], [
            'suppliers_id.required' => 'Vui lòng thêm nhà cung cấp!.',
        ]);
        if ($validator->passes()) {
            return response()->json(['error' => '']);
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }
}
