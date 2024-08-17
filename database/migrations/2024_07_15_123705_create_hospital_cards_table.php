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
        Schema::create('hospital_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_header_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('family_member_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('card_number')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_cards');
    }
};
