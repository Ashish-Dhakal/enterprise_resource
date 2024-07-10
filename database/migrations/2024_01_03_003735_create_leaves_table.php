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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id('id');
            // $table->string('name'); //paxi select employee id
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('duration',['halfDay','fullDay'])->default('fullDay');
            $table->string('reason')->nullable();
            $table->date('date')->nullable();
            $table->enum('type',['unpaid','paid','annual'])->default('Unpaid');
            $table->enum('status',['approved','rejected','pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
