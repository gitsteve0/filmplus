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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_tm');
            $table->string('name_en')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('product_name_tm')->nullable();
            $table->string('product_name_en')->nullable();
            $table->string('product_name_ru')->nullable();
            $table->string('slug')->unique();
            $table->unsignedInteger('sort_order')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
