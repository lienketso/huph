<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_scores', function (Blueprint $table) {
            $table->id();
            $table->string('identification_number')->nullable()->comment('số báo danh');
            $table->string('cccd_number')->nullable()->comment('số căn cước công dân');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('birthday')->nullable()->comment('Ngày sinh');
            $table->string('test_subject')->nullable()->comment('Đối tượng dự thi');
            $table->string('score_one_name')->nullable()->comment('Tên môn thi 1');
            $table->string('score_one')->nullable()->comment('Điểm môn thi 1');
            $table->string('priority_score_one')->nullable()->comment('Điểm ưu tiên môn thi 1');
            $table->string('total_score_one')->nullable()->comment('Tổng điểm môn thi 1');
            $table->string('score_two_name')->nullable()->comment('Tên môn thi 2');
            $table->string('score_two')->nullable()->comment('Điểm môn thi 2');
            $table->string('priority_score_two')->nullable()->comment('Điểm ưu tiên môn thi 2');
            $table->string('total_score_two')->nullable()->comment('Tổng điểm môn thi 2');
            $table->string('total_scores')->nullable()->comment('Tổng điểm các môn');
            $table->string('admission_year')->default(date('Y'))->comment('Năm tuyển sinh');
            $table->string('comment')->nullable()->comment('Ghi chú');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_scores');
    }
}
