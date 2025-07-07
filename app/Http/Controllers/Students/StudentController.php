<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\SimpleExcel\SimpleExcelWriter;

use function Ramsey\Uuid\v1;

class StudentController extends Controller
{

    public function index()
    {
        $grades = Grade::all(); // بدي ابعت الصفوف كلها
        $sections = Section::all(); // بدي ابعت الشعب كلها
        return view('dashboard.students.index', compact('grades', 'sections'));
    }

    public function getdata(Request $request)
    {

        $student = Student::with(['section', 'grade', 'user']);
        // $subjects = Subject::query();

        return DataTables::of($student)

            ->filter(function ($qur) use ($request) {
                if ($request->first_name) {
                    $qur->where('title', 'like', '%' . $request->first_name . '%');
                }

                if ($request->section_id) {
                    $qur->where('section_id', $request->section_id);
                }

                if ($request->grade_id) {
                    $qur->where('grade_id', $request->grade_id);
                }
            })
            ->addIndexColumn() //for id
            ->addColumn('email', function ($qur) {
                return $qur->user->email;
            })
            ->addColumn('grade_id', function ($qur) {
                return $qur->grade->name;
            })

            ->addColumn('section_id', function ($qur) {
                return $qur->section->name;
            })
            ->addColumn('gender', function ($qur) {
                if ($qur->gender == 'm') {
                    return  '<span class="badge bg-info text-white">ذكر</span>';
                }
                return '<span class="badge text-white" style="background-color:#c74375;">انثى</span>';
            })

            ->addColumn('action', function ($qur) {
                $data_attr = '';
                $data_attr .= ' data-id="' . $qur->id . '" ';
                $data_attr .= ' data-first_name="' . $qur->first_name . '" ';
                $data_attr .= ' data-last_name="' . $qur->last_name . '" ';
                $data_attr .= ' data-date_of_birth="' . $qur->date_of_birth . '" ';
                $data_attr .= ' data-parent_phone="' . $qur->parent_phone . '" ';
                $data_attr .= ' data-parent_name="' . $qur->parent_name . '" ';
                $data_attr .= ' data-gender="' . $qur->gender . '" ';
                $data_attr .= ' data-section-id="' . $qur->section_id . '" ';
                $data_attr .= ' data-grade-id="' . $qur->grade_id . '" ';

                $action = '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal"
                    data-bs-target="#update-model" class="text-warning update_btn"
                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="تعديل"
                    aria-label="Edit">
                    <i class="bi bi-pencil-fill"></i></a>';

                $action .= ' <a data-id="' . $qur->id . '" data-url="' . route('dash.student.delete') . '"
                    class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="حذف" aria-label="Delete">
                    <i class="bi bi-trash-fill"></i></a>';

                $action .= '</div>';

                return $action;
            })

            ->rawColumns(['action', 'gender'])
            ->make(true);
    }


    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'parent_name' => ['required', 'string', 'max:255'],
                'parent_phone' => ['required'],
                'date_of_birth' => ['required', 'date'],
                'gender' => ['required', 'in:m,fm'],
                'grade_id' => ['required', 'exists:grades,id'],
                'section_id' => ['required', 'exists:sections,id'],
            ]
        );

        $grade = Grade::query()->where('id', $request->grade_id)->first();
        $section = Section::query()->where('name', $request->section_id)->first();

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make('1234'),

        ]);

        Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_id' => $user->id,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'grade_id' => $grade->id,
            'section_id' => $section->id,


        ]);

        return response()->json([
            'success' => 'تمت إضافة الطالب بنجاح'

        ]);
    }
    public function update(Request $request)
    {

        $grade = Grade::query()->where('id', $request->grade_id)->first();
        $section = Section::query()->where('name', $request->section_id)->first();


        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'parent_name' => ['required', 'string', 'max:255'],
            'parent_phone' => ['required'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:m,fm'],
            'grade_id' => ['required', 'exists:grades,id'],
            'section_id' => ['required', 'exists:sections,id'],
        ]);


        $student = Student::findOrFail($request->id);
        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'parent_name' => $request->parent_name,
            'parent_phone' => $request->parent_phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'grade_id' => $grade->id,
            'section_id' => $section->id,
        ]);


        return response()->json([
            'success' => 'تم تعديل الطالب بنجاح'
        ]);
    }


    function import(Request $request)
    {

        // dd($request->all());

        //  public بدي اخزن الملف داخل ال

        // تخزين الملف في المسار الصحيح
        $name = 'ExcelStudent_' . time() . '_' . rand() . '.' . $request->file('excel')
            ->getClientOriginalExtension();
        $request->file('excel')->move(public_path('uploads\files\excel'), $name);


        $path = public_path('uploads\files\excel') . DIRECTORY_SEPARATOR . $name;
        //dd($path );
        //user: email,password || student :------

        //  بتاخد دالة كريت المسار تبع ملف اكسل الي عندي وبعدها عندي دالة تانية بتاخد الصفوف دخل الملف وبتسلم لدالة الي بعدها  هادي دالة 3 بتاخد صف صف وبتستخدم الايري تخزن الصفوف على شكل مضفوفةsimpleclassهنا سمبل هذا كلاس داخل مكتبة
        SimpleExcelReader::create($path)->getRows()->each(function (array $row) {

            //لو بدي اكتب Valdation
            // كنا قبل نعمل request->valdation :  هنا ما بينفع لانه الصف بتغير
           $validator =  Validator::make($row ,[
                'email' => 'required|email',

             ]);

             if($validator->fails()){ //لو في اي خطا بالايميل  بالتحقق هذا هيظهر هذا الخطا مع الصف الي فيه الخطا
                 Log::warning(' انا قمت بتجواز هذا السطر بسبب الاخطاء. $row ');
                 return; // بعدها يتخطى الصف الي بعدها
             }


            // بدي ادور على اليوزر من خلال الايميل
            $user = User::query()->where('email', $row['email'])->first(); // email in DB = email in excel file =>في الصف الي واقف فيه حاليا هات اول واحد
            if (!$user) { //  لو اليوزر مش موجود اصلا فانت روح انشألي ياه
                $password = Str::random(10); // string in 10 char.
            // add user
              $user =  User::create([
                    'email' => $row['email'], //$row['email'] : المسمسى الي دخل الاقواس من هيدر في ملف الاكسل الي عندي
                    'password' => Hash::make($password),
                ]);
            }

            $grade = Grade::query()->where('tag' ,$row['grade'])->first();
            $section = Section::query()->where('name' ,$row['section'])->first();
        // add student
        Student::query()->updateOrCreate(['user_id'=> $user->id],//   لو اليوزر الموجود يحدث لكن لو مش موجود تم انشائه
        [
          'first_name'=>$row['first_name'],
          'last_name'=>$row['last_name'],
          'parent_name'=>$row['parent_name'],
          'parent_phone'=>$row['parent_phone'],
          'date_of_birth'=>$row['date_of_birth'],
          'gender'=>$row['gender'],
          'grade_id'=>$grade->id,
          'section_id'=>$section->id,

        ]);

           // لما تخلص العملية

        return  view('dashboard.students.index');

        });

    }
///////////////////////////////////////////////////lect 24///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function export(){
        //  وبعدها انجيب البيانات داخل الطلاب  واضعها داخل ملف الاكسل واخلي اليوزر ينزلها وبعدهالا احذف الملف من الببلك موضوع ترتيب PUBLICبدنا ننشا ملف اكسل داخل

        $dir = public_path('exports');
        //exports :بدي اتاكد انه موجود او معمول
        if(!File::exists('exports')){
           File::makeDirectory($dir , 0755 , true );
        }//csv =>xsls  بقراه اللاكسل هذا الامتداد

        $path = public_path('exports\students_export_' . time(). '.csv');

        $students =Student::query()->with(['grade','user','section'])->get();

        SimpleExcelWriter::create($path)->addHeader([
       // name header of file .
         'First_name',
         'Last_name',
         'Parent_name',
         'Parent_phone',
         'Gender',
         'Email',
         'Date Of Birth',
         'Grade',
         'Section',
        ])->addRows($students->map(function($student){// like for each || map :assoiative array
           return [
            $student->first_name,
            $student->last_name,
            $student->parent_name,
            $student->parent_phone,
            $student->gender,
            $student->user->email,
            $student->date_of_birth,
            $student->grade->name,
            $student->section->name,
           ];
        }));
        return response()->download($path)->deleteFileAfterSend(true);
    }
}
