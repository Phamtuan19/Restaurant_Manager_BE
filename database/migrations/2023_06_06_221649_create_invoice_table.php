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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable()->comment("Mã bàn đã đặt trước");
            $table->integer('user_id')->nullable()->comment('id người người dùng');
            $table->integer('table_id');
            $table->tinyInteger('quantity')->comment('số lượng sản phẩm sử dụng');
            $table->tinyInteger('tatus_id');
            $table->tinyInteger('payment_id')->comment('hình thức thanh toán');
            $table->integer('staff_id')->nullable()->comment('mã nhân viên thanh toán');
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
        Schema::dropIfExists('invoice');
    }
};
