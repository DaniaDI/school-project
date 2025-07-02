<?php
//422 Unprocessable Entity status means:The server understands the request content type and syntax, but the server was unable to process the contained instructions.

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\GradeSection;
use App\Models\Section;
use App\Models\Stage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GradeController extends Controller
{
    function index()
    {
        return view('dashboard.grades.index');
    }

    function getdata(Request $request)
    {
        $grades = Grade::query();
        return DataTables::of($grades) //نفذ داتاتيبل على جدول grades
            ->addIndexColumn()
            ->addColumn('action', function ($qur) { //$qur):    الي بده ينطبعrow ...ويكون بمثابة المودل
                if ($qur->status == 'active') { //    الي بنعرض لازم يكون  الحالة تبعته اكتييف ::ليش:: لانه لو مش مفعل هذا الصف ما بدي الزر تبع الشعب يشتغل row هذا ال
                    return '<div data-bs-toggle="modal" data-grade-id="'. $qur->id .'" data-tag="' . $qur->tag . '" data-bs-target="#sectionModal" class="d-flex align-items-center gap-3 fs-6 btn-add-section">
                    <a href="javascript:;" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" ><i class="fadeIn animated bx bx-message-square-add"></i></a>
                  </div>'; //data-tag="'.$qur->tag.'": php in html not in blade like{{}} mean :conaction then the value from model Grade => I need tag from Grade model .
                    //data-grade-id="'.$qur->id.'":==data-grade_id عشان اعرف الصف الي بدي ياه

                }
                return '-' ; // لو الصف مش مفعل اعرض هذه -
            })
            ->addColumn('stage', function ($qur) {
                return $qur->stage->name; //بدي ارجع العلاقة
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return 'مفعل';
                }
                   return 'غير مفعل';
            })
            ->make(true); //->make: support json
    }
    //grade:المستوى اول تاني الصف
    //stage :3 مراحل ابتدائية وثانوية والاعدادية
    function create()
    {
        $stages = Stage::all();
        return view('dashboard.grades.create', compact('stages'));
    }

    function add(Request $request)
    {
        // dd($request->all());
        // dd(Stage::getIdByTag('p'));

        $request->validate([
            'name' => 'required',
            'stage' => 'required',
            'tag' => 'required',
            'status' => 'required',
        ], [
            'name.required' => 'حقل الاسم مطلوب',
            'status.required' => 'حقل الحالة مطلوب',
            'tag.required' => 'حقل المرحلة مطلوب',
            'stage.required' => 'حقل المرحلة مطلوب',
        ]);

        //lect14
        $stage_id = Stage::getIdByTag($request->stage); //p ,m ,H
        $status = Grade::getStatusByCode($request->status); //  1:active check ,0:inactive check
        $grade = Grade::query()->where('tag', $request->tag)->first();

        // Grade::create([ //befor create in seeder
        //     'name'=>$request->name ,
        //     //'stage_id'=>$request->stage ,
        //     'stage_id'=> $stage_id ,
        //     'status' => $status ,
        // ]);

        $grade->update([ //بعد اضافة من seeder بطلت create
            'name' => $request->name,
            'tag' => $request->tag,
            //'stage_id'=>$request->stage ,
            'stage_id' => $stage_id,
            'status' => $status,
        ]);
        // return redirect()->route('dash.grade.index')->with('success', 'تمت إضافة المستوى بنجاح');
        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }

    function getactive() //for grade
    {
        $actives = Grade::query()->where('status', 'active')->pluck('tag'); //pluck :بتجبلي العامود الي بس بدي ياه =tag
        // dd($actives);
        return response()->json([ //بدي ارجع res tags ->type json =>sent tags = actives
            'tags' => $actives
        ]); //  1[1] index ajax getactivestageطلع تاج ورجعه على رسبونس على مكان ما اجيت الي هو في
    }

    /////////////////////////////////////lect 16 /////////////////////////////////////////
    function getactivestage() //for stage have tag = p , m, h
    {
        $actives = Stage::query()->where('status', 'active')->pluck('tag'); //pluck :بتجبلي العامود الي بس بدي ياه =tag
        // dd($actives);
        return response()->json([ //بدي ارجع res tags ->type json =>sent tags = actives
            'tags' => $actives
        ]);
    }

//////////////////////////////////

    function addsection(Request $request)
    {
        // dd($request->all());

        //add col status in table grade_sections then we need send status with data [if الصف تم انشاء له قبل هيك شعبة بنعدل الحالة  ]
        $section = Section::query()->where('name', $request->section)->first(); //من المودل سكشن وين ما بتلاقي الاسم تبعه يساوي ريكوست سكشن هاتلي اول واحد
        $grade = Grade::query()->where('tag', $request->gradetag)->first();

        //section id = 1
        //grade id = 2 هدول الاتنين ممنوع يلتقو بصف عشان يصير عمليى الكريت

        if ($request->status == '1') {
            $status = 'active'; //return :بطلعني من اقواس الفنكشن
        } else {
            $status = 'inactive';
        }

        GradeSection::query()->updateOrCreate([ // اول مصفوفة بتفحص هل جدول موجود او لا
            'grade_id' => $grade->id,
            'section_id' => $section->id,
        ], [
            // لو الاتنين التقو بنفس الصف حيصير تعديل بس للحالة

            'status' => $status,

        ]);
        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }

    //Request $request in function getactive section bcs :tagId.
    function getactivesection(Request $request)
    { //for grade-section الجدول الوسيط
        dd($request->all());
        $actives = GradeSection::query()->where('status', 'active')->where('grade_id', $request->gradeId)->get()->pluck('section.name'); //pluck :بتجبلي من العلاقة هاي العامود الاسم نيم الي بس بدي ياه =section.name [TABLE SECTION ,COLUMN:NAME] ,,in index page data-section="1" mean name .
        // dd($actives);//  section  في جدول name عشان من خلاله ابحث عن <= section_id هنا جاب كل البيانات انا بس بدي
        return response()->json([ //بدي ارجع res names ->type json =>sent name = actives
            'names' => $actives
        ]);

    }

    function changemaster(Request $request){
// EVERY grade with stage => change on active to inactive
   $stage = Stage::query()->where('tag', $request->tagstage)->first();// from model stage where his tag == request tagstage for ajax [first :]just one element =>(stage).
   $gradeActive = Grade::query()->where('stage_id',$stage->id)->where('status','active')->get();//form model grade where stageid = $stage =>give me id and where  become status = active [get:all elements]
//    dd($gradeActive);

if($request->status == 1){//if is active== checked
    $stage->update([
        'status' =>'active' , // فقط الستيج اما الصفوف يحررهم بياده
    ]);

}else{//if is inactive = not checked
    $stage->update([
        'status' =>'inactive' ,
    ]);
    foreach($gradeActive as $g){//each grade
        $g->update([
          'status' =>'inactive' ,
        ]);
      }
}

return response()->json([
    'success' => ' تمت  العملية بنجاح '
]);

 }
}
