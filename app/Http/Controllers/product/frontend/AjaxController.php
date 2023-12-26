<?php

namespace App\Http\Controllers\product\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Components\Comment as CommentHelper;
use Session;

class AjaxController extends Controller
{
    protected $comment;
    public function __construct()
    {
        $this->comment = new CommentHelper();
    }

    public function product_filter(Request $request)
    {
        $data =  Product::select('products.id', 'products.title', 'products.slug', 'products.price', 'products.price_sale', 'products.price_contact', 'products.image', 'products.description')->where('alanguage', config('app.locale'));
        $keyword = $request->keyword;
        $brand = $request->brand;
        $request_attr = $request->attr;
        $sort = $request->sort;

        if (!empty($keyword)) {
            $data =  $data->where('products.title', 'like', '%' . $keyword . '%');
        }
        //xử lý danh mục
        $data = $data->join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', 'products');
        if (!empty($request->catalogueid)) {
            $data =  $data->where('catalogues_relationships.catalogueid', $request->catalogueid);
        }
        //xử lý brand
        if (!empty($brand)) {
            $data = $data->join('brands_relationships', 'products.id', '=', 'brands_relationships.product_id');
            $data =  $data->whereIn('brands_relationships.brand_id', $brand);
        }
        //xử lý khoảng giá
        $start_price = !empty($request->start_price) ? $request->start_price : 0;
        $end_price = !empty($request->end_price) ? $request->end_price : 0;
        if (isset($start_price) && !empty($end_price)) {
            $data =  $data->where('products.price', '>=', $start_price * 1000000);
            $data =  $data->where('products.price', '<=', $end_price * 1000000);
        }
        //xử lý thuộc tính
        if (!empty($request_attr)) {
            $attr = explode(';', $request_attr);
            foreach ($attr as $key => $val) {
                if ($key % 2 == 0) {
                    if ($val != '') {
                        $attribute[$val][] = $attr[$key + 1];
                    }
                } else {
                    continue;
                }
            }
            $total = 0;
            $index = 100;
            foreach ($attribute as $key => $val) {
                $total++;
                $index++;
                foreach ($val as $subs) {
                    $index = $index + $total;
                    $data = $data->join('attributes_relationships as tb' . $index . '', 'products.id', '=', 'tb' . $index . '.product_id');
                }
                $data =  $data->whereIn('tb' . $index . '.attribute_id', $val);
            }
            $data =  $data->groupBy('tb102.product_id');
        }
        $data =  $data->groupBy('catalogues_relationships.moduleid');
        //sort
        if (!empty($sort)) {
            $sort = explode('|', $sort);
            if (count($sort) == 2) {
                $data =  $data->orderBy('products.' . $sort[0], $sort[1]);
            }
        } else {
            $data =  $data->orderBy('products.id', 'desc');
        }
        $data =  $data->paginate(28);
        //render HTML
        $html = '';
        $paginate = '';
        foreach ($data as $k => $item) {
            $html .= '<li class="product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">' . htmlProduct($k, $item) . '</li>';
        }
        $paginate .= $data->links();
        echo json_encode(['html' => $html, 'paginate' => $paginate, 'total' => $data->total()]);
        die;
    }

    //load data version khi load trang
    public function product_version(Request $request)
    {
        $type = 'simple';
        $attr = collect(json_decode($request->attr))->sort();
        $module_id = $request->module_id;
        $stt = $request->stt;
        $detailProduct = Product::findOrFail($module_id);
        if (empty($detailProduct)) {
            echo 500;
            die();
        }
        if (!empty($stt)) {
            $data = \App\Models\ProductVersion::where(['product_id' => $module_id]);
            if (!empty($attr)) {
                foreach ($attr as $item) {
                    $data = $data->whereJsonContains('id_version', (int)$item);
                }
            }
            $data = $data->first();
            $idOutStock = [];
            $idStock = 0;
            if ($data) {
                $idStock = collect(json_decode($data->id_version, TRUE))->sort()->filter(function ($value, $key) use ($attr) {
                    return $key == count($attr) - 1;
                })->join('');
                $type = 'variable';
            }
        } else {
            $filterAttr = $attr->filter(function ($value, $key) use ($attr) {
                return $key < count($attr) - 1;
            });
            $filterAttr->all();
            $data = \App\Models\ProductVersion::where(['product_id' => $module_id]);
            if (!empty($filterAttr)) {
                foreach ($filterAttr as $item) {
                    $data = $data->whereJsonContains('id_version', (int)$item);
                }
            }
            $data = $data->orderBy('id', 'desc')->get();
            $idOutStock = [];
            $idStock = 0;
            if (!$data->isEmpty()) {
                foreach ($data as $item) {
                    if ($item['_stock_status'] == 1 && $item['_outstock_status']  == 0 && $item['_stock'] == 0) {
                        $idOutStock[] = (int)collect(json_decode($item->id_version, TRUE))->sort()->filter(function ($value, $key) use ($attr) {
                            return $key == count($attr) - 1;
                        })->join('');
                    }
                }
                foreach ($data as $item) {
                    if ($item['_stock_status'] == 1 && $item['_outstock_status']  == 0 && $item['_stock'] == 0) {
                        $data = $item;
                    } else if ($item['_stock_status'] == 1 && $item['_outstock_status']  == 0 && $item['_stock'] > 0) {
                        $data = $item;
                        $idStock = collect(json_decode($item->id_version, TRUE))->sort()->filter(function ($value, $key) use ($attr) {
                            return $key == count($attr) - 1;
                        })->join('');
                        break;
                    } else if ($item['_stock_status'] == 0) {
                        $data = $item;
                        $idStock = collect(json_decode($item->id_version, TRUE))->sort()->filter(function ($value, $key) use ($attr) {
                            return $key == count($attr) - 1;
                        })->join('');
                        break;
                    }
                }
                $type = 'variable';
            }
        }
        echo json_encode(['data' => $data, 'idOutStock' => $idOutStock, 'idStock' => $idStock, 'type' => $type]);
        die;
    }

    public function load_more_product( Request $request ){

        $cart = Session::get('cart');
        $data = [];
        (int)$id = $request->id;
        (int)$count = $request->count;
        (int)$limit = $request->limit;
        $html = '';
        if( $id > 0 ){
            $data = \App\Models\Product::select('id', 'title', 'image', 'price', 'price_sale', 'slug', 'price_contact', 'price_import')
                ->join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')
                ->where(['products.publish' => 0, 'catalogueid' => $id, 'module' => 'products'])
                ->orderBy('products.order', 'asc')
                ->orderBy('products.id', 'desc')
                ->skip($count)->take($limit)->get();
        }
        if( $data ){
            foreach ( $data as $key => $val ){
                $html .= '<div class="w-1/2 md:w-1/4 lg:w-1/5 px-[10px]">';
                $html .= htmlItemProduct($val, checkProductIncart($val->id, $cart));
                $html .= '</div>';
            }
        }

        $check = $this->check_load_more($id, $count+$limit, $limit);

        echo json_encode(array(
            'html' => $html,
            'check' => $check,
            'count' => $count+$limit,
        ));die();
    }

    public function check_load_more( $id, $count, $limit ){

        $data = [];
        $html = '';
        if( $id > 0 ){
            $data = \App\Models\Product::select('id', 'title', 'image', 'price', 'price_sale', 'slug', 'price_contact', 'price_import')
                ->join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')
                ->where(['products.publish' => 0, 'catalogueid' => $id, 'module' => 'products'])
                ->orderBy('products.order', 'asc')
                ->orderBy('products.id', 'desc')
                ->skip($count)->take($limit)->get();
        }
        if( !$data->isEmpty() ){
            return true;
        }
        return false;
    }
}
