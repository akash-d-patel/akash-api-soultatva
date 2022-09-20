<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('attribute_id')->nullable()->constrained('attributes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('attribute_value_id')->nullable()->constrained('attribute_values')->onUpdate('cascade')->onDelete('cascade');
            $table->string('sku_code')->nullable();
            $table->string('asin_code')->nullable();
            $table->string('gtin_code')->nullable();
            $table->string('hsn_code')->nullable();
            $table->string('gst')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('mrp')->nullable();
            $table->string('status')->default('Active')->index();

            // user and time
            $table->timestamp('created_at')->useCurrent();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamp('deleted_at')->nullable();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_products');
    }
}
