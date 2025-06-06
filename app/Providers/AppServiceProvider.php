<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Banner;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $banner = Banner::latest()->first(); // lấy banner mới nhất
        View::share('banner', $banner); // chia sẻ với tất cả view
    }
}



