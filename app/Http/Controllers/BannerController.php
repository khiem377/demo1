<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'banners.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        foreach ($request->file('banners') as $image) {
            $uploadedUrl = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'banner_uploads'
            ])->getSecurePath();

            Banner::create([
                'image_path' => $uploadedUrl,
            ]);
        }

        return back()->with('success', 'Đã tải lên banner thành công!');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->back()->with('success', 'Đã xoá banner thành công!');
    }
}


namespace App\Http\Controllers;

use App\Models\Banner;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy tất cả banner mới nhất từ DB
        $banners = Banner::latest()->get();

        // Trả về view home, truyền biến $banners
        return view('home', compact('banners'));
    }
}
