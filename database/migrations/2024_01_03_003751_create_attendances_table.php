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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('leave_id')->nullable();
            $table->foreign('leave_id')->references('id')->on('leaves')->cascadeOnDelete();
            $table->date('date')->nullable();
            $table->string('source')->nullable();
            $table->string('location')->nullable();

            $table->enum('status', ['present', 'absent', 'pending'])->default('pending');
            $table->time('clock_in_time')->nullable();
            $table->time('clock_out_time')->nullable();
            $table->boolean('is_late')->default(0);
            $table->string('work_hrs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
