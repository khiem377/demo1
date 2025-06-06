@extends('layouts.admin')

@section('content')
<h2>Chi tiết ứng tuyển</h2>

<ul>
    <li><strong>Họ tên:</strong> {{ $application->fullname }}</li>
    <li><strong>Email:</strong> {{ $application->email }}</li>
    <li><strong>SĐT:</strong> {{ $application->phone }}</li>
    <li><strong>Ngày sinh:</strong> {{ $application->birthday }}</li>
    <li><strong>Ngày nộp:</strong> {{ $application->created_at->format('d/m/Y H:i') }}</li>
    <li>
        <strong>CV:</strong>
        @if($application->cv_file)
      <!-- không dùng asset() -->
<a href="{{ $application->cv_file }}" target="_blank">Xem CV</a>
        @else
            Không có file CV
        @endif
    </li>
</ul>

<a href=\"{{ route('admin.applications.index') }}\">← Quay lại danh sách</a>
@endsection
