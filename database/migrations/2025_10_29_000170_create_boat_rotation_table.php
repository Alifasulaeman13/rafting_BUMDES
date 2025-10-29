<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('boat_rotation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pointer_index')->default(0);
            $table->foreignId('last_assigned_boat_id')->nullable()->constrained('boats')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('boat_rotation');
    }
};