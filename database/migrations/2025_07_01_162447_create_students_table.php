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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();//email ,password
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained('grades')->cascadeOnDelete();
            $table->string('first_name');
            $table->string('parent_name');
            $table->string('last_name');
            $table->string('parent_phone')->unique();
            $table->enum('gender',['m','fm']);
            $table->date('date_of_birth');
            $table->timestamps();
        });
        //الصف والشعبة الي هو فيها واسمه الااول والاخير واسم ابوه ورقم جوال ابوه وتاريخ الميللاد والجنس
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
