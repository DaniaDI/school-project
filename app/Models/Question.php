<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    public function options(){
        return $this->hasMany(Option::class);//يحتوي على عدة اختيارات
    }

    public function correctAnswer(){
        return $this->hasOne(CorrectAnswer::class);//السؤال الواحد له اجابة صحيحة وحدة
    }
}
