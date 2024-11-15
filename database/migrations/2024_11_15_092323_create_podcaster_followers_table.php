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
        Schema::create('podcaster_followers', function (Blueprint $table) {
            $table->unsignedBigInteger('podcaster_id');
            $table->unsignedBigInteger('follower_id');
            $table->timestamps();

            $table->primary(['podcaster_id', 'follower_id']);

            $table->foreign('podcaster_id')
                ->references('id')
                ->on('podcasters')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('follower_id')
                ->references('id')
                ->on('podcasters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('podcaster_followers');
    }
};
