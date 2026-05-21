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
        Schema::create('causes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('link')->nullable();
            $table->decimal('goal', 12, 2);
            $table->enum('status', ['open', 'close'])->default('open');
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('causes');
    }
};
