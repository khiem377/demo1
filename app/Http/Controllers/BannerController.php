<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
  use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::latest()->first();
        return view('admin.banners.index', compact('banner'));
    }



public function upload(Request $request)
{
    $request->validate([
        'banner' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240', // 10MB
    ]);

    // Xoá banner cũ nếu chỉ có 1
    Banner::truncate();

    // Upload lên Cloudinary
    $uploadedFileUrl = Cloudinary::upload($request->file('banner')->getRealPath(), [
        'folder' => 'banner_uploads'
    ])->getSecurePath(); // URL trả về

    // Lưu URL vào DB
    Banner::create([
        'image_path' => $uploadedFileUrl,
    ]);

    return back()->with('success', 'Đã cập nhật banner!');
}


    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        $filePath = public_path($banner->image_path);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $banner->delete();

        return redirect()->back()->with('success', 'Đã xoá banner thành công!');
    }
}
