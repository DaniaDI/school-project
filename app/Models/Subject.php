<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;


    // حماية البيانات - هنا جعلنا كل الحقول قابلة للكتابة (يمكنك تغييرها حسب الحاجة)
    protected $guarded = [];

    // علاقة المادة بالمعلم (Subject belongs to Teacher)
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // علاقة المادة بالصف الدراسي (Subject belongs to Grade)
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
