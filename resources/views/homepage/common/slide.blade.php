@if ($slideHome && count($slideHome->slides) > 0)
<div class="w-full lg:w-4/5 px-0 md:px-[5px]">
    <div class="content-right">
        <div class="banner">
            <div class="slider-home owl-carousel">
                @foreach ($slideHome->slides as $slide)
                <div class="item">
                    <a href="{{ $slide->link }}"><img src="{{ asset($slide->src) }}" alt="{{ $slide->title }}" /></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="w-1/5 px-[5px]" style="display: none">
    <div class="ads-right-1">
        <div class="img hover-zoom">
            <a href=""><img src="img/ads-1.png" alt=""/></a>
        </div>
        <div class="img hover-zoom">
            <a href=""><img src="img/ads-2.png" alt=""/></a>
        </div>
    </div>
</div>
@endif
