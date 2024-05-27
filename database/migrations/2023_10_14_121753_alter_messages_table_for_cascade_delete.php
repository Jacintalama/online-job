<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['recipient_id']);

            // Add the foreign key with cascade on delete
            $table->foreign('recipient_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop the existing foreign key
            $table->dropForeign(['recipient_id']);

            // Add the original foreign key without cascade on delete
            $table->foreign('recipient_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict'); // Or whatever your original setting was
        });
    }
};
