<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeSection extends Model
{
    use HasFactory;
    protected $guarded =[] ;
// here becs we have gradesection (fk) for two tables [grade and section] then each when belongs to .
    function  section(){
        return $this->belongsTo(Section::class);
    }


}

