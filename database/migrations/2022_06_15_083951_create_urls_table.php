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
        // Schema::create('urls', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('redirect_to');
        //     $table->string('short_url');
        //     $table->boolean('status');
        //     $table->tinyInteger('url_type')->comments('1-For Random Url , 2- For personalized Url');
        //     $table->timestamp('expires_on')->nullable();
        //     $table->foreignId('user_id')->constrained();
        //     $table->softDeletes();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urls');
    }
};
