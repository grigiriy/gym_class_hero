<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('excercises', function (Blueprint $table) {
            $table->foreignId('training_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('excercises', function (Blueprint $table) {
            $table->dropForeign(['training_id']);
            $table->dropColumn(['training_id', 'name', 'sort_order']);
        });
    }
};
