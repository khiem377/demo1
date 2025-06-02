<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs')->insert([
            [
                'title' => 'Lập trình viên PHP',
                'address' => 'Hồ Chí Minh',
                'type' => 'fulltime',
                'description' => 'Làm việc với Laravel, PHP, MySQL.',
                'salary' => '15 triệu - 20 triệu',
                'deadline' => '2025-06-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nhân viên Marketing',
                'address' => 'Hà Nội',
                'type' => 'parttime',
                'description' => 'Phát triển kế hoạch marketing online và offline.',
                'salary' => '7 triệu - 10 triệu',
                'deadline' => '2025-06-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Thiết kế đồ họa',
                'address' => 'Đà Nẵng',
                'type' => 'fulltime',
                'description' => 'Thiết kế banner, poster, tài liệu quảng cáo.',
                'salary' => '10 triệu - 13 triệu',
                'deadline' => '2025-07-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
