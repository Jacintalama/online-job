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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('highest_education');
            $table->dropColumn('school_location');
            $table->dropColumn('degree');
            $table->dropColumn('skills');
            $table->dropColumn('job_experience');
            $table->dropColumn('job_location');
            $table->dropColumn('company_name');
            $table->dropColumn('achievements');
            $table->dropColumn('certifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
