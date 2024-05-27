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
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('salary_min');
            $table->dropColumn('salary_max');
            $table->decimal('monthly_salary', 10, 2)->after('salary_grade'); // Replace 'some_other_column' with the actual column after which you want to add 'monthly_salary'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->decimal('salary_min', 10, 2);
            $table->decimal('salary_max', 10, 2);
            $table->dropColumn('monthly_salary');
        });
    }
};
