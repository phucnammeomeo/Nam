<?php

namespace App\Http\Controllers\page\frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Components\System;
use Carbon\Carbon;
use Validator;

class PageController extends Controller
{
    public function __construct()
    {
        $this->system = new System();
    }
    public function aboutUs()
    {
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'aboutus', 'publish' => 0])->with('postmetasMany')
            ->select('id', 'meta_title', 'meta_description', 'image', 'title', 'description')->first();
        if (!isset($page)) {
            return redirect()->route('homepage.index');
        }
        $showMenu = 'hide';
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.aboutus', compact('seo', 'page', 'showMenu', 'fcSystem'));
    }
    public function products()
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'products', 'publish' => 0])
            ->select('meta_title', 'meta_description', 'image', 'title', 'description')
            ->first();
        if (!isset($page)) {
            return redirect()->route('homepage.index');
        }

        $sort = '';
        if (!empty($_GET['sort'])) {
            $sort = $_GET['sort'];
        }
        $data = \App\Models\Product::where(['alanguage' => config('app.locale'), 'publish' => 0])
            ->select('products.id', 'products.slug', 'products.title', 'products.image', 'products.description', 'products.price', 'products.price_sale', 'products.price_contact', 'products.isaside', 'products.unit');
        if (!empty($sort)) {
            $sort = explode('|', $sort);
            if (count($sort) == 2) {
                $data =  $data->orderBy($sort[0], $sort[1]);
            } else {
                return redirect()->route('pages.products');
            }
        } else {
            $data =  $data->orderBy('order', 'asc')->orderBy('id', 'desc');
        }
        $data =  $data->paginate(20);
        $showMenu = 'hide';
        // $seo['canonical'] = route('pages.products');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.products', compact('seo', 'page', 'showMenu', 'fcSystem',  'data'));
    }
}
