@extends('homepage.layout.home')
@section('content')
    <div class="container mx-auto px-3">

        <div class="content-new mt-[30px] bg-white ">
            <div class="title-title bg-Pimary_color py-[8px] px-[15px]">

                <a href="" class="text-white font-bold">{{$detail->title}}</a>
            </div>
            <div class="flex flex-wrap justify-center mx-[-5px] md:mx-[-10px] p-[10px]">
                @foreach($data as $k => $item)

                    <div class="w-full md:w-1/3 px-[5px] md:px-[10px]">
                        <div class="item border border-gray-300 mb-[15px] md:mb-[20px]">

                            <div class="img hover-zoom">
                                <a href="{{route('routerURL',['slug' => $item->slug])}}">
                                    <img src="{{asset($item->image)}}" alt="{{$item->title}}"
                                         class="w-full object-cover">
                                </a>
                            </div>
                            <div class="p-[15px]">
                                <h3 class="text-f15 font-bold  overflow-hidden" style="
                    text-overflow: ellipsis;
                    line-height: 20px;
                    -webkit-line-clamp: 2;
                    height: 40px;
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    ">
                                    <a href="{{route('routerURL',['slug' => $item->slug])}}"
                                       class="hover:text-Pimary_color transition-all">
                                        {{$item->title}}</a>
                                </h3>
                                <ul class="admin-date flex flex-wrap text-gray-500 my-[10px]">
                                    @if(!empty($item->name))
                                        <li class="mr-[10px]"><span class="mr-[5px]"><i
                                                        class="fa-solid fa-user"></i></span>{{$item->name}}</li>
                                    @endif
                                    <li><span class="mr-[5px]"><i
                                                    class="fa-solid fa-calendar-days"></i></span>{{ \Carbon\Carbon::parse($item['created_at'])->format('M')}} {{ \Carbon\Carbon::parse($item['created_at'])->format('d')}}
                                        , {{ \Carbon\Carbon::parse($item['created_at'])->format('Y')}}</li>
                                </ul>
                                <div class="article-desc overflow-hidden" style=" text-overflow: ellipsis;
                            line-height: 20px;
                            -webkit-line-clamp: 3;
                            height: 60px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;">
                                    <?php echo $item->description ?>
                                </div>
                                <a href="{{route('routerURL',['slug' => $item->slug])}}"
                                   class="readmore bg-Pimary_color py-[6px] px-[10px] text-white rounded-[5px] mt-[10px] inline-block border border-Pimary_color transition-all hover:text-Pimary_color hover:bg-white">Xem
                                    thêm<i class="fa-solid fa-angles-right text-f10 ml-[5px]"></i></a>
                            </div>


                        </div>
                    </div>

                @endforeach

            </div>

            <div class="pagenavi wow fadeInUp mt-[20px] pb-[20px]">
                {{-- Phân trang --}}
                <?php echo $data->links() ?>
            </div>
        </div>

    </div>

@endsection

@push('javascript')

@endpush
