@extends('dashboard.layout.dashboard')
@section('title')
<title>Danh mục sản phẩm</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh mục sản phẩm",
        "src" => route('category_products.index'),
    ],
    [
        "title" => "Danh sách",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);

?>
@endsection
@section('content')
<div class="content">
    <h1 class=" text-lg font-medium mt-10">
        Danh mục sản phẩm
    </h1>

    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class=" col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @include('components.search',['module'=>$module,'configIs' => $configIs])
            @can('category_products_create')
            <a href="{{route('category_products.create')}}" class="btn btn-primary shadow-md mr-2">Thêm mới</a>
            @endcan
        </div>
        <!-- BEGIN: Data List -->
        <div class=" col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>

                        <th class="whitespace-nowrap">Stt</th>
                        <th class="whitespace-nowrap">Tiêu đề</th>
                        <th class="whitespace-nowrap">Vị trí</th>
                        <th class="whitespace-nowrap">Người tạo</th>
                        <th class="whitespace-nowrap">Ngày tạo</th>
                        <th class="whitespace-nowrap">Hiển thị</th>
                        @include('components.table.is_thead')
                        <th class="whitespace-nowrap">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $v)
                    <tr class="odd " id="post-<?php echo $v->id; ?>">

                        <td>
                            {{$data->firstItem()+$loop->index}}
                        </td>
                        <td>
                            <a href="{{route('products.index',['catalogueid'=>$v->id])}}">
                                <?php echo str_repeat('|----', (($v->level > 0) ? ($v->level - 1) : 0)) . $v->title; ?>
                                ({{!empty($v->countProduct)?count($v->countProduct):0}})</a><br>
                        </td>
                        @include('components.order',['module' => $module])
                        <td>
                            {{$v->user->name}}
                        </td>
                        <td>
                            @if($v->created_at)
                            {{Carbon\Carbon::parse($v->created_at)->diffForHumans()}}
                            @endif
                        </td>
                        <td class="w-40">
                            @include('components.publishTable',['module' => $module,'title' => 'publish','id' =>
                            $v->id])

                        </td>
                        @include('components.table.is_tbody')
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a href="{{route('routerURL',['slug' => $v->slug])}}" class="text-danger italic mr-3" target="_blank">Xem trước</a>

                                @can('category_products_edit')
                                <a class="flex items-center mr-3" href="{{ route('category_products.edit',['id'=>$v->id]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                @endcan
                                @can('category_products_destroy')
                                <a class="flex items-center text-danger <?php echo !empty($v->countProduct->count() == 0) ? 'ajax-delete' : '' ?> <?php echo ($v->rgt - $v->lft > 1) ? 'disabled' : ''; ?>
                                    <?php echo !empty($v->countProduct->count() == 0) ? '' : 'disabled' ?>" href="javascript:void(0);" data-id="<?php echo $v->id ?>" data-module="<?php echo $module ?>" data-child="0" data-title="Lưu ý: Khi bạn xóa danh mục, danh mục sẽ bị xóa vĩnh viễn. Hãy chắc chắn rằng bạn muốn thực hiện hành động này!">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class=" col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-center">
            {{$data->links()}}
        </div>
        <!-- END: Pagination -->
    </div>
</div>
@endsection