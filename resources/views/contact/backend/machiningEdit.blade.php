@extends('dashboard.layout.dashboard')
@section('title')
<title>Chi tiết yêu cầu gia công</title>
@endsection
@section('breadcrumb')
<?php
$array = array(
    [
        "title" => "Danh sách yêu cầu gia công",
        "src" => route('machining.index'),
    ],
    [
        "title" => "Chi tiết",
        "src" => 'javascript:void(0)',
    ]
);
echo breadcrumb_backend($array);
?>
@endsection
@section('content')
<?php
$data = json_decode($detail->machining, TRUE);
$title = [
    'chatlieu' => 'Chất liệu',
    'solop' => 'Số lớp',
    'kichthuoc' => 'Kích thước',
    'soluong' => 'Số lượng',
    'loaimachkhac' => 'Loại mạch khác	',
    'pcb' => 'Ghép PCB',
    'doday' => 'Độ dày',
    'colorboard' => 'Màu board',
    'mauchu' => 'Màu chữ',
    'kieuma' => 'Kiểu mạ',
    'dodaydong' => 'Độ dày đồng',
    'thoigian' => 'Thời gian',
    'hanlinhkien' => 'Hàn linh kiện',
    'stencil' => 'Đặt stencil',
]
?>
<div class="content">

    <div class="box mt-5">

        <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
            <div>
                <div class="text-base text-slate-500">From</div>
                <div class="text-lg font-medium text-primary mt-2">{{$detail->fullname}}</div>
                <div class="mt-1">{{$detail->phone}}</div>
                <div class="mt-1">{{$detail->address}}</div>
                <div class="mt-1">{{$detail->email}}</div>
                <div class="mt-1">Ghi chú: {{$detail->message}}</div>
            </div>
            @if(File::exists(base_path($detail->file)))
            <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                <div class="text-base text-slate-500">File Upload</div>
                <div class="text-lg font-medium text-primary mt-2">
                    <a href="{{asset($detail->file)}}">Tải file</a>
                </div>
            </div>
            @endif

        </div>
        <div class="px-5 sm:px-16 pb-10 sm:pb-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">Tiêu đề</th>
                            <th class="border-b-2 dark:border-darkmode-400 text-right whitespace-nowrap">Nội dung</th>

                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($data))
                        @foreach($data as $key=>$item)
                        <tr>
                            <td class="border-b dark:border-darkmode-400">
                                <div class="font-medium whitespace-nowrap">{{$title[$key]}}</div>
                            </td>
                            <td class="text-right border-b dark:border-darkmode-400 w-32">
                                @if($key == 'kichthuoc')
                                <?php echo collect(json_decode($item, TRUE))->join('x', ' ') ?>
                                @else
                                {{$item}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection