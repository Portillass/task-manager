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
        $table->string('title', 255);
        $table->text('description')->nullable();
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('created_by')->constrained('users');
        $table->enum('priority',['Low','Medium','High']);
        $table->enum('status',['Todo','InProgress','Done'])->default('Todo');
        $table->dateTime('due_date')->nullable();
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();
        $table->softDeletes();
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
