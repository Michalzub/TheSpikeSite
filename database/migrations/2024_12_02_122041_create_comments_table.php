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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("discussion_id")->constrained('discussions')->cascadeOnDelete();
            $table->foreignId("parent_id")->nullable()->constrained('comments')->cascadeOnDelete();
            $table->index('discussion_id');
            $table->index('parent_id');
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
