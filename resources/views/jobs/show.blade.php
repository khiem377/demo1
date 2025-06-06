<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <title>Chi tiết công việc</title>
    <style>
        .container {
            width: 900px;
            margin: 30px auto;
            font-family: Arial, sans-serif;
            display: flex;
            gap: 30px;
        }

        .left {
            flex: 1 1 70%;
        }

        .left img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .right {
            flex: 1 1 30%;
            border-left: 2px solid #ddd;
            padding-left: 20px;
        }

        .back {
            margin-bottom: 20px;
        }

        a.back-link {
            color: #007bff;
            text-decoration: none;
        }

        a.back-link:hover {
            text-decoration: underline;
        }

        .job-description {
            margin-top: 20px;
        }

        a.button {
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }

        a.button:hover {
            background-color: #0056b3;
        }


        #apply-form {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
            max-width: 700px;
            font-family: Arial, sans-serif;
        }

        #apply-form h3 {
            margin-bottom: 20px;
            color: #333;
            font-size: 20px;
        }

        #apply-form label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        #apply-form input[type="text"],
        #apply-form input[type="email"],
        #apply-form input[type="tel"],
        #apply-form input[type="date"],
        #apply-form input[type="file"],
        #apply-form textarea {
            width: 100%;
            padding: 8px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        #apply-form textarea {
            resize: vertical;
        }

        #apply-form input[type="radio"],
        #apply-form input[type="checkbox"] {
            margin-right: 6px;
        }

        #apply-form small {
            display: block;
            color: #666;
            margin-top: -10px;
            margin-bottom: 15px;
            font-size: 12px;
        }

        #apply-form button.button {
            background-color: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #apply-form button.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

@extends('layouts.app')

@section('title', 'Trang Chủ')


@section('content')
    
    @foreach ($banners as $banner)
        <div class="swiper-slide">
            <img src="{{ $banner }}" alt="Banner" style="width: 100%; height: 300px; object-fit: cover;">
        </div>
    @endforeach
    <div class="container">
        <div class="left">

            <div id="job-info">
                @if($job->image)
                    <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->title }}" />
                @else
                    <img src="{{ asset('images/qc.png') }}" alt="image" />
                @endif
            </div>
            <!-- chuyển md sang cv -->
            <div id="job-description" class="job-description">
                {!! $job->description ?? '<p>Chưa có mô tả chi tiết cho vị trí này.</p>' !!}
            </div>


            @if(session('success'))
                <div style="color: green; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form ứng tuyển ẩn ban đầu -->
            <div id="apply-form" style="display:none; margin-top: 20px;">
                <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h3>Thông tin ứng tuyển</h3>

                    <label>Họ và tên (*)</label><br>
                    <input type="text" name="fullname" required placeholder="Nhập họ tên"><br><br>

                    <label>Ngày sinh</label><br>
                    <input type="date" name="birthday" placeholder="dd/mm/yyyy"><br><br>

                    <label>Điện thoại (*)</label><br>
                    <input type="tel" name="phone" required placeholder="Nhập số điện thoại"><br><br>

                    <label>Email (*)</label><br>
                    <input type="email" name="email" required placeholder="Nhập email"><br><br>

                    <label>Kinh nghiệm làm việc</label><br>
                    <textarea name="experience" rows="4" placeholder="Nhập kinh nghiệm làm việc"></textarea><br><br>
                    <label>CV ứng tuyển</label><br>
                    <input type="radio" name="has_cv" value="1" id="has_cv_yes"> Có CV
                    <input type="radio" name="has_cv" value="0" id="has_cv_no" checked> Không có CV
                    <!-- tích hợp clound libarylibary -->
                    <div id="cv-upload-wrapper" style=" margin-top: 15px;">
                        <input type="file" name="cv_file" accept=".pdf,.doc,.docx">
                    </div>


                    <!-- <input type="file" name="cv_file" accept=".pdf,.doc,.docx"><br> -->
                    <!-- <small>Lưu ý: Sử dụng file PDF, doc, docx. Tối đa 3MB</small><br><br> -->

                    <label>Nguyện vọng làm việc của bạn</label><br>
                    <input type="text" name="desired_salary" placeholder="Nhập thu nhập mong muốn"><br><br>

                    <label>
                        <input type="checkbox" name="agree" required>
                        Tôi đã xem và đồng ý Thông báo chấp thuận xử lý dữ liệu cá nhân trong tuyển dụng & Chính sách
                        bảo mật của Haravan
                    </label><br><br>

                    <button type="submit" class="button">Nộp hồ sơ</button>
                </form>
            </div>
        </div>

        <div class="right">
            <div class="back">
                <a href="{{ route('jobs.index') }}" class="back-link">&larr; Quay lại danh sách</a>
            </div>

            <h1>{{ $job->title }}</h1>

            <p><strong>Địa chỉ:</strong> {{ $job->address }}</p>
            <p><strong>Loại hình:</strong> {{ ucfirst($job->type) }}</p>
            <p><strong>Mức lương:</strong> {{ $job->salary ?? 'Liên hệ' }}</p>
            <p><strong>Hạn nộp:</strong>
                {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') : 'Chưa cập nhật' }}</p>

            <a href="javascript:void(0);" id="apply-btn" class="button">Ứng tuyển</a>
        </div>

        <script>
            document.getElementById('apply-btn').addEventListener('click', function () {
                document.getElementById('job-info').style.display = 'none';
                document.getElementById('job-description').style.display = 'none';
                document.getElementById('apply-form').style.display = 'block';
            });
        </script>
@endsection