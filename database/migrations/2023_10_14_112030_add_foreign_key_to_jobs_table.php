<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            // Add the lguhrmo_id column if it does not exist
            if (!Schema::hasColumn('jobs', 'lguhrmo_id')) {
                $table->unsignedBigInteger('lguhrmo_id')->nullable(); // or another type that matches `users`.`id`
            }

            // Add foreign key constraint
            $table->foreign('lguhrmo_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['lguhrmo_id']); // This will drop the foreign key constraint
            // $table->dropColumn('lguhrmo_id'); // Uncomment this line if you want to drop the column as well when rolling back the migration.
        });
    }
};
