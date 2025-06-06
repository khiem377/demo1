@extends('layouts.admin')

@section('content')
<h2>Danh sách ứng tuyển</h2>

<table class="table">
    <thead>
        <tr>
            <th>Họ tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Ngày nộp</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($applications as $app)
        <tr>
            <td>{{ $app->fullname }}</td>
            <td>{{ $app->email }}</td>
            <td>{{ $app->phone }}</td>
            <td>{{ $app->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>

                <!-- Form Xóa -->
                <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
