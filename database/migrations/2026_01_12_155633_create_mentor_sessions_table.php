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
        Schema::create('mentor_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('users');
            $table->foreignId('student_id')->nullable()->constrained('users');

            $table->foreignId('slot_id')->nullable()->constrained('mentor_slots');
            $table->foreignId('payment_id')->nullable()->constrained();

            $table->enum('type', ['free', 'trial', 'paid']);
            $table->enum('status', ['open', 'booked', 'active', 'finished', 'cancelled']);

            $table->integer('price')->nullable();

            $table->timestamp('starts_at');
            $table->timestamp('ended_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_sessions');
    }
};
