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
            $table->string('street_no')->nullable()->after('password');
            $table->string('barangay')->nullable()->after('street_no');
            $table->string('municipality')->nullable()->after('barangay');
            $table->string('province')->nullable()->after('municipality');
            $table->string('city')->nullable()->after('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('street_no');
            $table->dropColumn('barangay');
            $table->dropColumn('municipality');
            $table->dropColumn('province');
            $table->dropColumn('city');
        });
    }
};
