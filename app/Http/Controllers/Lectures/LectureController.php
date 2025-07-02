<?php

namespace App\Http\Controllers\Lectures;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
class LectureController extends Controller
{
    function index(){
        $subjects = Subject::all(); // كل المواد
        $teachers = Teacher::all();// كل المعلمين
        return view('dashboard.lectures.index' ,compact('subjects','teachers'));
    }


    function getdata(Request $request)
    { //   بس جواها ريكوستget عبارة عن دالة لرابط
        $lectures = Lecture::with(['subject', 'teacher']);

      $lectures = Lecture::query();
        return DataTables::of($lectures) //نفذ داتاتيبل على جدول grades


         ->filter(function($qur) use ($request){ //use :   html عشان اقدر اقارن بين الداتا بيز  وبين اليوزر الي بده ياه ] يعني بقارن المخزن عندي وبين الجاي من

                if ($request->get('title')) {
                    $qur->where('title', 'like', '%' . $request->get('title') . '%');
                }

                if ($request->get('description')) {
                    $qur->where('description', 'like', '%' . $request->get('description') . '%');
                }

                if ($request->get('subject')) {
                    $qur->whereHas('subject', function($q) use ($request) {
                        $q->where('title', 'like', '%' . $request->get('subject') . '%');
                    });
                }

                if ($request->get('teacher')) {
                    $qur->whereHas('teacher', function($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->get('teacher') . '%');
                    });
                }
            })




            ->addIndexColumn() //for id
            ->addColumn('subject', function ($qur) {
                return $qur->subject->title; // عنوان المادة
            })
            ->addColumn('teacher', function ($qur) {
                return $qur->teacher->name; // اسم المعلم
            })
            // target ="_blank":يفتح هدا الرابط بصفحة تانية
            ->addColumn('link', function ($qur) {
                return '<a class ="btn btn-info btn-sm"  target ="_blank" href="'. $qur->link .'"> رابط المحاضرة </a>'; //   بدي الرابط يعرض زر
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return '<span class="badge bg-success text-white">مفعل</span>';
                }
                return '<span class="badge bg-secondary text-white">معطل</span>';
            })


            ->addColumn('action', function ($qur) { //$qur):    الي بده ينطبعrow ...ويكون بمثابة المودل
                //  [1] lect 19 => 1:09:59 data attribute لما تضغط على زر التعديل  قوم بادخال البيانات الي جاية من كونترولر في  الانبوت  بتم عن طريق
                 $data_attr = '';
                $data_attr .= ' data-id="' . $qur->id . '" ';
                $data_attr .= ' data-title="' . $qur->title . '" ';
                $data_attr .= ' data-description="' . $qur->description . '" ';
                $data_attr .= ' data-subject_id="' . $qur->subject_id . '" ';
                $data_attr .= ' data-teacher_id="' . $qur->teacher_id . '" ';
                $data_attr .= ' data-link="' . $qur->link . '" ';
                $data_attr .= ' data-status="' . $qur->status . '" ';

                // [2]   index في js بدنا نستقبلهم هلقيت في

                $action = ''; // فصلنا كل زر عن تاني لقدر اتحكم فيه متى اظهره ومتى اخفيه

                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal"
                                    data-bs-target="#update-model" class="text-warning update_btn"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                    data-bs-original-title="Edit info" aria-label="Edit"><i class="bi
                                    bi-pencil-fill"></i></a>'; // زر التعديل

                                    if ($qur->status == 'active') {
                                        $action .= ' <a  data-id="' . $qur->id . '"  data-url="' . route('dash.lecture.delete') . '" class="text-danger delete-btn"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="حذف" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';
                                    } else {
                                        $action .= ' <a  data-id="' . $qur->id . '"  data-url="' . route('dash.lecture.active') . '" class="text-success active-btn"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="تفعيل" aria-label="Activate"><i class="bi bi-check-circle"></i></a>';
                                    }


                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action','link']) // هاي دالة بكتبها عشان اي عمود فيه تصميم ما يظهر كنص متل زر الي بالحالة
            ->make(true); //->make: support json
    }

    function add(Request $request)
    {
        //   dd($request->all());
        $request->validate(
            [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required','string','min:20'],
                'subject' => ['required','exists:subjects,id'],//exists:subjects,id :table ,col
                'teacher' => ['required','exists:teachers,id'],
                'link' => ['required','url'],

            ],


        );
        Lecture::create([
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject,
            'teacher_id' => $request->teacher,
            'link' => $request->link,

        ]);

        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }




}
