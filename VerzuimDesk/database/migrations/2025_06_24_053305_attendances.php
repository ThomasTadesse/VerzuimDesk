<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->date('date');
            $table->decimal('present_percentage', 5, 2)->default(0);
            $table->decimal('excused_absence_percentage', 5, 2)->default(0);
            $table->decimal('unexcused_absence_percentage', 5, 2)->default(0);
            $table->decimal('unregistered_percentage', 5, 2)->default(0);
            $table->timestamps();
            
            $table->index(['student_id', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};