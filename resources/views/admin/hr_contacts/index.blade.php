@extends('layouts.admin')

@section('content')
    <h1>Danh sách Email HR</h1>
    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif
    <a href="{{ route('admin.hr_contacts.create') }}">Thêm email HR mới</a>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 10px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên HR</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hrs as $hr)
            <tr>
                <td>{{ $hr->id }}</td>
                <td>{{ $hr->name ?? '-' }}</td>
                <td>{{ $hr->email }}</td>
                <td>
                    <a href="{{ route('admin.hr_contacts.edit', $hr) }}">Sửa</a> |
                    <form action="{{ route('admin.hr_contacts.destroy', $hr) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
