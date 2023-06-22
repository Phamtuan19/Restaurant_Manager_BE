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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->integer('ingredient_id');
            $table->string('amount')->comment('số lượng sử dụng');
            $table->integer('unit')->comment('Đơn vị tính (gram, ml, muỗng, v.v.)');
            $table->date('time')->comment('thời gian làm');
            $table->text('description');
            $table->tinyInteger('sequence')->comment('trình tự làm');
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
        Schema::dropIfExists('recipes');
    }
};
