<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateCountryIdAndCityIdInMiscBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('misc_bookings', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->change();
            $table->foreignId('city_id')->nullable()->change();
            // DB::table('misc_bookings')
            //     ->where('country_id', 'NONE')
            //     ->update(['country_id' => null]);

            // DB::table('misc_bookings')
            //     ->where('city_id', 'NONE')
            //     ->update(['city_id' => null]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('misc_bookings', function (Blueprint $table) {
            // $table->foreignId('country_id')->nullable(false)->change();
            // $table->foreignId('city_id')->nullable(false)->change();
        });
    }
}
