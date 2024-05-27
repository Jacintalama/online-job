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
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->string('type');
            $table->string('requirement');
            $table->integer('priority_score');
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('qualification');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('qualifications');

        Schema::table('jobs', function (Blueprint $table) {
            $table->text('qualification')->nullable();
        });
    }
};
