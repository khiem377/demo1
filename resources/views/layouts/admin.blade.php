<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand mb-0 h1">Trang quản trị</span>

        <form action="{{ route('logout') }}" method="POST">
            |<a href="{{ route('home') }}" class="btn btn-outline-light btn-sm me-2">Trang chủ</a>
            @csrf
            <button class="btn btn-outline-light btn-sm">Đăng xuất</button>
             <button class="btn btn-outline-light btn-sm">Thông tin tài khoản</button>
        </form>
    </nav>




    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-primary me-2">Danh sách công việc</a>
            <a href="{{ route('admin.applications.index') }}" class="btn btn-success me-2">Danh sách ứng tuyển</a>
            <a href="{{ route('admin.banners.index') }}" class="btn btn-warning">Quản lý banner</a> {{-- ✅ Nút mới thêm --}}
        </div>

        <div class="card p-3">
            @yield('content')
        </div>
    </div>
</body>

</html>