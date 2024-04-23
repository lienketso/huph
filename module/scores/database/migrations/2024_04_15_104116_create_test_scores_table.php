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
            $table->string('name')->nullable();
            $table->string('identification_number')->nullable()->comment('số báo danh');
            $table->string('cccd_number')->nullable()->comment('số căn cước công dân');
            $table->string('birthday')->nullable()->comment('Ngày sinh');
            $table->string('test_subject')->nullable()->comment('Đối tượng dự thi');
            $table->tinyInteger('biology_scores')->default(0)->comment('Điểm môn sinh');
            $table->tinyInteger('priority_biology_scores')->default(0)->comment('Điểm ưu tiên môn sinh');
            $table->tinyInteger('math_scores')->default(0)->comment('Điểm môn toán thống kê');
            $table->tinyInteger('priority_math_scores')->default(0)->comment('Điểm ưu tiên môn toán thống kê');
            $table->tinyInteger('english_scores')->default(0)->comment('Điểm môn tiếng anh');
            $table->tinyInteger('priority_english_scores')->default(0)->comment('Điểm ưu tiên môn tiếng anh');
            $table->tinyInteger('epidemiological_scores')->default(0)->comment('Điểm dịch tễ');
            $table->tinyInteger('priority_epidemiological_scores')->default(0)->comment('Điểm ưu tiên dịch tễ');
            $table->tinyInteger('health_management_scores')->default(0)->comment('Điểm môn Tổ chức Quản lý y tế');
            $table->tinyInteger('priority_health_management_scores')->default(0)->comment('Điểm ưu Tổ chức Quản lý y tế');
            $table->tinyInteger('biochemistry_hematology_scores')->default(0)->comment('Điểm Vi sinh - Hóa sinh- Huyết học');
            $table->tinyInteger('priority_biochemistry_hematology_scores')->default(0)->comment('Điểm ưu tiên Vi sinh - Hóa sinh- Huyết học');
            $table->tinyInteger('food_safety_scores')->default(0)->comment('Điểm An toàn thực phẩm');
            $table->tinyInteger('priority_food_safety_scores')->default(0)->comment('Điểm ưu tiên An toàn thực phẩm');
            $table->tinyInteger('total_scores')->default(0)->comment('Tổng điểm');
            $table->integer('admission_year')->default(date('Y'))->comment('Năm tuyển sinh');
            $table->string('comment')->nullable()->comment('Ghi chú');

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
