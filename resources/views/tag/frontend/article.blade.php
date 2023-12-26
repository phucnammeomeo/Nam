@extends('homepage.layout.home')
@section('content')
<div class="banner-wrapper has_background">
    <img style="width: 100%;" src="{{asset($fcSystem['banner_3'])}}" alt="Tag:
                            {{$detail->title}}" class="img-responsive attachment-1920x447 size-1920x447">
    <div class="banner-wrapper-inner">
        <h1 class="page-title">Tag:
            {{$detail->title}}
        </h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo url('') ?>">Trang chủ</a></li>
                <li><a href="javascript:void(0)" class="trail-item trail-end active">Tag:
                        {{$detail->title}}</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="main-container right-sidebar has-sidebar">
    <!-- POST LAYOUT -->
    <div class="container">
        <div class="row">
            @if($data)
            <div class="main-content col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="blog-standard content-post">
                    @foreach($data as $k => $item)
                    <article class="post-item post-standard post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                        <div class="post-thumb">
                            <a href="{{route('routerURL',['slug' => $item->article->slug])}}"><img src="{{asset($item->article->image)}}" class="img-responsive attachment-1170x768 size-1170x768" alt="{{$item->article->title}}" width="1170" height="768" style="width: 100%;"></a>
                        </div>
                        <div class="post-info">
                            <h2 class="post-title"><a href="{{route('routerURL',['slug' => $item->article->slug])}}">{{$item->article->title}}</a></h2>
                            <div class="post-meta">
                                <div class="date">
                                    <a href="javascript:void(0)">{{ \Carbon\Carbon::parse($item->article->created_at)->format('M')}} {{ \Carbon\Carbon::parse($item->article->created_at)->format('d')}}, {{ \Carbon\Carbon::parse($item->article->created_at)->format('Y')}} </a>
                                </div>
                                @if(!empty($item->article->name))
                                <div class="post-author">
                                    By:<a href="javascript:void(0)"> {{$item->article->name}} </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="post-content">
                            <?php echo $item->article->description ?>
                        </div>
                        <a href="{{route('routerURL',['slug' => $item->article->slug])}}" class="readmore">Xem chi tiết</a>
                    </article>
                    @endforeach

                </div>
                <?php echo $data->links() ?>
            </div>
            @endif

            <div class="sidebar furgan_sidebar col-xl-3 col-lg-4 col-md-12 col-sm-12">
                @include('article.frontend.aside')
            </div>
        </div>
    </div>
</div>
@endsection