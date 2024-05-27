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
            // Add the fields after the 'city' column
            $table->string('highest_education')->nullable()->after('city');
            $table->string('school_location')->nullable()->after('highest_education');
            $table->string('degree')->nullable()->after('school_location');
            $table->text('skills')->nullable()->after('degree');
            $table->text('job_experience')->nullable()->after('skills');
            $table->string('job_location')->nullable()->after('job_experience');
            $table->string('company_name')->nullable()->after('job_location');
            $table->text('achievements')->nullable()->after('company_name');
            $table->text('certifications')->nullable()->after('achievements');
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
