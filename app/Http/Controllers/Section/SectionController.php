<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    function index()
    {
        return view('dashboard.sections.index');
    }


    function getdata(Request $request)
    {
        $sections = Section::query();
        return DataTables::of($sections) //نفذ داتاتيبل على جدول grades
            ->addIndexColumn()
            ->addColumn('name', function ($qur) { //$qur):    الي بده ينطبعrow ...ويكون بمثابة المودل

                return 'الشعبة' . ' ' . $qur->name; //``: php من خلالهم بكتب كود
            })
            ->addColumn('action', function ($qur) { //$qur):    الي بده ينطبعrow ...ويكون بمثابة المودل
                $section = Section::query()->where('status', 'active')->orderBy('id', 'desc')->first();
                $sectiondisable =Section::query()->where('status', 'inactive')->first();
                if ($section->id == $qur->id) { //   مين اخر ةاحد مفعل بمشي صف ورا صف وبقارن
                    return '<div data-status="inactive" data-id ="'. $qur->id .'" class="form-check form-switch active-section-sw">
                             <input class="form-check-input" type="checkbox"
                             role="switch" id="flexSwitchCheckChecked" checked>
                            </div>';
                }
           //@$sectiondisable :@=> mean  null اقبل ال
                if(@$sectiondisable->id == $qur->id){ //data-status="active" data-id ="'. $qur->id . :   و هو اكتيف بده يصيؤ اكتيف id معنا اذا بعتت  معه
                   return '<div data-status="active" data-id ="'. $qur->id .'" class="form-check form-switch ">
                             <input class="form-check-input" type="checkbox"
                             role="switch" id="flexSwitchCheckDefualt">
                            </div>';
                }

                 return '-'; // لو الصف مش مفعل اعرض هذه -
            })
            ->addColumn('status', function ($qur) {
                if ($qur->status == 'active') {
                    return 'مفعل';
                }
                return 'غير مفعل';
            })
            ->make(true); //->make: support json
    }

    function add(Request $request)
    {
        // dd($request->all());
        // بدي ابعت رقم 5 مثال بتالي ينشالي 5 شعب
        // اذا بعتت رقم اعلى من الموجود في جدول الشعب من 8 وفوق بدك تنشا زيادة وتعمل كل الي قبل  اكتيف مفعل


        $newcount = (int)$request->count_section; //  count_section: الي بعتناه في الفورم
        $currentCount = Section::count(); // current :بدي اجيبه من الداتا بيز , count(): العدد الموجود داخل داتا بيز الي هو عنا 7 شعب
        //dd($newcount);  قبل التحويل "انبعتت كنص "8
        //dd($currentCount); انبعتت integer قبل التحويل

        if ($newcount > $currentCount) { //1-    معناته بدي انشا شعب جديدة  =>الحالةالاولي باعت اكبر من عدد الشعب الموجودة
            // dd($newcount-$currentCount);  new 10 =>ناتج dd => 3
            //name  : 1,2 ,3 ,4,5,6,7
            for ($i = $currentCount + 1; $i <= $newcount; $i++) {
                Section::create([
                    'name' => $i, // i=> 8 in first loop
                    'status' => 'active',
                ]);
            }
            $sectionInactive = Section::query()->where('status', 'inactive')->get(); // يجيب كل الشعب الي مش مفعلة من جدول شكسن
            foreach ($sectionInactive as $s) { // يحولهم لمفعل
                $s->update([
                    'status' => 'active',
                ]);
            }
            // 2-  اقل من عدد الشعب الموجود newcount  الحالة التانية يكون باعت
            // عندي في داتا بيز 11 بدي ابعت مثلا 10
        } elseif ($newcount < $currentCount) {
            $limit = $currentCount - $newcount; //  in  current 11 new 10 = 1 => limit($limit):=> بتجيب اخر 1  تم اضافتهم
            $lastSections = Section::query()->orderBy('id', 'desc')->limit($limit)->get(); //بدي اجحيب اخر واحد تم اضافاته
            //   dd($lastSections);
            foreach ($lastSections as $l) {
                $l->update([
                    'status' => 'inactive', // ما بحذفه فقط بحوله لغير مفعل
                ]);
            }
        } elseif ($newcount == $currentCount) { // current 12 ,new 12 =>  all 12 active
            $sectionInactive = Section::query()->where('status', 'inactive')->get(); // يجيب كل الشعب الي مش مفعلة من جدول شكسن
            foreach ($sectionInactive as $e) { // يحولهم لمفعل
                $e->update([
                    'status' => 'active',
                ]);
            }
        }
        // return user from model to page index
        return response()->json([
            'success' => ' تمت  العملية بنجاح '
        ]);
    }

  function changestatus(Request $request){

    $section = Section::query()->findOrFail($request->id);
    if($request->status == 'active'){
        $section->update([
         'status' => 'active'
      ]);
    } else{
       $section->update([
         'status' => 'inactive'
    ]);
 }
    return response()->json([
        'success' => ' تمت  العملية بنجاح '
    ]);
}
}
