<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('code');
            $table->double('quantity');
//            $table->string('size');
            $table->string('color_en');
            $table->string('color_ar');
            $table->double('sell_price');
            $table->double('discount_price')->nullable();
            $table->string('short_descp_en');
            $table->string('short_descp_ar');
            $table->string('long_descp_en');
            $table->string('long_descp_ar');
            $table->string('thumbnail');
            $table->integer('special_offer')->default(0);
            $table->integer('best_seller')->default(0);
            $table->string('brand');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->softDeletes();
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
}
