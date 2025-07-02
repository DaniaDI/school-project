<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //'Diploma','Bachelors','Master','Dr']);
    static public function getQualByCode($code)
    { // qualification
        if($code == 'Diploma') {
            return 'دبلوم';
        }elseif($code == 'Bachelors') {
            return 'بكالوريس';
        }elseif($code == 'Master') {
            return  'ماجستير';
        }else{
            return 'دكتوراه';
        }
    }

    
}
