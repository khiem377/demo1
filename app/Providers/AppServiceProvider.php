<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Banner;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Đăng ký bất kỳ dịch vụ nào.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap mọi dịch vụ ứng dụng.
     */
    //lấy baner từ url clound
    // public function boot()
    // {
    //     View::share('banner', Banner::latest()->first()?->image_path ?? 'https://res.cloudinary.com/your-cloud-name/image/upload/v1234567890/default-banner.jpg');
    // }
    public function boot()
{
    // Lấy tất cả banner mới nhất, ví dụ limit 10
    $banners = Banner::latest()->take(10)->get()->pluck('image_path');

    View::share('banners', $banners);
}
}
