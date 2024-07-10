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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->unsignedBigInteger('employee_id');
            // $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->longText('description')->nullable();
            $table->date('given_date')->nullable();
            // $table->date('deadline')->nullable();
            $table->date('completed_at')->nullable();
            $table->date('started_at')->nullable();
            // $table->double('time_taken')->nullable();
            $table->string('task_status')->nullable();
            $table->string('comment')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
