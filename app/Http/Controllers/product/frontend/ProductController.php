<?php

namespace App\Http\Controllers\product\frontend;

use App\Components\Comment as CommentHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Attribute;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use App\Components\System;
use Session;
use Cache;

class ProductController extends Controller
{
    protected $comment;
    public function __construct()
    {
        $this->comment = new CommentHelper();
        $this->system = new System();
    }
    public function index(Request $request, $slug = "", $id = 0)
    {
        // Session::forget('cart');
        $segments = request()->segments();
        $slug = end($segments);

        $detail = Product::where(['alanguage' => config('app.locale'), 'slug' => $slug, 'publish' => 0])
            ->with(['relationships' => function ($query) {
                $query->select('catalogues_relationships.moduleid', 'category_products.title', 'category_products.id', 'category_products.slug')
                    ->where('module', '=', 'products')
                    ->join('category_products', 'category_products.id', '=', 'catalogues_relationships.catalogueid');
            }])
            ->with('getTags')
            ->with('postmetas')
            ->with('product_versions')
            ->first();

        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        //comment
        $comment_view =  $this->comment->comment(array('id' => $detail->id, 'sort' => 'id'), 'products');

        //end
        //lấy danh mục cha
        $detailCatalogue = $detail->detailCategoryProduct;
        //breadcrumb
        $breadcrumb = [];
        if (!empty($detailCatalogue)) {
            $breadcrumb = CategoryProduct::select('title', 'slug')->where('alanguage', config('app.locale'))->where('lft', '<=', $detailCatalogue->lft)->where('rgt', '>=', $detailCatalogue->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        }
        //lấy brands
        $brand = Brand::select('id', 'title', 'slug')->whereIn('id', $detail->brands->pluck('brand_id'))->first();
        //sản phẩm liên quan
        $productSame =  Product::join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', 'products');
        $productSame =  $productSame->where('catalogues_relationships.catalogueid', $detailCatalogue->id)->where('products.id', '!=', $detail->id);
        $productSame =  $productSame->orderBy('order', 'asc')->orderBy('id', 'desc');
        $productSame =  $productSame->select('id', 'title', 'image', 'slug', 'price', 'price_sale', 'price_contact');
        $productSame =  $productSame->with('getTags');
        $productSame =  $productSame->limit(20);
        $productSame =  $productSame->get();
        //sản phẩm đã Xem
        $recently_viewed = Session::get('products.recently_viewed');
        if (!empty($recently_viewed)) {
            if (!in_array($detail->id, $recently_viewed)) {
                Session::push('products.recently_viewed', $detail->id);
            }
        } else {
            Session::push('products.recently_viewed', $detail->id);
        }
        $showMenu = 'hide';
        $seo['canonical'] =  $request->url();
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        return view('product.frontend.product.index', compact('fcSystem', 'detail', 'seo', 'showMenu', 'productSame', 'detailCatalogue', 'breadcrumb', 'comment_view', 'brand'));
    }
    public function quickView(Request $request)
    {
        $id = $request->id;
        $detail = Product::where(['alanguage' => config('app.locale'), 'id' => $id, 'publish' => 0])
            ->with(['relationships' => function ($query) {
                $query->select('catalogues_relationships.moduleid', 'category_products.title', 'category_products.id', 'category_products.slug')
                    ->where('module', '=', 'products')
                    ->join('category_products', 'category_products.id', '=', 'catalogues_relationships.catalogueid');
            }])
            ->with('getTags')
            ->with('product_versions')
            ->first();
        if (!isset($detail)) {
            return response()->json(['error' => 'Có lỗi xảy ra vui lòng thử lại']);
        }
        $seo['canonical'] =  $request->url();
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        return view('product.frontend.product.data', compact('detail', 'seo'))->render();
    }
}
