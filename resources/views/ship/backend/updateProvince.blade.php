@extends('dashboard.layout.dashboard')

@section('title')
    <title>Cập nhập từ gợi ý</title>
@endsection
@section('breadcrumb')
    <?php
    $array = array(
        [
            "title" => "Danh sách phí vận chuyển",
            "src" => route('keywords.index'),
        ],
        [
            "title" => "Cập nhập",
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
                Cập nhập phí vận chuyển {{ $detail->name }}
            </h1>
        </div>

        <form class="grid grid-cols-12 gap-6 mt-5" role="form" action="{{ route('ships.update_province', ['id' => $detail->id]) }}?" method="post" enctype="multipart/form-data">
            <div class=" col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <div class=" box p-5">
                    @include('components.alert-error')
                    @csrf

                    <div class="tab-content">
                        <div id="example-tab-homepage" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-homepage-tab">
                            <div>
                                <label class="form-label text-base font-semibold">Giá vận chuyển</label>
                                <?php echo Form::text('price', $detail->price, ['class' => 'form-control w-full']); ?>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label text-base font-semibold">Nội dung</label>
                            <div class="mt-2">
                                <?php echo Form::textarea('description', $detail->description, ['id' => 'ckContent', 'class' => 'ck-editor', 'style' => 'font-size:14px;line-height:18px;border:1px solid #ddd;padding:10px']); ?>
                            </div>
                        </div>
                    </div>
                </div>


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