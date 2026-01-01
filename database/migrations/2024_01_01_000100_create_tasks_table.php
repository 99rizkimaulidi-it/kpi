<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('deadline_at');
            $table->foreignId('creator_id')->constrained('users');
            $table->foreignId('assignee_id')->constrained('users');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->index('deadline_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
