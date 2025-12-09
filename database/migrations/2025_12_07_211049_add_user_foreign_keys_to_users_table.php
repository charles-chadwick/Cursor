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
        // No-op: foreign key constraints intentionally omitted
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: nothing to drop since no foreign keys were created
    }
};
