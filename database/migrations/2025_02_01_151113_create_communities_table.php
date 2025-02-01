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
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name');                                                     // Community name
            $table->text('description')->nullable();                                    // Community description
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Foreign key to user who created the community
            $table->enum('status', ['active', 'archived'])->default('active');          // Community status (active or archived)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communities');
    }
};
