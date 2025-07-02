<?php



namespace App\Http\Controllers\Subjects;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        $grades = Grade::all();
        return view('dashboard.subjects.index', compact('teachers', 'grades'));
    }

    public function getdata(Request $request){

        $subjects = Subject::with(['teacher', 'grade'])->select('subjects.*');
        // $subjects = Subject::query();

        return DataTables::of($subjects)

    ->filter(function($qur) use ($request){
        if ($request->title) {
            $qur->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->book) {
            $qur->where('book', 'like', '%' . $request->book . '%');
        }

        if ($request->teacher_id) {
            $qur->where('teacher_id', $request->teacher_id);
        }

        if ($request->grade_id) {
            $qur->where('grade_id', $request->grade_id);
        }

    })
            ->addIndexColumn() //for id
            ->addColumn('teacher_name', function ($qur) {
                return $qur->teacher->name ?? 'غير محدد';
            })
            ->addColumn('grade_name', function ($qur) {
                return $qur->grade->name ?? 'غير محدد'  ;
            })
            ->addColumn('book', function ($qur) {
                return ' <a href="' .route('dash.subject.download',$qur->book).' " class=" btn btn-primary btn-sm" > كتاب "'. $qur->title .'" '. $qur->grade->name .'</a>' ;
            })

            ->addColumn('lectures', function ($qur) {
                return ' <a href="' .route('dash.subject.lectures', $qur->id).' " class=" btn btn-primary btn-sm" >عرض جميع المحاضرات </a>' ;
            })//$qur->id : subject id

            ->addColumn('action', function ($qur) {
                $data_attr = '';
                $data_attr .= ' data-id="' . $qur->id . '" ';
                $data_attr .= ' data-title="' . $qur->title . '" ';
                $data_attr .= ' data-book="' . $qur->book . '" ';
                $data_attr .= ' data-teacher-id="' . $qur->teacher_id . '" ';
                $data_attr .= ' data-grade-id="' . $qur->grade_id . '" ';

                $action = '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal"
                    data-bs-target="#update-model" class="text-warning update_btn"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="تعديل"
                    aria-label="Edit">
                    <i class="bi bi-pencil-fill"></i></a>';

                $action .= ' <a data-id="' . $qur->id . '" data-url="' . route('dash.subject.delete') . '"
                    class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="حذف" aria-label="Delete">
                    <i class="bi bi-trash-fill"></i></a>';

                $action .= '</div>';

                return $action;
            })

            ->rawColumns(['action','book','lectures'])
            ->make(true);
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => ['required','string','max:255'],
            'book' => ['required','mimes:pdf','max:5120'],
            'teacher_id' => ['required','exists:teachers,id'],
            'grade_id' => ['required','exists:grades,id'],
        ],[
            'title.required' => 'عنوان المادة مطلوب' ,
            'title.string' => 'عنوان المادة يجب ان يكون نصا' ,
            'teacher_id.required' => '  معلم المادة مطلوب  ' ,
            'teacher_id.exists' => '   معلم المادة غير موجود' ,
            'book.required' => 'كتاب المادة مطلوب' ,
            'book.mimes' => ' pdf كتاب المادة يجب ان يكون بصيغة ' ,
            'book.max' => 'كتاب المادة اقصى حجم  5 ميجا بايت' ,
            'grade_id.required' => 'الصف الدراسي  مطلوب' ,
            'grade_id.string' => 'الصف الدراسي يجب ان يكون نصا' ,
            'grade_id.exists' => 'الصف الدراسي غير موجود  ' ,
        ]);



        $name = 'onlineSchool_'.time(). '_' . rand() .'.' . $request->file('book')
        ->getClientOriginalExtension();
        $request->file('book')->move(public_path('uploads\books'),$name);

        $grade = Grade::query()->where('tag',$request->grade)->first();

        Subject::create([
            'title'=>$request->title,
            'book'=>$name,
            'teacher_id'=>$request->teacher_id,
            'grade_id'=>$request->grade_id,

        ]);

        return response()->json([
            'success' => 'تمت إضافة المادة بنجاح'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required','exists:subjects,id'],
            'title' => ['required','string','max:255'],
            'book' => ['required','mimes:pdf','max:5120'],
            'teacher_id' => ['required','exists:teachers,id'],
            'grade_id' => ['required','exists:grades,id'],
        ] ,[
            'title.required' => 'عنوان المادة مطلوب' ,
            'title.string' => 'عنوان المادة يجب ان يكون نصا' ,
            'teacher_id.required' => '  معلم المادة مطلوب  ' ,
            'teacher_id.exists' => '   معلم المادة غير موجود' ,
            'book.required' => 'كتاب المادة مطلوب' ,
            'book.mimes' => ' pdf كتاب المادة يجب ان يكون بصيغة ' ,
            'book.max' => 'كتاب المادة اقصى حجم  5 ميجا بايت' ,
            'grade_id.required' => 'الصف الدراسي  مطلوب' ,
            'grade_id.string' => 'الصف الدراسي يجب ان يكون نصا' ,
            'grade_id.exists' => 'الصف الدراسي غير موجود  ' ,
        ]);



        $name = 'onlineSchool_'.time(). '_' . rand() .'.' . $request->file('book')
        ->getClientOriginalExtension();
        $request->file('book')->move(public_path('uploads\books'),$name);

        $subject = Subject::findOrFail($request->id);
        $subject->update([
            'title'=>$request->title,
            'book'=>$name,
            'teacher_id'=>$request->teacher_id,
            'grade_id'=>$request->grade_id,

        ]);

        return response()->json([
            'success' => 'تم تعديل المادة بنجاح'
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:subjects,id',
        ]);

        Subject::findOrFail($request->id)->delete();

        return response()->json(['success' => 'تم حذف المادة بنجاح']);
    }

    function download($filename){
        $path = public_path('uploads/books/' .$filename);

        return response()->download($path);
    }
    function  lectures($id){
      $subject = Subject::query()->findOrFail($id);

        return view('dashboard.subjects.lectures',compact('subject'));
    }

/////////////////////////////////////////////////////////////////////////////////////
    function getdataLecture(Request $request)
    {
        //   بس جواها ريكوستget عبارة عن دالة لرابط

    //   dd($request->id);
    $lectures = Lecture::with(['subject', 'teacher'])
    ->where('subject_id', $request->id);

    // $lectures = Lecture::query()->where('subject_id',$request->id);//عرض جميع محاضرات المادة

    // $lectures = Lecture::with(['subject', 'teacher']);

     return DataTables::of($lectures) //نفذ داتاتيبل على جدول grades

// code filter
->filter(function($qur) use ($request){ //use :   html عشان اقدر اقارن بين الداتا بيز  وبين اليوزر الي بده ياه ] يعني بقارن المخزن عندي وبين الجاي من

    if ($request->get('title')) {
        $qur->where('title', 'like', '%' . $request->get('title') . '%');
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

            ->rawColumns(['status','link']) // هاي دالة بكتبها عشان اي عمود فيه تصميم ما يظهر كنص متل زر الي بالحالة
            ->make(true); //->make: support json
    }


}
