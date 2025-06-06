<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Trang Chủ')</title>
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
        }

        .logo {
            font-weight: bold;
            font-size: 24px;
        }

        .logo img {
            width: 120px;
            height: auto;
            display: block;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 600;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        .footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 40px 0 20px 0;
        }

        .footer-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: auto;
        }

        .footer-section {
            flex: 1;
            min-width: 250px;
            margin: 10px;
        }

        .footer-section h4 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .footer-section a {
            color: #bdc3c7;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #7f8c8d;
            font-size: 14px;
        }

        .banner img {
            width: 100%;
            height: 60%;
            display: block;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <header>
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" />
            </div>
            <nav>
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="{{ url('/') }}">Giới thiệu</a></li>
                    <li><a href="{{ route('jobs.index') }}">Vị trí ứng tuyển</a></li>
                    <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                    <li><a href="{{ route('register') }}">Đăng ký</a></li>
                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h4>Về chúng tôi</h4>
                <p>Chúng tôi cung cấp các sản phẩm chất lượng, giá cả hợp lý.</p>
            </div>
            <div class="footer-section">
                <h4>Liên hệ</h4>
                <p>Email: support@domain.com</p>
                <p>Phone: 0123 456 789</p>
            </div>
            <div class="footer-section">
                <h4>Theo dõi</h4>
                <a href="#">Facebook</a><br>
                <a href="#">Instagram</a><br>
                <a href="#">YouTube</a>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 TenWebsite | All rights reserved.
        </div>
    </footer>
</body>

</html>