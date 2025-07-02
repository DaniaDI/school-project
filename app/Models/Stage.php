<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    protected $guarded = [] ;

   public static function getIdByTag($tag){
          $stage = self::query()->where('tag', $tag)->first();//   بتجبلي صف واحد\\  تستخدم لما من عندي بدي اعمل شرط معين و:frst
          return $stage->id ;
   }
}
