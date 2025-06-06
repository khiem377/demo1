@php
    $banner = \App\Models\Banner::latest()->first()?->image_path 
              ?? asset('images/banner.jpg');
@endphp
@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
    <div class="banner">
       <img src="{{ asset($banner) }}" alt="Banner" style="width: 100%; height: 300px; object-fit: cover;">
    </div>

    <h1>Chào mừng đến với Trang Chủ</h1>
    <p>Đây là nội dung chính của trang chủ.</p>



    
    <!-- scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        // Slider using Slick
        $(document).ready(function() {
            $('.post-wrapper').slick({
                slidesToScroll: 1,
                autoplay: true,
                arrows: true,
                dots: true,
                autoplaySpeed: 5000,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                appendDots: $(".dot"),
            });
        });
    </script>

    <!-- Firebase config -->
 

    <script src="./script/script.js"></script>
</body>
@endsection