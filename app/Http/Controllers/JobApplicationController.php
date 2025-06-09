<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;  // đổi JobApplication thành Application
use App\Models\HRContact;
use Illuminate\Support\Facades\Mail;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class JobApplicationController extends Controller
{
    public function store(Request $request, $jobId)
    {
        $job = Job::findOrFail($jobId);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'experience' => 'nullable|string',
            'has_cv' => 'required|in:0,1',
            'cv_file' => 'required_if:has_cv,1|mimes:pdf,doc,docx|max:5120',
            'desired_salary' => 'nullable|string|max:255',
            'agree' => 'required|accepted',
        ]);

        $cvUrl = null;
        if ($request->hasFile('cv_file')) {
            $cvUrl = Cloudinary::uploadFile(
                $request->file('cv_file')->getRealPath(),
                ['resource_type' => 'raw']
            )->getSecurePath();
        }

        $application = Application::create([
            'job_id' => $job->id,
            'fullname' => $request->fullname,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'email' => $request->email,
            'experience' => $request->experience,
            'has_cv' => $request->has_cv,
            'cv_url' => $cvUrl,
            'desired_salary' => $request->desired_salary,
            'agree' => true,
        ]);

        // Lấy danh sách email HR
        $hrEmails = HRContact::pluck('email')->toArray();

        // Gửi mail từng HR
        foreach ($hrEmails as $email) {
            Mail::raw(
                "Ứng viên mới vừa nộp hồ sơ:\n
- Họ tên: {$request->fullname}
- Ngày sinh: {$request->birthday}
- SĐT: {$request->phone}
- Email: {$request->email}
- Kinh nghiệm: {$request->experience}
- Nguyện vọng: {$request->desired_salary}
- CV: " . ($cvUrl ?? 'Không có CV'),
                function ($message) use ($email, $request) {
                    $message->to($email)
                        ->replyTo($request->email)
                        ->subject('Có ứng viên mới vừa nộp hồ sơ');
                }
            );
        }

        return redirect()->back()->with('success', 'Ứng tuyển thành công! Email đã được gửi đến phòng nhân sự.');
    }
}
