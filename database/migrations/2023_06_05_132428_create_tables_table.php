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
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('table_code')->nullable();
            $table->tinyInteger('floor_id')->nullable()->comment('Mã Tầng sử dụng');
            $table->tinyInteger('area_id')->nullable()->comment('Mã khu vực sử dụng');
            $table->tinyInteger('status_id');
            $table->integer('index_table')->comment('vị trí bàn');
            $table->integer('total_user_sitting')->comment('số lượng người dùng');
            $table->string('description');
            $table->integer('user_id')->comment('Người thêm');
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
        Schema::dropIfExists('tables');
    }
};
