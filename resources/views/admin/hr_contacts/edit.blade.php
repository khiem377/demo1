@extends('layouts.admin')

@section('content')
    <h1>Sửa Email HR</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hr_contacts.update', $hrContact) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Tên HR (không bắt buộc)</label><br>
        <input type="text" name="name" value="{{ old('name', $hrContact->name) }}"><br><br>

        <label>Email HR (*)</label><br>
        <input type="email" name="email" value="{{ old('email', $hrContact->email) }}" required><br><br>

        <button type="submit">Cập nhật</button>
    </form>

    <br><a href="{{ route('admin.hr_contacts.index') }}">Quay lại danh sách</a>
@endsection
