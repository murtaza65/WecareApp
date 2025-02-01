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
        Schema::create('chat_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id') // Reference to the 'chats' table
                ->constrained('chats')
                ->onDelete('cascade');
            $table->foreignId('user_id') // User ID of the sender
                ->constrained('users')
                ->onDelete('cascade');
            $table->text('message');                                                // The actual chat message
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent'); // Message status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_replies');
    }
};
