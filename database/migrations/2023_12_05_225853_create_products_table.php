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
            $table->integer('product_code')->nullable();
            $table->string('product_name')->nullable(false);
            $table->integer('price');
            $table->integer('parchasing_price');
            $table->double('discount_limit')->default('10');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('alert_stock')->default(5);
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
