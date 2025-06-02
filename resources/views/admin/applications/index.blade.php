@extends('layouts.admin')

@section('content')
<h2>Danh sách ứng tuyển</h2>

<table>
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
                <a href="{{ route('admin.applications.show', $app->id) }}">Xem chi tiết</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
