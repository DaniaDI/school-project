<?php

namespace App\Http\Middleware;

use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // بدي اشوف اليوزر الي عمل دخول
        $user = Auth::user(); // بتجيب كل بيانالت اليوزر الي عامل جلسة او دخول حاليا انا
       // اذا اليوزر هدا مش موجود او مش عامل تسجيل دخول
      //!Teacher::where('user_id' , $user->id) :  او ما لقيت يوزر  من جدول المعلم يساوي اليوزر الي حاليا عندي داخل يعني اليوزر هدا مش معلم
        if(!$user || !Teacher::where('user_id' , $user->id)->exists()){
             abort(403 ,' . غير مسموح بالدخول الا كمعلم '); //  abort(403  :دالة للخطا اي ممنوع دخول هذه الصفحة بتاتا
       }


        return $next($request);
    }
}
