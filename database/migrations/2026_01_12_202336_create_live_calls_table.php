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
        Schema::create('live_calls', function (Blueprint $table) {
            $table->id();
            // кто звонит
            $table->foreignId('student_id')->constrained('users');
            $table->foreignId('mentor_id')->constrained('users');

            // контекст
            $table->foreignId('course_id')->nullable()->constrained();
            $table->foreignId('lesson_id')->nullable()->constrained();

            // деньги
            $table->foreignId('payment_id')->nullable()->constrained();
            $table->decimal('price_kzt', 10, 2)->default(0);
            $table->integer('minutes_purchased')->default(0);

            // реальное время
            $table->integer('minutes_used')->default(0);

            // jitsi
            $table->string('jitsi_room');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            // статус
            $table->enum('status', [
                'free',        // бесплатный старт
                'trial',       // пробный
                'awaiting_payment',
                'paid',
                'active',
                'ended',
                'expired'
            ])->default('free');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_calls');
    }
};
