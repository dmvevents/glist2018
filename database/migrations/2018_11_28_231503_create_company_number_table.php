<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         // company_number table
         Schema::create('company_number', function(Blueprint $table)
             {
                 $table->increments('id')->unique();
                 $table->unsignedInteger('number_id');
                 $table->foreign('number_id')
                     ->references('id')
                     ->on('number')
                     ->onDelete('cascade');
                 $table->unsignedInteger('company_id');
                 $table->foreign('company_id')
                     ->references('id')
                     ->on('company')
                     ->onDelete('cascade');
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
        Schema::dropIfExists('company_number');
    }
}
