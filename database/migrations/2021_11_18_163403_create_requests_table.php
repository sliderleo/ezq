<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('vendor_id');
            $table->string('store_name')->nullable();
            $table->string('desc')->nullable();
            $table->string('address'); 
            $table->string('email')->unique(); 
            $table->string('contact')->unique();
            $table->integer('status')->default('0'); 
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
        Schema::dropIfExists('requests');
    }
}
