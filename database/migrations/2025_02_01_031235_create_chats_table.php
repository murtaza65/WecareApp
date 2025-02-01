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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_1_id') // User 1's ID (First participant)
                ->constrained('users')         // Reference to 'users' table
                ->onDelete('cascade');
            $table->foreignId('user_2_id') // User 2's ID (Second participant)
                ->constrained('users')         // Reference to 'users' table
                ->onDelete('cascade');
            $table->boolean('is_group_chat')->default(false); // For group chats
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
