@extends('homepage.layout.home')
@section('content')

    <?php
    $data = getDataJson($page->postmetasMany, 'config_colums_json_aboutus');
    ?>

    <div class="container mx-auto px-0 md:px-3">

        <div class="flex flex-wrap justify-between mx-0  md:mx-[-5px]">

            @include('homepage.common.aside')

            <div class="w-full lg:w-4/5 px-0 md:px-[5px]">

                <div class="content-info  bg-white p-[10px]">

                    @include('homepage.common.breadcrumb', ['breadcrumb' => '', 'title' => $page->title])

                    <h2 class="text-f25 font-bold text-Pimary_color mb-[20px]">{{ showField($page->postmetasMany, 'config_colums_input_title') }}</h2>

                    @if( isset($data->image) )
                        @foreach( $data->image as $key => $val )
                            <div class="item-info flex flex-wrap justify-between mx-[-10px] items-center mb-[20px]">
                                <div class="img w-full md:w-1/2 px-[10px] hover-zoom order-1 md:order-{{ $key%2==0?'1':'2' }}">
                                    <img src="{{ $val }}" alt="{{ $page->title }}"/>
                                </div>
                                <div class="nav-img w-full md:w-1/2 px-10px order-2 md:order-{{ $key%2==0?'2':'1' }}">
                                    <div class="content-content">
                                        {!! $data->content[$key] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>

        </div>
    </div>

@endsection

@push('css')
    <style type="text/css">
        .content-content img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: auto !important;
        }
    </style>
@endpush
