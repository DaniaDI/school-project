<?php

use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Lectures\LectureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//url: learnschool/dashboard/grades/
// name :dash.grade.index:::::
Route::prefix('learnschool/')->group(function(){
    Route::prefix('dashboard/')->middleware(['auth','admin'])->name('dash.')->group(function(){//->middleware(['auth'])
/////////////////////garde part///////////////////////
        Route::prefix('grades/')->controller(GradeController::class)->name('grade.')->group(function(){
          Route::get('/','index')->name('index');
          Route::get('/getdata','getdata')->name('getdata');
          Route::get('/getactive','getactive')->name('getactive');
          Route::get('/create','create')->name('create');//لمشروع ما بتلزم
          Route::post('/add','add')->name('add');
          Route::post('/addsection','addsection')->name('addsection');//lect 15
          Route::get('/getactivesection','getactivesection')->name('getactive.section');//lect 16
          Route::get('/getactivestage','getactivestage')->name('getactive.stage');//lect 16
          Route::post('/changemaster','changemaster')->name('changemaster');
        });

        /////////////////////section part lect 17 ,18 ///////////////////////
      Route::prefix('sections/')->controller(SectionController::class)->name('section.')->group(function(){
          Route::get('/','index')->name('index');
          Route::get('/getdata','getdata')->name('getdata');
          Route::post('/add','add')->name('add');
          Route::post('/changestatus','changestatus')->name('changestatus');

        });

        ///////////////////////lect 19/////////////,middleware lect 21/////////////////////////////////////////////////
        Route::prefix('teachers/')->controller(TeacherController::class)->name('teacher.')->group(function(){//->middleware('tr')
            Route::get('/','index')->name('index');
            Route::get('/getdata','getdata')->name('getdata');
            Route::get('/getactive','getactive')->name('getactive');
            Route::get('/create','create')->name('create');//لمشروع ما بتلزم
            Route::post('/add','add')->name('add');
            Route::post('/update','update')->name('update');
            Route::post('/delete','delete')->name('delete');
            Route::post('/active','active')->name('active');
          });



          Route::prefix('subjects/')->controller(SubjectController::class)->name('subject.')->group(function () {
            Route::get('/','index')->name('index');
            Route::get('/lectures/{id}','lectures')->name('lectures');//   عشان ابعت على اساسه محاضرة لهاي المادة  subject id بدي ابعت معه
            Route::get('/getdata','getdata')->name('getdata');
            Route::get('/getdata/lectures','getdataLectures')->name('getdata.lectures');
            Route::get('/download/{filename}','download')->name('download');
            Route::post('/add','add')->name('add');
            Route::post('/update','update')->name('update');
            Route::post('/delete','delete')->name('delete');
            Route::post('/active','active')->name('active');
        });

        Route::prefix('students/')->controller(StudentController::class)->name('student.')->group(function () {
            Route::get('/','index')->name('index');
            Route::get('/lectures/{id}','lectures')->name('lectures');
            Route::get('/getdata','getdata')->name('getdata');
            Route::get('/getdata/lectures','getdataLectures')->name('getdata.lectures');
            Route::get('/download/{filename}','download')->name('download');
            Route::post('/import','import')->name('import');
            Route::post('/add','add')->name('add');
            Route::post('/update','update')->name('update');
            Route::post('/delete','delete')->name('delete');
            Route::post('/active','active')->name('active');
        });


        Route::prefix('lectures/')->controller(LectureController::class)->name('lecture.')->group(function(){
            Route::get('/','index')->name('index');
            Route::get('/getdata','getdata')->name('getdata');
            Route::get('/getactive','getactive')->name('getactive');
            Route::get('/create','create')->name('create');//لمشروع ما بتلزم
            Route::post('/add','add')->name('add');
            Route::post('/update','update')->name('update');
            Route::post('/delete','delete')->name('delete');
            Route::post('/active','active')->name('active');
          });

    });

});



















use App\Models\User;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
