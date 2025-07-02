<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

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
    function import(Request $request){

        // dd($request->all());

        //  public بدي اخزن الملف داخل ال


        $name = 'ExcelStudent_' . time() . '_' . rand() . '.' . $request->file('excel')
        ->getClientOriginalExtension();
        $request->file('excel')->move(public_path('uploads\files\excel'), $name);

       








    }
}
