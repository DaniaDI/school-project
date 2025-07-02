<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    function index()
    {
        /* طريفة conncatent
         $text = 'Dania ';
        $text .='Isead' ;
         return $text;
*/
        return view('dashboard.teachers.index');
    }

    function add(Request $request)
    {
        //   dd($request->all());
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required','regex:/^\+?[0-9]{7,15}$/','unique:teachers,phone'], // جدول المعلم العامود فيه رقم الهاتف ما يتكرر
                'email' => ['required','email', 'max:255','unique:users,email'], //unique:users,email':  بتفحص  من حدول اليوزر كل الايميلات الموجودة = يعني الايميل الجديد بتفحص هل موجود قبل بهاي الايميلات او لا
                'hire_date' => ['required', 'date', 'after:date_of_birth'],
                'qualification' => ['required', 'in:Diploma,Bachelors,Master,Dr'], // in: تعني خيار من هذه الخيارات فقط
                'spec' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'in:m,fm'],
                'date_of_birth' => ['required', 'date', 'before:hire_date'],

            ],
            [
                'name.required'         => 'حقل الاسم مطلوب',
                'name.string'           => '  الاسم يجب ان يكون نصا  ',
                'name.max'              => ' الاسم لا يجب ان يتجاوز 255 حرفا',

                'phone.required'         => 'حقل الهاتف  مطلوب',
                'phone.regex'            => 'صيغة رقم الهاتف غير صحيحة ',
                'phone.unique'           => 'رقم الهاتف مستخدم مسبقا',

                'email.required'          => 'حقل البريد الالكتروني مطلوب',
                'email.email'             => 'يرجى ادخال بريد الكتروني صحيح',
                'email.max'               => 'هذا البريد الالكتروني طويل جدا',
                'email.unique'            => ' البريد الالكتروني  مستخدم مسبقا',


                'hire_date.required'      => 'حقل تاريخ التعيين مطلوب',
                'hire_date.date'          => 'صيغة تاريخ التعييين غير صحيحة',
                'hire_date.after'         => 'تاريخ التعيين ان يكون بعد تاريخ الميلاد',

                'qualification.required'  => 'حقل المؤهل العلمي مطلوب',
                'qualification.in'        => 'القيمة المدخلة للمؤهل العلمي غير صالحة', // لو مثلا حط غير الخيارات الموجودة بتظهر هاي الرسالة لحتى ما يصير خلل في سيرفر

                'spec.required'           => 'حقل التخصص  الجامعي مطلوب',
                'spec.string'             => 'التخصص يجب ان يكون نصا',

                'gender.required'         => 'حقل  الجنس مطلوب',
                'gender.in'               => 'القيمة المدخلة للجنس غير صالحة',

                'date_of_birth.required'  => 'حقل تاريخ الميلاد مطلوب',
                'date_of_birth.before'    => 'تاريخ الميلاد  يجب ان يكون قبل تاريخ التعيين',
                'date_of_birth.date'      => 'تاريخ الميلاد غير صحيحية',
            ]



        );

        $user = User::create([ //  :بعمله قبلclass الاب
            'email' => $request->email,
            'password' =>Hash::make($request->phone),

        ]);
        Teacher::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'hire_date' => $request->hire_date,
            'date_of_birth' => $request->date_of_birth,
            'qualification' => $request->qualification,
            'spec' => $request->spec,
            'gender' => $request->gender,
            'user_id' => $user->id,

        ]);

        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }

    function getdata(Request $request)
    { //   بس جواها ريكوستget عبارة عن دالة لرابط
        $grades = Teacher::select('teachers.*' , 'users.email')->join('users' ,'users.id','=',
        'teachers.user_id');// ->where('status', 'active'):الي يظهر فقط المفعل في الجدول

        return DataTables::of($grades) //نفذ داتاتيبل على جدول grades

        // lect 21 $qur :  الي حاليا بنطبع  row الممثل عن ال
        // name,phone ,other columne store in table teachers => $qur here  : for teacher not user
        // but email store in table users.
         ->filter(function($qur) use ($request){ //use :   html عشان اقدر اقارن بين الداتا بيز  وبين اليوزر الي بده ياه ] يعني بقارن المخزن عندي وبين الجاي من
             if($request->get('name')){ //  name اذا ريكوست الانبوت موجود فيه
               //like %....% , %... ,....%
                $qur->where('name','like' ,'%' .$request->get('name').'%');//  روح على داتا بيز وين بتلاقي في عامود الاسم مثل نفس الريكوست الاسم هاته
             }

             if($request->get('phone')){
                $qur->where('phone','like' ,'%' .$request->get('phone').'%');
             }

             // here we do join table user with teacher ABOVE  then ..
             if($request->get('email')){
                $qur->where('users.email','like' ,'%' .$request->get('email').'%');
             }
          })

            ->addIndexColumn() //for id
            ->addColumn('email', function ($qur) {
                return $qur->user->email;
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return '<span class="badge bg-success text-white">مفعل</span>';
                }
                return '<span class="badge bg-secondary text-white">معطل</span>';
            })

            ->addColumn('qualification', function ($qur) {
                return $qur->getQualByCode($qur->qualification);
            })

            ->addColumn('gender', function ($qur) {
                if ($qur->gender == 'm') {
                    return  '<span class="badge bg-info text-white">ذكر</span>';
                }
                return '<span class="badge text-white" style="background-color:#c74375;">انثى</span>';
            })




            ->addColumn('action', function ($qur) { //$qur):    الي بده ينطبعrow ...ويكون بمثابة المودل
                //  [1] lect 19 => 1:09:59 data attribute لما تضغط على زر التعديل  قوم بادخال البيانات الي جاية من كونترولر في  الانبوت  بتم عن طريق
                $data_attr = '';
                $data_attr .= ' data-id="' . $qur->id . '" ';
                $data_attr .= ' data-name="' . $qur->name . '" ';
                $data_attr .= ' data-phone="' . $qur->phone . '" ';
                $data_attr .= ' data-email="' . $qur->user->email . '" ';
                $data_attr .= ' data-spec="' . $qur->spec . '" ';
                $data_attr .= ' data-qualification="' . $qur->qualification . '" ';
                $data_attr .= ' data-gender="' . $qur->gender . '" ';
                $data_attr .= ' data-hire-date="' . $qur->hire_date . '" ';
                $data_attr .= ' data-date-of-birth="' . $qur->date_of_birth . '" ';
                $data_attr .= ' data-status="' . $qur->status . '" ';

                // [2]   index في js بدنا نستقبلهم هلقيت في

                $action = ''; // فصلنا كل زر عن تاني لقدر اتحكم فيه متى اظهره ومتى اخفيه

                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal"
                                    data-bs-target="#update-model" class="text-warning update_btn"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                    data-bs-original-title="Edit info" aria-label="Edit"><i class="bi
                                    bi-pencil-fill"></i></a>'; // زر التعديل
           if($qur->status == 'active'){
                $action .= ' <a  data-id="' . $qur->id . '"  data-url="' . route('dash.teacher.delete') . '" class="text-danger delete-btn"
                data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="
                Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>'; // زر الحذف لو مفعل
           }else{
            $action .= ' <a  data-id="' . $qur->id . '"  data-url="' . route('dash.teacher.active') . '" class="text-success active-btn"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="
            Delete" aria-label="Delete"><i class=" fadeIn animated bx bx-check-square"></i></a>'; //   لو معطل زر الحذف
           }
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action', 'gender']) // هاي دالة بكتبها عشان اي عمود فيه تصميم ما يظهر كنص متل زر الي بالحالة
            ->make(true); //->make: support json
    }



    function update(Request $request)
    {
        $teacher = Teacher::query()->findOrFail($request->id); // teacher id
        $user = User::query()->findOrFail($teacher->user_id); // from teacher id give me user id

        //  dd($request->all());
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required','regex:/^\+?[0-9]{7,15}$/', Rule::unique('teachers','phone')->ignore($request->id)],
                'email' => ['required','email', 'max:255',Rule::unique('users','email')->ignore($user->id)], // بدي اتجاهل في التعديل العنصر الي يتم التعديل عليه
                'hire_date' => ['required', 'date', 'after:date_of_birth'],
                'qualification' => ['required', 'in:Diploma,Bachelors,Master,Dr'],
                'spec' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'in:m,fm'],
                'date_of_birth' => ['required', 'date', 'before:hire_date'],
                'status' => ['required', 'in:active,inactive'],

            ],
            [
                'name.required'         => 'حقل الاسم مطلوب',
                'name.string'           => '  الاسم يجب ان يكون نصا  ',
                'name.max'              => ' الاسم لا يجب ان يتجاوز 255 حرفا',

                'phone.required'         => 'حقل الهاتف  مطلوب',
                'phone.regex'            => 'صيغة رقم الهاتف غير صحيحة ',
                'phone.unique'           => 'رقم الهاتف مستخدم مسبقا',

                'email.required'          => 'حقل البريد الالكتروني مطلوب',
                'email.email'             => 'يرجى ادخال بريد الكتروني صحيح',
                'email.max'               => 'هذا البريد الالكتروني طويل جدا',
                'email.unique'            => ' البريد الالكتروني  مستخدم مسبقا',


                'hire_date.required'      => 'حقل تاريخ التعيين مطلوب',
                'hire_date.date'          => 'صيغة تاريخ التعييين غير صحيحة',
                'hire_date.after'         => 'تاريخ التعيين ان يكون بعد تاريخ الميلاد',

                'qualification.required'  => 'حقل المؤهل العلمي مطلوب',
                'qualification.in'        => 'القيمة المدخلة للمؤهل العلمي غير صالحة',

                'spec.required'           => 'حقل التخصص  الجامعي مطلوب',
                'spec.string'             => 'التخصص يجب ان يكون نصا',
                'spec.max'              => ' التخصص لا يجب ان يتجاوز 255 حرفا',

                'gender.required'         => 'حقل  الجنس مطلوب',
                'gender.in'               => 'القيمة المدخلة للجنس غير صالحة',

                'date_of_birth.required'  => 'حقل تاريخ الميلاد مطلوب',
                'date_of_birth.before'    => 'تاريخ الميلاد  يجب ان يكون قبل تاريخ التعيين',
                'date_of_birth.date'      => 'تاريخ الميلاد غير صحيحية',
            ]

        );

        // $teacher = Teacher::query()->findOrFail($request->id); // teacher id
        // $user = User::query()->findOrFail($teacher->user_id); // from teacher id give me user id

        $user->update([
            'email' => $request->email,
        ]);

        $teacher->update(
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'hire_date' => $request->hire_date,
                'date_of_birth' => $request->date_of_birth,
                'qualification' => $request->qualification,
                'spec' => $request->spec,
                'gender' => $request->gender,
                'status' => $request->status,
            ],
        );

        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }
    ////////lect 20/////////////
    function delete(Request $request)
    {

        $teacher = Teacher::query()->findOrFail($request->id); // الي بعته من زر data-id
        if ($teacher) { // update status اذا موجود اعمل عليه
            $teacher->update([
                'status' => 'inactive',
            ]);
        }
        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }

    function active(Request $request){
        $teacher = Teacher::query()->findOrFail($request->id); // الي بعته من زر data-id
        if ($teacher) { // update status اذا موجود اعمل عليه
            $teacher->update([
                'status' => 'active',
            ]);
        }
        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }



}
