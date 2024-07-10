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
        Schema::create('projects', function (Blueprint $table) {
            // $table->bigInteger('id');
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->date('started_at')->nullable();
            $table->date('deadline_at')->nullable();
            // $table->time('completion_time')->nullable();
            // $table->date('completion_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
