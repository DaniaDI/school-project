<?php

namespace App\Http\Controllers\DashboardTeachers\Quizzes;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuizzController extends Controller
{
    function index()
    {
        return view('dashboard.dashboard_teachers.quizzes.index');
    }

    function add(Request $request)
    {
         dd($request->all());
        $user = auth()->user();
        $subject = Subject::query()->where('teacher_id', $user->id)->first();
        $quizz = Quiz::create([
            'title' => $request->title,
            'time' => $request->time,
            'start' => $request->start,
            'end' => $request->end,
            'subject' => $subject->id,

        ]);

        //question is array =>foreach
        foreach ($request->questions as $question) { // array الي جوا الاسئلة
            // Questions اضافة على جدول
            $q = $quizz->questions()->create([ //   || هدا الكوز له علاقة اسمها الاسئلة كانه عامل انشاء لجدول الاسئلة بس رابطه مه جدول الكوز
                'text' => $question['text'],
                'type' => $question['type'],
                'grade' => $question['grade'],
            ]);

            if ($question['type'] === 'msq') { // بضيف خيارات فراح اتستخدم جدول الاختيارات
                foreach ($question['options'] as $optionText) { // insiade array question has opations
                    $q->options()->create([ //  option من مودل الاسئلة هات الدالة اسمها
                        'text' => $optionText, // question id تلقائي
                    ]);
                }


                /*
     index 0=> q,
     index 1=> e,
     index 2=> t ,
     index 3=> y,

     correct 4 ->index 3 |
     عشان يمسكها بقوله اللاولى وتانية وتالتة اعمل سكب عليهم
     */



                $correctOptionIndex = $question['correct_option'] - 1; //index
                // بدي اطلع الخيار الصحيح هلا
                $correctOption = $q->options()->skip($correctOptionIndex)->first();

                if ($correctOption) { // correctOption:موجود
                    $q->correctAnswer()->create([
                        'option_id' => $correctOption->id, //في حالة الاجابة اختر الاجابة الصحيحة
                        'correct_value'=> null,// في حالة صح ا\و خطا
                    ]);
                }
            } elseif($question['type'] === 'tf'){
                $q->correctAnswer()->create([
                    'option_id' => null, //في حالة الاجابة اختر الاجابة الصحيحة
                    'correct_value'=> $question['correct_tf'],//  في حالة صح\و خطا|| 1  true 1 false 0
                ]);
        }
    }

    // بعد ما خلصت من الاضافة
     return redirect()->back();
    }
}
