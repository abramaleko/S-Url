<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('short_url_visits', function (Blueprint $table) {
            $table->string("location_country")->after('ip_address');
            $table->string("location_city")->after('location_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('short_visits', function (Blueprint $table) {
            //
        });
    }
};
