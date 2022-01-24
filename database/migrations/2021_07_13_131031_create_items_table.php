<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id');
            $table->string('name'); 
            $table->string('desc')->nullable(); 
            $table->unsignedBigInteger('c_id');
            $table->decimal('quantity', 10, 0);
            $table->decimal('price', 10, 2);
            $table->string('barcode');
            $table->string('item_img');
            $table->integer('status')->default('1');
            $table->timestamps();



            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            //$table->foreign('c_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
