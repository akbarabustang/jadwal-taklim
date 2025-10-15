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
        Schema::create('taklim_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('ustad_name');
            $table->string('mosque_name');
            $table->text('mosque_address');
            $table->string('mosque_city')->nullable();
            $table->dateTime('schedule_date');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->enum('frequency', ['once', 'daily', 'weekly', 'monthly'])->default('once');
            $table->string('category')->nullable(); // e.g., Tafsir, Hadits, Fiqih, Akhlaq
            $table->boolean('is_active')->default(true);
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taklim_schedules');
    }
};
