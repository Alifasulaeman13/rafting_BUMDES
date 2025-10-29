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
        Schema::create('boat_rotation', function (Blueprint $table) {
            $table->id();
            $table->integer('pointer_index')->default(0);
            $table->unsignedBigInteger('last_assigned_boat_id')->nullable();
            $table->foreign('last_assigned_boat_id')->references('id')->on('boats')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boat_rotation');
    }
};
