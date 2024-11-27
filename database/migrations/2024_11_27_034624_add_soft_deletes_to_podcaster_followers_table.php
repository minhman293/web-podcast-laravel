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
        Schema::table('podcaster_followers', function (Blueprint $table) {
            $table->softDeletes(); // Thêm cột deleted_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('podcaster_followers', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Xóa cột deleted_at
        });
    }
};

