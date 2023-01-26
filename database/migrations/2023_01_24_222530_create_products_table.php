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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->unsignedBigInteger('age_id')->index()->nullable();
            $table->foreign('age_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->foreign('country_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->unsignedBigInteger('genre_id')->index()->nullable();
            $table->foreign('genre_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->unsignedBigInteger('language_id')->index()->nullable();
            $table->foreign('language_id')->references('id')->on('attribute_values')->nullOnDelete();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('name');
            $table->string('full_name_tm');
            $table->string('full_name_en')->nullable();
            $table->string('full_name_ru')->nullable();
            $table->string('time')->default(0);
            $table->string('year')->default(0);
            $table->text('description')->nullable();
            $table->unsignedInteger('season')->default(1)->nullable();
            $table->unsignedInteger('episode')->default(1)->nullable();
            $table->unsignedInteger('favorites')->default(0);
            $table->unsignedInteger('viewed')->default(0);
            $table->unsignedInteger('rating')->default(0);
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
        Schema::dropIfExists('products');
    }
};
