<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sets', function (Blueprint $table) {
            $table->foreignId('exercise_id')->constrained('excercises')->onDelete('cascade');
            $table->unsignedInteger('count')->default(0);
            $table->decimal('weight', 6, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('sets', function (Blueprint $table) {
            $table->dropForeign(['exercise_id']);
            $table->dropColumn(['exercise_id', 'count', 'weight', 'sort_order']);
        });
    }
};
