@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Quản lý Banner</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($banner)
                    <img src="{{ $banner->image_path }}" alt="Banner" class="img-fluid" style="max-width:100%;">
                @endif

                <form action="{{ route('admin.banners.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="banner" class="form-label">Chọn ảnh banner</label>
                        <input type="file" name="banner" id="banner" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật banner</button>
                </form>

                <!-- Form Xóa Banner -->
                @if($banner)
                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Bạn có chắc chắn muốn xoá banner này không?')">
                            Xoá banner
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @if ($banner)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Banner hiện tại</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset($banner->image_path) }}" alt="Banner" class="img-fluid rounded shadow-sm">
                </div>
            </div>
        @endif
    </div>
@endsection