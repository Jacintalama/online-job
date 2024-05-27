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
        Schema::create('salary_grades', function (Blueprint $table) {
            $table->id();
            $table->integer('grade')->unique(); // Ensure that the grade is unique
            $table->decimal('amount', 10, 2); // Assuming you'll have up to 10 digits before the decimal and 2 after
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_grades');
    }
};
