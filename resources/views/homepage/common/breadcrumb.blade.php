@if( $breadcrumb )

    <div class="breadcrumb mb-[30px]">

        <ul class="flex flex-wrap">

            <li class="pr-[5px]">

                <a href="{{ url('/') }}">Trang chủ</a>

            </li>

            @foreach( $breadcrumb as $key => $val )

                <li><span class="per">/</span> <a href="{{ route('routerURL', ['slug' => $val->slug]) }}">{{ $val->title }}</a></li>

            @endforeach

        </ul>

    </div>

@else

    <div class="breadcrumb  mb-[30px]">

        <ul class="flex flex-wrap">

            <li class="pr-[5px]">

                <a href="{{ url('/') }}">Trang chủ</a>

            </li>

            <li><span class="per">/</span> {{ $title }}</li>

        </ul>

    </div>

@endif
