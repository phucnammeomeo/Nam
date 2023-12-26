   <?php
    $asideCategory = Cache::remember('asideCategory', 600, function () {
        $asideCategory = \App\Models\CategoryProduct::select('id', 'title', 'slug')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        return $asideCategory;
    });
    $asideBlogNews = Cache::remember('asideBlogNews', 600, function () {
        $asideBlogNews = \App\Models\CategoryArticle::select('id', 'title', 'description')
            ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'ishome' => 1])
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->with(['posts' => function ($query) {
                $query->limit(5);
            }])
            ->first();
        return $asideBlogNews;
    });
    $OurFeatures = Cache::remember('OurFeatures', 600, function () {
        $OurFeatures = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'OurFeatures'])->with('slides')->first();
        return $OurFeatures;
    });
    $asideTags = Cache::remember('asideTags', 600, function () {
        $asideTags = \App\Models\Tag::select('title', 'id', 'slug')->where(['alanguage' => config('app.locale'), 'publish' => 0])->get();
        return $asideTags;
    });
    ?>
   <div id="widget-area" class="widget-area sidebar-blog">
       <div id="search-3" class="widget widget_search">
           <form role="search" method="get" class="search-form" action="{{route('homepage.search2')}}">
               <input class="search-field" placeholder="Tìm kiếm bài viết…" value="{{request()->get('keyword')}}" name="keyword" type="search">
               <button type="submit" class="search-submit"><span class="fa fa-search" aria-hidden="true"></span></button>
           </form>
       </div>
       @if(!$asideCategory->isEmpty())
       <div id="categories-3" class="widget widget_categories">
           <h2 class="widgettitle">Danh mục sản phẩm<span class="arrow"></span></h2>
           <ul>
               @foreach($asideCategory as $item)
               <li class="cat-item cat-item-51"><a href="{{route('routerURL',['slug' => $item->slug])}}">{{$item->title}}</a>
               </li>
               @endforeach
           </ul>
       </div>
       @endif
       @if($asideBlogNews)
       @if(count($asideBlogNews->posts) > 0)
       <div id="widget_furgan_post-2" class="widget widget-furgan-post">
           <h2 class="widgettitle">{{$asideBlogNews->title}}<span class="arrow"></span></h2>
           <div class="furgan-posts">
               @foreach($asideBlogNews->posts as $item)
               <article class="post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                   <div class="post-item-inner">
                       <div class="post-thumb">
                           <a href="{{route('routerURL',['slug' => $item->slug])}}" tabindex="0">
                               <img src="{{  getImageUrl('articles', $item['image'], 'small') }}" class="img-responsive attachment-83x83 size-83x83" alt="{{$item->title}}" style="width:83px;height: 83px;">
                           </a>
                       </div>
                       <div class="post-info">
                           <div class="block-title">
                               <h2 class="post-title"><a href="{{route('routerURL',['slug' => $item->slug])}}">{{$item->title}}</a></h2>
                           </div>
                           <div class="date">{{ \Carbon\Carbon::parse($item['created_at'])->format('M')}} {{ \Carbon\Carbon::parse($item['created_at'])->format('d')}}, {{ \Carbon\Carbon::parse($item['created_at'])->format('Y')}}</div>
                       </div>
                   </div>
               </article>
               @endforeach
           </div>
       </div>
       @endif
       @endif

       <div id="widget_furgan_socials-2" class="widget widget-furgan-socials">
           <h2 class="widgettitle">{{$fcSystem['title_13']}}<span class="arrow"></span></h2>
           <div class="content-socials">
               <ul class="socials-list">
                   <li>
                       <a href="{{$fcSystem['social_facebook']}}" target="_blank">
                           <span class="fa fa-facebook"></span>
                       </a>
                   </li>
                   <li>
                       <a href="{{$fcSystem['social_instagram']}}" target="_blank">
                           <span class="fa fa-instagram"></span>
                       </a>
                   </li>
                   <li>
                       <a href="{{$fcSystem['social_twitter']}}" target="_blank">
                           <span class="fa fa-twitter"></span>
                       </a>
                   </li>
                   <li>
                       <a href="{{$fcSystem['social_pinterest']}}" target="_blank">
                           <span class="fa fa-pinterest-p"></span>
                       </a>
                   </li>
               </ul>
           </div>
       </div>
       @if($OurFeatures && count($OurFeatures->slides) > 0)
       <div id="widget_furgan_instagram-3" class="widget widget-furgan-instagram">
           <h2 class="widgettitle">{{$OurFeatures->title}}<span class="arrow"></span></h2>
           <div class="content-instagram">
               @foreach($OurFeatures->slides as $key=>$slide)
               <a target="_blank" href="{{url($slide->link)}}" class="item">
                   <img class="img-responsive" src="{{asset($slide->src)}}" alt="hình ảnh {{$key}}">
               </a>
               @endforeach
           </div>
       </div>
       @endif

       @if(!$asideTags->isEmpty())
       <div id="tag_cloud-3" class="widget widget_tag_cloud">
           <h2 class="widgettitle">Tags<span class="arrow"></span></h2>
           <div class="tagcloud">
               @foreach($asideTags as $item)
               <a href="{{route('tagURL',['slug' => $item->slug])}}" class="tag-cloud-link tag-link-46 tag-link-position-1">{{$item->title}}</a>
               @endforeach

           </div>
       </div>
       @endif


   </div><!-- .widget-area -->