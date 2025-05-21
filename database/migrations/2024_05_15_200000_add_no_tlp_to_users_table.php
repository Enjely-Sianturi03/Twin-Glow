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
        // Periksa dulu apakah kolom no_tlp sudah ada
        if (!Schema::hasColumn('users', 'no_tlp')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('no_tlp')->nullable()->after('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Periksa dulu apakah kolom no_tlp ada sebelum menghapus
        if (Schema::hasColumn('users', 'no_tlp')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('no_tlp');
            });
        }
    }
};