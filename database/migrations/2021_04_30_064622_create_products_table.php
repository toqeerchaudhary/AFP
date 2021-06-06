<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('uom_id');
            $table->unsignedInteger('sub_category_id');
            $table->unsignedInteger('brand_id')->nullable();
            $table->unsignedInteger('supplier_id')->nullable();
            $table->string('name')->unique();
            $table->text('description');
            $table->string('short_description');
            $table->string('warranty')->nullable();
            $table->integer('quantity');
            $table->float('sale_price');
            $table->float('purchase_price');
            $table->string('code');
            $table->string('hsn_code')->nullable();
            $table->float('custom_tax')->nullable();
            $table->float('gst_tax');
            $table->float('withholding_tax')->nullable();
            $table->float('service_tax')->nullable();
            $table->float('provincial_tax')->nullable();
            $table->float('transportation_charges')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file')->nullable();
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
}
