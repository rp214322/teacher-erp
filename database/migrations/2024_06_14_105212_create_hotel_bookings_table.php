<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->string('no_of_passengers')->nullable();
            $table->string('no_of_rooms')->nullable();
            $table->string('type')->nullable();
            $table->string('meal_plan')->nullable();
            $table->string('voucher_ref')->nullable();
            $table->text('Inclusions')->nullable();
            $table->text('Exclusions')->nullable();
            $table->text('Remarks')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('hotel_bookings');
    }
}
