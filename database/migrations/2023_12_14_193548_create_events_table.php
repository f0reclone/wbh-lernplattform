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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->morphs('related');
            $table->dateTime('start');
            $table->dateTime('end')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};