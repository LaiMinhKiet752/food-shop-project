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
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('vendor_id')->nullable();
            $table->string('product_name');
            $table->string('product_code')->unique();
            $table->string('product_thumbnail');
            $table->string('product_slug');
            $table->string('product_quantity');
            $table->string('product_tags')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_dimensions')->nullable();
            $table->timestamp('manufacturing_date')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
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
