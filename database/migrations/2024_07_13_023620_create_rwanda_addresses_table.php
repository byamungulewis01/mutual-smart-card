<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rwanda_addresses', function (Blueprint $table) {
            $table->integer('prov_id');
            $table->string('province');
            $table->integer('dist_id');
            $table->string('district');
            $table->bigInteger('sect_id');
            $table->string('sector');
            $table->bigInteger('cell_id');
            $table->string('cell');
            $table->bigInteger('vill_id');
            $table->string('village');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rwanda_addresses');
    }
};
