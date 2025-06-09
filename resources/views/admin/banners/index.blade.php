@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Quản lý Banner</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.banners.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="banners" class="form-label">Chọn nhiều ảnh banner</label>
            <input type="file" name="banners[]" id="banners" class="form-control" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Tải lên banner</button>
    </form>

    <hr>

    <h3>Danh sách banner hiện có</h3>
    <div class="row">
        @foreach ($banners as $banner)
            <div class="col-md-4 mb-3">
                <img src="{{ $banner->image_path }}" alt="Banner" class="img-fluid rounded shadow-sm" style="width: 100%; height: 200px; object-fit: cover;">
                <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn xoá banner này?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm mt-2 w-100">Xoá</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
      delay: 3000,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1,
  });
</script>
@endsection
