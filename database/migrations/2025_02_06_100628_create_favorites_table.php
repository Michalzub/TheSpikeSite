<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // User's ID
            $table->enum('type', ['agent', 'weapon', 'map']);  // Type of favorite
            $table->uuid('uuid');  // ID of the item being favorited (UUID of agent/weapon/map)
            $table->string('display_name')->nullable();  // Nullable in case some favorites don't need this info
            $table->string('image_url')->nullable();

            // Composite primary key on user_id, item_id, and type
            $table->primary(['user_id', 'uuid', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
