<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id('package_ID');
            $table->string('package_Name');
            $table->string('service_Type');
            $table->date('start_Date');
            $table->date('end_Date');
            $table->time('time_From');
            $table->time('time_To');
            $table->string('location');
            $table->string('price_range');
            $table->unsignedBigInteger('staff_ID');
            $table->timestamps();

            $table->foreign('staff_ID')->references('staff_ID')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
