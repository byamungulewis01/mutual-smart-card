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
        Schema::create('consultances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hospital_card_id')->constrained()->cascadeOnDelete();
            $table->enum('department', ['surgery','internal-medecine','maternity','pediatrics'])->nullable();
            $table->enum('payment_status',['mutual','private']);
            $table->enum('status',['pending','complete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultances');
    }
};
