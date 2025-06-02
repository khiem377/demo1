
 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');       // Tên công việc
            $table->string('address');     // Địa chỉ
            $table->enum('type', ['fulltime', 'parttime']);  // Loại hình
            $table->text('description')->nullable();         // Mô tả chi tiết
            $table->string('salary')->nullable();             // Mức lương
            $table->date('deadline')->nullable();             // Hạn nộp
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
 