<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('seller_id')->nullable();
            $table->unsignedInteger('coordinator_id')->nullable();
            $table->string('code');
            $table->string('company_name');
            $table->string('person_name');
            $table->string('contact');
            $table->string('designation')->nullable();
            $table->string('email')->nullable();
            $table->string('project')->nullable();
            $table->string('subject')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->integer('revision_no');
            $table->string('client_reference')->nullable();
            $table->string('reference');
            $table->text('description');
            $table->string('row_heading');
            $table->string('warranty')->nullable();
            $table->timestamp('validity')->nullable();
            $table->string('selected_terms');
            $table->boolean('include_gst');
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
        Schema::dropIfExists('quotations');
    }
}
