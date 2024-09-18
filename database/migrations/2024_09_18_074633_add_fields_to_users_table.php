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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->nullable()->unique()->after('email'); // Add after the 'email' field
            $table->unsignedBigInteger('tahun_lulus')->nullable()->after('nim');

            // Add foreign key constraint if 'tahun_lulus' table exists
            $table->foreign('tahun_lulus')->references('id')->on('tahun_lulus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tahun_lulus']);
            $table->dropColumn(['nim', 'tahun_lulus']);
        });
    }
};
