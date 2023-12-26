<?php

namespace App\Http\Controllers\article\frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cache;
use App\Components\Comment;
use App\Components\System;

class ArticleController extends Controller
{
    protected $comment;
    public function __construct()
    {
        $this->comment = new Comment();
        $this->system = new System();
    }
    public function index($slug = "")
    {
        $segments = request()->segments();
        $slug = end($segments);
        $detail = Article::where('slug', $slug)->where('alanguage', config('app.locale'))
            ->with(['detailCategoryArticle', 'user'])
            ->with(['relationships' => function ($query) {
                $query->select('catalogues_relationships.moduleid', 'category_articles.title', 'category_articles.id', 'category_articles.slug')
                    ->where('module', '=', 'articles')
                    ->join('category_articles', 'category_articles.id', '=', 'catalogues_relationships.catalogueid');
            }])
            ->with(['tags' => function ($query) {
                $query->select('tags.id', 'tags.title', 'tags.slug', 'tags_relationships.module_id')
                    ->join('tags', 'tags.id', '=', 'tags_relationships.tag_id')
                    ->orderBy('order', 'asc')
                    ->orderBy('id', 'desc');
            }])
            ->where('publish', 0)->first();
        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        $detailCatalog = $detail->detailCategoryArticle;
        // breadcrumb
        $breadcrumb = CategoryArticle::select('title', 'slug')->where('alanguage', config('app.locale'))->where('lft', '<=', $detailCatalog->lft)->where('rgt', '>=', $detailCatalog->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        //bài viết liên quan
        $sameArticle =  Article::select('id', 'title', 'slug', 'image', 'description',  'articles.created_at','articles.userid_created')->where('alanguage', config('app.locale'))->where('catalogues_relationships.catalogueid', $detailCatalog->id)->where('catalogues_relationships.moduleid', '!=', $detail['id'])->where('articles.publish', 0)->orderBy('order', 'ASC')->orderBy('id', 'DESC');
        $sameArticle = $sameArticle->join('catalogues_relationships', 'articles.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', 'articles');
        $sameArticle =  $sameArticle->groupBy('catalogues_relationships.moduleid');
        $sameArticle =  $sameArticle->limit(12)->get();
        // SLIDE:
        $slideHome = Cache::remember('slideHome', 600, function () {
            $slideHome = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'slide-home'])->with('slides')->first();
            return $slideHome;
        });

        $OurFeatures = Cache::remember('OurFeatures', 600, function () {
            $OurFeatures = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'OurFeatures'])->with('slides')->first();
            return $OurFeatures;
        });

        $partners = Cache::remember('partners', 600, function () {
            $partners = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'partner'])->with('slides')->first();
            return $partners;
        });

        //cập nhập lượt xem
        DB::table('articles')->where('id', '=', $detail['id'])->update([
            'viewed' => $detail['viewed'] + 1,
        ]);
        //lấy comment
        $comment_view =  $this->comment->comment(array('id' => $detail->id, 'sort' => 'id'), 'articles');
        //lấy fcSystem và menu
        $fcSystem = $this->system->fcSystem();


        $seo['canonical'] = route('routerURL', ['slug' => $slug]);
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();

        return view('article.frontend.article.index', compact('fcSystem', 'detail', 'seo', 'breadcrumb', 'sameArticle', 'detailCatalog', 'comment_view','slideHome','OurFeatures','partners'));
    }
}
