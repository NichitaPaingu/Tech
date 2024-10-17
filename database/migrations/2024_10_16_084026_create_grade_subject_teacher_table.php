<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grade_subject_teacher', function (Blueprint $table) {
            $table->id(); // Уникальный идентификатор
            $table->foreignId('grade_id')->constrained('grades')->onDelete('cascade'); // Связь с классом
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade'); // Связь с предметом
            $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade'); // Связь с учителем
            $table->timestamps(); // Поля created_at и updated_at

            // Уникальный индекс для предотвращения дублирования учителей по предметам в одном классе
            $table->unique(['grade_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_subject_teacher');
    }
};
