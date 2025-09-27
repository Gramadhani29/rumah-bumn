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
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('proposal_file')->nullable()->after('kebutuhan_khusus');
            $table->string('original_filename')->nullable()->after('proposal_file');
            $table->integer('file_size')->nullable()->after('original_filename');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn(['proposal_file', 'original_filename', 'file_size']);
        });
    }
};
