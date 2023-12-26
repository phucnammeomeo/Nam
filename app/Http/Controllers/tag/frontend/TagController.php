<?php

namespace App\Http\Controllers\tag\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Tags_relationship;
use App\Components\System;

class TagController extends Controller
{
    public function __construct()
    {
        $this->system = new System();
    }
    public function index(Request $request, $slug = "")
    {
        $detail = Tag::select('id', 'title', 'slug', 'module', 'image')->where(['alanguage' => config('app.locale'), 'slug' => $slug, 'publish' => 0])->first();
        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        $module = $detail->module;
        $data = Tags_relationship::where(['module' => $module, 'tag_id' => $detail->id])->select('module_id');
        if ($module == 'articles') {
            $data = $data
                ->with(['article' => function ($query) {
                    $query->select('users.name', 'articles.id', 'articles.title', 'articles.description', 'articles.slug', 'articles.image', 'articles.created_at', 'articles.userid_created')
                        ->join('users', 'users.id', '=', 'articles.userid_created');
                }])
                ->paginate(6);
            $view = 'tag.frontend.article';
        } else if ('products') {
            $data = $data->pluck('module_id');
            $sort = '';
            if (!empty($_GET['sort'])) {
                $sort = $_GET['sort'];
            }
            $data =  \App\Models\Product::where(['alanguage' => config('app.locale'), 'publish' => 0])
                ->whereIn('id', $data)
                ->select('products.id', 'products.slug', 'products.title', 'products.image', 'products.description', 'products.price', 'products.price_sale', 'products.price_contact', 'products.isaside');
            if (!empty($sort)) {
                $sort = explode('|', $sort);
                if (!empty($sort) && count($sort) == 2) {
                    $data =  $data->orderBy($sort[0], $sort[1]);
                } else {
                    return redirect()->route('tagURL', ['slug' => $detail->slug]);
                }
            } else {
                $data =  $data->orderBy('order', 'asc')->orderBy('id', 'desc');
            }
            $data =  $data->paginate(32);
            $view = 'tag.frontend.product';
        }
        $seo['canonical'] =  $request->url();
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        return view($view, compact('fcSystem', 'detail', 'seo', 'data'));
    }
}
