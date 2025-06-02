<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */public function up()
{
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('job_id');
        $table->string('fullname');
        $table->date('birthday')->nullable();
        $table->string('phone');
        $table->string('email');
        $table->string('cv_file')->nullable();
        $table->timestamps();

        // Khóa ngoại (nếu muốn)
        $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
