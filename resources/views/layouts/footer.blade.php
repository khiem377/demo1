<header>
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
    </div>

    <nav>
        <ul>
            <li><a href="/">Trang chủ</a></li>
            <li><a href="{{ url('/gioi-thieu') }}">Giới thiệu</a></li>
            <li><a href="{{ url('/') }}">Quyền lợi</a></li>
            <li><a href="{{ route('jobs.index') }}">Vị trí ứng tuyển</a></li>
            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
            <li><a href="{{ route('register') }}">Đăng ký</a></li>
        </ul>
    </nav>
</header>
