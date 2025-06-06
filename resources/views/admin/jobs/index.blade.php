@extends('layouts.admin')

@section('content')
<h1>Danh sách công việc</h1>

<a href="{{ route('admin.jobs.create') }}" class="btn btn-success mb-3">Thêm công việc mới</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Địa chỉ</th>
            <th>Loại</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jobs as $job)
        <tr>
            <td>{{ $job->title }}</td>
            <td>{{ $job->address }}</td>
            <td>{{ ucfirst($job->type) }}</td>
            <td>
                <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $jobs->links() }}

@endsection
