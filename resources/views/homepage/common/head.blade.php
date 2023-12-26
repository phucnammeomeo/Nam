
{{--New--}}
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.2/dist/flowbite.min.css"/>
<!-- <link rel="stylesheet" href="fonts/font.css"> -->
<link rel="stylesheet" href="{{ asset('frontend/build/tailwind.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/build/app.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}" />

<link rel="stylesheet" href="{{asset('library/toastr/toastr.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/demo.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/_header.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/_footer.css') }}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}"/>
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>

<?php $shipLocation = Session::get('location'); ?>
@push('javascript')
    <script>
        var cityid = '<?php echo ( isset($shipLocation) && is_array($shipLocation) && count($shipLocation) ) ? $shipLocation['cityid'] : ''; ?>';
        var districtid = '<?php echo ( isset($shipLocation) && is_array($shipLocation) && count($shipLocation) ) ? $shipLocation['districtid'] : ''; ?>';
        var wardid = '<?php echo ( isset($shipLocation) && is_array($shipLocation) && count($shipLocation) ) ? $shipLocation['wardid'] : ''; ?>';
    </script>

@endpush
