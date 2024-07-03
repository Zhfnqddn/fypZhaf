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
            $table->string('price_range');
            $table->string('custom_Status');
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
