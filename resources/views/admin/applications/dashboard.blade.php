<!DOCTYPE html>
<html>
<head>
    <title>Trang Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background: #f2f2f2;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 15px 25px;
            margin: 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        h1 {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trang Admin</h1>
        <a href="{{ route('admin.congty') }}" class="btn">Danh sách công ty</a>
        <a href="{{ route('admin.ungtuyen') }}" class="btn">Danh sách ứng tuyển</a>
    </div>
</body>
</html>
