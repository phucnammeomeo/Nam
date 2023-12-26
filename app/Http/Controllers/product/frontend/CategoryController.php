<?php

namespace App\Http\Controllers\product\frontend;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ConfigPostmeta;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Components\System;
use Illuminate\Support\Facades\DB;
use App\Components\Helper;
use Cache;
use Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->system = new System();
        $this->Helper = new Helper();
    }
    public function index(Request $request, $slug = "", $id = 0)
    {
        $segments = request()->segments();
        $slug = end($segments);
        $sort = '';
        if (!empty($_GET['sort'])) {
            $sort = $_GET['sort'];
        }
        $detail = CategoryProduct::where(['alanguage' => config('app.locale'), 'slug' => $slug, 'publish' => 0]);
        $detail = $detail->with('brands_relationships');
        $detail = $detail->with('attributes_relationships');
        $detail = $detail->first();
        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        // SLIDE:
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

        // $childCategory =  CategoryProduct::where('parentid', $detail->id)->get();
        //bộ lọc
        // $attribute_catalogue = getListAttr($detail->attrid);
        //data product
        $data =  Product::join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')
            ->where('catalogues_relationships.module', '=', 'products')
            ->select('products.id', 'products.slug', 'products.title', 'products.image', 'products.description', 'products.price', 'products.price_sale', 'products.price_contact', 'products.isaside', 'products.unit');;
        if (!empty($detail->id)) {
            $data =  $data->where('catalogues_relationships.catalogueid', $detail->id);
        }
        if (!empty($sort)) {
            $sort = explode('|', $sort);
            if (count($sort) == 2) {
                $data =  $data->orderBy($sort[0], $sort[1]);
            } else {
                return redirect()->route('routerURL', ['slug' => $detail->slug]);
            }
        } else {
            $data =  $data->orderBy('order', 'asc')->orderBy('id', 'desc');
        }
        /*$data = $data->with([
            'products_versions' => function ($q) {
                $q->groupBy('products_versions.product_color_id');
            }
        ]); */
        $data =  $data->paginate(8);
        if (is($sort)) {
            $data->appends(['sort' => $request->sort]);
        }
        //end
        // breadcrumb
        $breadcrumb = CategoryProduct::select('title', 'slug')->where('alanguage', config('app.locale'))->where('lft', '<=', $detail->lft)->where('rgt', '>=', $detail->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        // //lấy nhóm thuộc tính
        // $attribute_tmp = [];
        // if (!empty($detail->attributes_relationships) && count($detail->attributes_relationships) > 0) {
        //     foreach ($detail->attributes_relationships as $item) {
        //         if (!empty($item->attributes)) {
        //             $attribute_tmp[] = array(
        //                 'id' => $item->attributes->id,
        //                 'title' => $item->attributes->title,
        //                 'titleC' => $item->attributes->titleC,
        //                 'keyword' => $item->attributes->slugC,
        //             );
        //         }
        //     }
        // }
        // $attributes = collect($attribute_tmp)->groupBy('titleC')->all();
        // $brandFilter = !empty($detail->brands_relationships) ? $detail->brands_relationships : [];
        $Categories =
            \App\Models\CategoryProduct::select('id', 'title', 'description',  'slug', 'banner')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'parentid' => 0])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->with(['children' => function ($query) {
                $query->with('children');
            }])
            ->get();
            $showMenu = 'hide';
        $seo['canonical'] = $request->url();
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        return view('product.frontend.category.index', compact('fcSystem', 'detail', 'seo', 'breadcrumb', 'data', 'showMenu', 'Categories','slideHome','OurFeatures','partners'));
    }
    public function search(Request $request)
    {
        $historyKeyword = $this->Helper->update_history_keyword();

        $keyword = removeutf8($request->keyword);
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
        $sort = '';
        if (!empty($_GET['sort'])) {
            $sort = $_GET['sort'];
        }
        $data =  Product::where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->select('products.id', 'products.slug', 'products.title', 'products.image', 'products.description', 'products.price', 'products.price_sale', 'products.price_contact', 'products.isaside');

        if (!empty($request->category_id)) {
            $data = $data->join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', 'products');
            $data =  $data->where('catalogues_relationships.catalogueid', $request->category_id);
        }
        if (!empty($keyword)) {
            $data =  $data->where('title', 'like', '%' . $keyword . '%');
        }
        if (!empty($sort)) {
            $sort = explode('|', $sort);
            if (!empty($sort) && count($sort) == 2) {
                $data =  $data->orderBy($sort[0], $sort[1]);
            } else {
                return redirect()->route('search', ['keyword' => $keyword]);
            }
        } else {
            $data =  $data->orderBy('order', 'asc')->orderBy('id', 'desc');
        }
        $data =  $data->paginate(20);
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        if (is($request->category_id)) {
            $data->appends(['category_id' => $request->category_id]);
        }
        if (is($sort)) {
            $data->appends(['sort' => $request->sort]);
        }
        $seo['canonical'] = $request->url();
        $seo['meta_title'] =  "Tìm kiếm sản phẩm";
        $seo['meta_description'] = '';
        $seo['meta_image'] = '';
        $fcSystem = $this->system->fcSystem();
        $attribute_catalogue = \App\Models\CategoryAttribute::where(['ishome' => 1, 'publish' => 0, 'alanguage' => config('app.locale')])->with('listAttr')->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        return view('product.frontend.search.index', compact('fcSystem', 'seo', 'data', 'attribute_catalogue','slideHome','OurFeatures','partners'));
    }
}
