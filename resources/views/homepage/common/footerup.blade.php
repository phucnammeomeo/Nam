<?php

$footerUp = getSlide('footer-up');

?>

@if( $footerUp )

    <div class="icon-box-content border-t-[3px] border-Pimary_color mt-[20px] md:mt-[50px] py-[30px]">

        <div class="container mx-auto px-3">

            <div class="flex flex-wrap justify-center mx-[-10px]">

                @foreach( $footerUp->slides as $key => $val )

                    <div class="w-1/2 md:w-1/4 px-[10px]">

                        <div class="item text-center mb-[10px] md:mb-0">

                            <a href="{{ $val->link!=''?url($val->link):'javacript:void(0)' }}">

                                <div class="icon">

                                    <img src="{{ asset($val->src) }}" alt="{{ $val->title }}" class="inline-block">

                                </div>

                                <h3 class="title-2 mt-[10px]">{{ $val->title }}</h3>

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endif
