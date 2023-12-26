<?php

$historyKeyword = Session::get('keyword');

$keywordsuggest = getKeywordsuggest();

?>

<div class="z-10 nav-click-search bg-white p-[15px] rounded-[10px]" style="

                                     box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 5px -3px,

                                     rgba(0, 0, 0, 0.14) 0px 8px 10px 1px,

                                     rgba(0, 0, 0, 0.12) 0px 3px 14px 2px;

                                     ">

    @if( isset($historyKeyword) && is_array($historyKeyword) && count($historyKeyword) )

        <h3 class="text-f14 text-gray-600">TÌM KIẾM GẦN ĐÂY</h3>

        <div class="content-search mt-[5px]">

            @foreach( $historyKeyword as $key => $val )

                @if( $key <= 10 )

                    <a href="{{ route('homepage.search') }}?keyword={{ str_replace(' ', '+', $val) }}" class="text-f14 inline-block px-[10px] py-[2px] rounded-[20px] border border-Pimary_color text-Pimary_color mb-[5px] mr-[5px]">{{ $val }}</a>

                @endif

            @endforeach

        </div>

    @endif



    @if($keywordsuggest)

    <div class="box-keywordsuggest">

        <h3 class="text-f14 text-gray-600 mt-[5px]">

            TỪ KHÓA GỢI Ý

        </h3>

        <div class="content-search mt-[5px] render-keywordsuggest">

            @foreach( $keywordsuggest as $key => $val )

                <a href="{{ route('homepage.search') }}?keyword={{ str_replace(' ', '+', $val->title) }}" class="text-f14 inline-block px-[10px] py-[2px] rounded-[20px] border border-Pimary_color text-Pimary_color mb-[5px] mr-[5px]">{{ $val->title }}</a>

            @endforeach

        </div>

    </div>

    @endif

</div>



