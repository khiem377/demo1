<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application; // Model lưu thông tin ứng tuyển
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

public function show($id)
{
    $job = Job::findOrFail($id);
    return view('jobs.show', compact('job')); 
}

public function apply(Request $request, $id)
{
    // Validate dữ liệu
    $request->validate([
        'fullname' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email',
        'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:3072',
        'agree' => 'accepted',
    ]);

    // Tạo ứng tuyển mới
    $application = new Application();
    $application->job_id = $id;
    $application->fullname = $request->fullname;
    $application->phone = $request->phone;
    $application->email = $request->email;
    $application->birthday = $request->birthday;
  


    // Xử lý file CV nếu có
    if ($request->hasFile('cv_file')) {
        $file = $request->file('cv_file');
$upload = Cloudinary::uploadFile($file->getRealPath(), [
    'folder' => 'cv_uploads', // Tùy chọn thư mục
    'resource_type' => 'raw'  // Bắt buộc cho file không phải ảnh
]);
$application->cv_file = $upload->getSecurePath(); // URL trả về từ Cloudinary

    }

    // Lưu vào database
    $application->save();

    // Chuyển hướng về trang cũ với thông báo thành công
    return redirect()->back()->with('success', 'Ứng tuyển thành công!');
}

// mô tả 
// app/Http/Controllers/JobController.php
public function store(Request $request)
{
    $request->validate([
        'description' => 'required|string',
    ]);

    // Lưu vào DB hoặc xử lý
    $description = $request->input('description');

    // Ví dụ:
    Job::create(['description' => $description]);

    return redirect()->back()->with('success', 'Đã lưu thành công!');
}
// md -> cv
}