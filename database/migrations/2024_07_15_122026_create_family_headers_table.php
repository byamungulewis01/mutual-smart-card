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
        Schema::create('family_headers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_id')->unique();
            $table->date('dateOfBirth');
            $table->enum('gender', ['male','female']);
            $table->string('image');
            $table->string('phone')->nullable();
            $table->enum('matialStatus', ['single','married','divorced','widowed']);
            $table->foreignId('mutual_category')->constrained()->restrictOnUpdate();
            $table->integer('district');
            $table->integer('sector');
            $table->bigInteger('cell');
            $table->bigInteger('village');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_headers');
    }
};
