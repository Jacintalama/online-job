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
    Schema::table('job_applications', function (Blueprint $table) {
        $table->dropColumn('cv_path');
        $table->dropColumn('cv_original_name');
        $table->dropColumn('cv_extension');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('job_applications', function (Blueprint $table) {
        $table->string('cv_path')->nullable(); // or whatever the original definition was
        $table->string('cv_original_name')->nullable();
        $table->string('cv_extension')->nullable();
    });
}
};
