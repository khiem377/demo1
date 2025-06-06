<?php
// app/Http/Controllers/JobApplicationController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'has_cv' => 'required|in:0,1',
            'cv_file' => 'required_if:has_cv,1|mimes:pdf,doc,docx|max:5120',
        ]);

        $cvUrl = null;

        if ($request->hasFile('cv_file')) {
            $cvUrl = Cloudinary::uploadFile(
                $request->file('cv_file')->getRealPath(),
                ['resource_type' => 'raw']
            )->getSecurePath();
        }

        JobApplication::create([
            'has_cv' => $request->has_cv,
            'cv_url' => $cvUrl,
        ]);

        return redirect()->back()->with('success', 'Ứng tuyển thành công!');
    }
}
