<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('username')->unique(); 
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('password'); 
            $table->string('nric')->unique(); 
            $table->string('contact')->unique(); 
            $table->integer('status')->default('0'); //status (0, 1, 2) (inactive, active, banned)
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
