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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status',['unbearbeitet','in Arbeit','Erledigt(bewertet)','Erledigt(unbewertet)','warte auf Ergebnis']);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->unsignedInteger('start_semester');
            $table->unsignedInteger('end_semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
