<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application; // Model lưu thông tin ứng tuyển

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
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads/cvs'), $filename);
        $application->cv_file = $filename;
    }

    // Lưu vào database
    $application->save();

    // Chuyển hướng về trang cũ với thông báo thành công
    return redirect()->back()->with('success', 'Ứng tuyển thành công!');
}}