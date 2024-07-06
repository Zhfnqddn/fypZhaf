<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_details', function (Blueprint $table) {
            $table->id('package_detail_ID');
            $table->integer('add_Hours');
            $table->string('add_Ons');
            $table->string('add_Session');
            $table->string('add_Location');
            $table->unsignedBigInteger('cust_ID');
            $table->unsignedBigInteger('package_ID');
            $table->timestamps();

            $table->foreign('cust_ID')->references('cust_ID')->on('customers');
            $table->foreign('package_ID')->references('package_ID')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_details');
    }
}
