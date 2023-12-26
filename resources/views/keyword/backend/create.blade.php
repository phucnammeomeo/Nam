@extends('dashboard.layout.dashboard')
@section('title')
    <title>Thêm mới từ gợi ý</title>
@endsection
@section('breadcrumb')
    <?php
    $array = array(
        [
            "title" => "Danh sách từ gợi ý",
            "src" => route('keywords.index'),
        ],
        [
            "title" => "Thêm mới",
            "src" => 'javascript:void(0)',
        ]
    );
    echo breadcrumb_backend($array);
    ?>
@endsection

@section('content')
    <div class="content">
        <div class=" flex items-center mt-8">
            <h1 class="text-lg font-medium mr-auto">
                Thêm mới từ gợi ý
            </h1>
        </div>
        <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{route('keywords.store')}}" method="post" enctype="multipart/form-data">
            <div class=" col-span-12 lg:col-span-12">
                <ul class="nav nav-link-tabs flex-wrap" role="tablist">
                    <li id="example-homepage-tab" class="nav-item" role="presentation">
                        <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-homepage" type="button" role="tab" aria-controls="example-tab-homepage" aria-selected="true">Thông tin chung</button>
                    </li>
                    @if(!$field->isEmpty())
                        <li id="example-contact-tab" class="nav-item " role="presentation">
                            <button class="nav-link w-full py-2 " data-tw-toggle="pill" data-tw-target="#example-tab-contact" type="button" role="tab" aria-controls="example-tab-contact" aria-selected="true">Custom field</button>
                        </li>
                    @endif
                </ul>
                <!-- BEGIN: Form Layout -->
                <div class=" box p-5">
                    @include('components.alert-error')
                    @csrf
                    <div class="tab-content">
                        <div id="example-tab-homepage" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-homepage-tab">
                            <div>
                                <label class="form-label text-base font-semibold">Tiêu đề từ khoá</label>
                                <?php echo Form::text('title', '', ['class' => 'form-control w-full title']); ?>
                            </div>
                        </div>
                        <div id="example-tab-contact" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-contact-tab">
                            @include('components.field.index', ['module' => $module])
                        </div>
                    </div>
                </div>


                @include('components.publish')

                <div class=" box p-5 mt-3">
                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24">Lưu</button>
                    </div>
                </div>

                <!-- END: Form Layout -->
            </div>
        </form>
    </div>
@endsection