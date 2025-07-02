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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('phone')->unique();
            $table->date('date_of_birth');
            $table->date('hire_date');// تاريخ التعيين لوظيفة
            $table->string('spec');// التخصص بالجامعة
            $table->enum('qualification',['Diploma','Bachelors','Master','Dr']);// المؤهلات العلمية
            $table->enum('gender',['m','fm']);
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
