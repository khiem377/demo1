<div class="mb-3">
    <label for="description">Mô tả chi tiết</label>
    <textarea id="description" name="description" class="form-control">{{ old('description', $job->description ?? '') }}</textarea>
</div>

<!-- Tích hợp TinyMCE bằng CDN -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#description',
        height: 400,
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak code',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
        menubar: false,
        branding: false,
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave(); // Giúp Laravel nhận đúng nội dung đã sửa
            });
        }
    });
</script>
