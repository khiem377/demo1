@extends('layouts.admin')

@section('content')
<h1>Sửa công việc</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tiêu đề</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
    </div>

    <div class="mb-3">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $job->address) }}" required>
    </div>

    <div class="mb-3">
        <label>Loại hình</label>
        <select name="type" class="form-control" required>
            <option value="fulltime" {{ (old('type', $job->type) == 'fulltime') ? 'selected' : '' }}>Fulltime</option>
            <option value="parttime" {{ (old('type', $job->type) == 'parttime') ? 'selected' : '' }}>Parttime</option>
        </select>
    </div>
<div class="mb-3">
    <label>Mô tả chi tiết</label>
    <textarea id="description" name="description" class="form-control">{{ old('description', $job->description) }}</textarea>
</div>

    <div class="mb-3">
        <label>Mức lương</label>
        <input type="text" name="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
    </div>

    <div class="mb-3">
        <label>Hạn nộp</label>
        <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $job->deadline ? $job->deadline->format('Y-m-d') : '') }}">
    </div>

    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Hủy</a>
</form>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preImg').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

    <script src="./script/script.js"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

@endsection
