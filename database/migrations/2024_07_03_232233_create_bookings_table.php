<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_ID');
            $table->date('start_Date');
            $table->date('end_Date');
            $table->time('time_From');
            $table->time('time_To');
            $table->string('location');
            $table->decimal('total_Price', 8, 2);
            $table->string('booking_Status');
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
        Schema::dropIfExists('bookings');
    }
}
