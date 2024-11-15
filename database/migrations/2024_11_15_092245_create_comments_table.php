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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->timestamps();
            $table->unsignedBigInteger('podcast_id');
            $table->unsignedBigInteger('podcaster_id');

            $table->foreign('podcast_id')
                ->references('id')
                ->on('podcasts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('podcaster_id')
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
        Schema::dropIfExists('comments');
    }
};
