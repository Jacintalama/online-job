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
        DB::table('users')->where('role', 'employer')->update(['role' => 'lguhrmo']);
        DB::statement('ALTER TABLE users MODIFY role ENUM("admin", "lguhrmo", "applicant")');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE users MODIFY role ENUM("admin", "employer", "applicant")');
        DB::table('users')->where('role', 'lguhrmo')->update(['role' => 'employer']);
    }
};
