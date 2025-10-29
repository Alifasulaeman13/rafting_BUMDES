<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->enum('jenis_order', ['transfer', 'antar', 'orang']);
            $table->foreignId('assigned_operator_id')->nullable()->constrained('operators')->nullOnDelete();
            $table->dateTime('tgl_order');
            $table->enum('status', ['Pending', 'Assigned', 'Selesai', 'Cancel'])->default('Pending');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};