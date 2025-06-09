<!-- resources/views/jobs/index.blade.php -->
<!DOCTYPE html>
<html lang="vi">
@yield('scripts')

<head>
    <meta charset="UTF-8" />
    <title>Vị trí ứng tuyển</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 15px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        a.button {
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />


@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
 <!-- @foreach ($banners as $banner)
        <div class="swiper-slide">
            <img src="{{ $banner }}" alt="Banner" style="width: 100%; height: 300px; object-fit: cover;">
        </div>
    @endforeach -->

    <h1 style="text-align:center;">Danh sách Vị trí ứng tuyển</h1>

    <table>
        <thead>
            <tr>
                <th>Tên công việc</th>
                <th>Địa chỉ</th>
                <th>Loại hình</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->address }}</td>
                    <td>{{ ucfirst($job->type) }}</td>
                    <td><a class="button" href="{{ route('jobs.show', $job->id) }}">Chi tiết</a></td>
                </tr>
            @endforeach
        </tbody>
        @yield('scripts')
    </table>

@endsection