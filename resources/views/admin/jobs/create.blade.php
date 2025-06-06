@extends('layouts.admin')

@section('content')
<h1>Thêm công việc mới</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.jobs.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>
    <div class="mb-3">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
    </div>
    <div class="mb-3">
        <label>Loại công việc</label>
        <select name="type" class="form-select" required>
            <option value="fulltime" {{ old('type') == 'fulltime' ? 'selected' : '' }}>Fulltime</option>
            <option value="parttime" {{ old('type') == 'parttime' ? 'selected' : '' }}>Parttime</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <label>Mức lương</label>
        <input type="text" name="salary" class="form-control" value="{{ old('salary') }}">
    </div>
    <div class="mb-3">
        <label>Hạn nộp hồ sơ</label>
        <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>
@endsection
