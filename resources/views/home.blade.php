@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
 <div class="swiper" style="width: 100%; height: 300px;">
  <div class="swiper-wrapper">
    @foreach ($banners as $banner)
      <div class="swiper-slide">
        <img src="{{ $banner }}" alt="Banner" style="width: 100%; height: 300px; object-fit: cover;">
      </div>
    @endforeach
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  <div class="swiper-pagination"></div>
</div>

<h1>Chào mừng đến với Trang Chủ</h1>
<p>Đây là nội dung chính của trang chủ.</p>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>
@endsection
