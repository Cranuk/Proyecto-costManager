<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->index('created_at', 'expenses_created_at_index');
        });

        Schema::table('revenues', function (Blueprint $table) {
            $table->index('created_at', 'revenues_created_at_index');
        });
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropIndex('expenses_created_at_index');
        });

        Schema::table('revenues', function (Blueprint $table) {
            $table->dropIndex('revenues_created_at_index');
        });
    }
};