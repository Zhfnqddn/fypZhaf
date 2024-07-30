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
            $table->decimal('total_Price', 8, 2);
            $table->string('booking_Status');
            $table->string('custom_Status')->default('Not Customized');
            $table->unsignedBigInteger('cust_ID');
            $table->unsignedBigInteger('package_ID');
            $table->unsignedBigInteger('package_detail_ID')->nullable();
            $table->unsignedBigInteger('staff_ID'); // Add this line
            $table->timestamps();

            $table->foreign('cust_ID')->references('cust_ID')->on('customers');
            $table->foreign('package_ID')->references('package_ID')->on('packages');
            $table->foreign('package_detail_ID')->references('package_detail_ID')->on('package_details');
            $table->foreign('staff_ID')->references('staff_ID')->on('staff'); // Add this line
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
