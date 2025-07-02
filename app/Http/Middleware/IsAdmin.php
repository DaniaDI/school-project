<?php

namespace App\Http\Middleware;

use App\Models\Student;
use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    //     $user = Auth::user();
    //     if(!$user || Teacher::where('user_id' , $user->id)||Student::where('user_id' , $user->id)->exists()){
    //         abort(403 ,' .انت محظور من الصلاحية'); //  abort(403  :دالة للخطا اي ممنوع دخول هذه الصفحة بتاتا
    //   }
    //     return $next($request);
    $user = Auth::user();

    if (!$user || $user->role !== 'admin') {
        abort(403, 'أنت محظور من الصلاحية');
    }

    return $next($request);
}
    }

