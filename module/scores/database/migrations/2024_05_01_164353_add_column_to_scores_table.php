<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_scores', function (Blueprint $table) {
            $table->string('industry_code')->nullable()->comment('mã ngành');
            $table->string('gender')->default('Chưa rõ');
            $table->string('status')->nullable()->comment('Đạt hoặc không đạt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_scores', function (Blueprint $table) {
            $table->dropColumn('industry_code');
            $table->dropColumn('gender');
            $table->dropColumn('status');
        });
    }
}
