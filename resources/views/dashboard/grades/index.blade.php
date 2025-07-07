@extends('dashboard.master')

@section('title')
        online school   | الصفحة الرئيسية للمستويات
@stop

@section('content')


 <main class="page-content">

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
          <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
              <div class="row g-3 align-items-center">
                <div class="col">
                  <h5 class="mb-0">جميع المستويات</h5>
                </div>
                <div class="col">
                  <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">

                  </div>
                </div>
               </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="datatable" class="table align-middle mb-0">
                  <thead class="table-light">
                    <tr>
                      <th>#</th>
                      <th>الاسم</th>
                      <th>المرحلة</th>
                      <th>الحالة</th>
                      <th>الشعبة</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
            <button class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#stagesModal">
                عرض المراحل الدراسية
              </button>

        </div>
      </div><!--end row-->




<div class="modal fade" id="sectionModal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="stagesModalLabel">الشعب</h5>
          <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <form >
        <div class="modal-body">

          <div class="container">

            <!-- المرحلة الابتدائية -->
            <div class="mb-4">
              <div class="d-flex align-items-center mb-2">

                <label class="form-label fw-bold mb-0" for="primary-master"> :فعل الشعب اللازمة  </label>
              </div>
              <input value=" " type="hidden" id="gradetag" name="gradetag">

              <div class="d-flex flex-wrap gap-3 primary-group">
                <div class="form-check">
                  <input  data-section="1" class="form-check-input section-checkbox" type="checkbox"  id="section-primary1">
                  <label class="form-check-label" for="primary1">الشعبة 1</label>
                </div>
                <div class="form-check">
                  <input   data-section="2"class="form-check-input section-checkbox"  type="checkbox" id="section-primary2">
                  <label class="form-check-label" for="primary2"> 2الشعبة </label>
                </div>
                <div class="form-check">
                  <input  data-section="3" class="form-check-input section-checkbox"   type="checkbox" id="section-primary3">
                  <label class="form-check-label" for="primary3"> 3 الشعبة</label>

                </div>
                <div class="form-check">
                  <input  data-section="4" class="form-check-input section-checkbox"   type="checkbox" id="section-primary4">
                  <label class="form-check-label" for="primary4"> 4 الشعبة</label>
                </div>
                <div class="form-check">
                  <input   data-section="5"class="form-check-input section-checkbox  "  type="checkbox" id="section-primary5">
                  <label class="form-check-label" for="primary5"> 5 الشعبة</label>
                </div>
                <div class="form-check">
                  <input  data-section="6" class="form-check-input section-checkbox  " type="checkbox" id="section-primary6">
                  <label class="form-check-label" for="primary6">الشعبة 6</label>
                </div>
                <div class="form-check">
                    <input  data-section="7" class="form-check-input  section-checkbox " type="checkbox" id="section-primary7">
                    <label class="form-check-label" for="primary6">الشعبة 7</label>
                  </div>
              </div>
            </div>


            </div>

          </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">إغلاق</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>




{{-----------------------------------------------model lect 14-------------------------------------------------}}


<div class="modal fade" id="stagesModal" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="stagesModalLabel">المراحل الدراسية</h5>
          <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <form >
        <div class="modal-body">

          <div class="container">

            <!-- المرحلة الابتدائية -->


          <div class="mb-4">
            <div class="d-flex align-items-center mb-2">
              <input data-tagstage="p" class="form-check-input me-2 master-checkbox" type="checkbox" id="primary-master"  data-target=".primary-group">
              <label class="form-label fw-bold mb-0" for="primary-master">المرحلةالابتدائية</label>
            </div>
            <div class="d-flex flex-wrap gap-3 primary-group">
              <div class="form-check">
                <input  data-name="الصف الاول" data-stage="p" data-tag="1" class="form-check-input grade-checkbox" type="checkbox" id="primary1">
                <label class="form-check-label" for="primary1">الاول</label>
              </div>
              <div class="form-check">
                <input  data-name="الصف الثاني" data-stage="p" data-tag="2"class="form-check-input grade-checkbox" type="checkbox" id="primary2">
                <label class="form-check-label" for="primary2">الثاني</label>
              </div>
              <div class="form-check">
                <input   data-name="الصف الثالث" data-stage="p" data-tag="3"class="form-check-input grade-checkbox" type="checkbox" id="primary3">
                <label class="form-check-label" for="primary3">الثالث</label>
              </div>
              <div class="form-check">
                <input   data-name="الصف الرابع" data-stage="p" data-tag="4"class="form-check-input grade-checkbox" type="checkbox" id="primary4">
                <label class="form-check-label" for="primary4">الرابع</label>
              </div>
              <div class="form-check">
                <input   data-name="الصف الخامس" data-stage="p" data-tag="5"class="form-check-input grade-checkbox" type="checkbox" id="primary5">
                <label class="form-check-label" for="primary5">الخامس</label>
              </div>
              <div class="form-check">
                <input   data-name="الصف السادس" data-stage="p" data-tag="6"class="form-check-input grade-checkbox" type="checkbox" id="primary6">
                <label class="form-check-label" for="primary6"> السادس</label>
              </div>


            </div>
          </div>
            <!-- المرحلة الإعدادية -->
            <div class="mb-4">
              <div class="d-flex align-items-center mb-2">
                <input data-tagstage="m" class="form-check-input me-2 master-checkbox" type="checkbox" id="prep-master grade-checkbox"  data-target=".prep-group">
                <label class="form-label fw-bold mb-0" for="prep-master">المرحلة الإعدادية</label>
              </div>
              <div class="d-flex flex-wrap gap-3 prep-group">
                <div class="form-check">
                  <input  data-name="الصف السابع" data-stage="m" data-tag="7" class="form-check-input grade-checkbox" type="checkbox" id="prep1">
                  <label class="form-check-label" for="prep1">السابع</label>
                </div>
                <div class="form-check">
                  <input  data-name="الصف الثامن" data-stage="m" data-tag="8"class="form-check-input grade-checkbox" type="checkbox" id="prep2">
                  <label class="form-check-label" for="prep2">الثامن</label>
                </div>
                <div class="form-check">
                  <input   data-name="الصف التاسع" data-stage="m" data-tag="9"class="form-check-input grade-checkbox" type="checkbox" id="prep3">
                  <label class="form-check-label" for="prep3">التاسع</label>
                </div>

              </div>
            </div>

            <!-- المرحلة الثانوية -->
            <div class="mb-4">
              <div class="d-flex align-items-center mb-2">
                <input   data-tagstage="H" class="form-check-input me-2 master-checkbox" type="checkbox" id="sec-master" data-target=".sec-group">
                <label class="form-label fw-bold mb-0" for="sec-master">المرحلة الثانوية</label>
              </div>
              <div class="d-flex flex-wrap gap-3 sec-group">
                <div class="form-check">
                  <input  data-name="الصف العاشر" data-stage="H" data-tag="10" class="form-check-input grade-checkbox" type="checkbox" id="sec1">
                  <label class="form-check-label" for="sec1">العاشر</label>
                </div>
                <div class="form-check">
                  <input  data-name="الصف الحادي عشر"data-stage="H" data-tag="11"class="form-check-input grade-checkbox" type="checkbox" id="sec2">
                  <label class="form-check-label" for="sec2">الحادي عشر</label>
                </div>
                <div class="form-check">
                  <input data-name="الصف الثاني عشر" data-stage="H" data-tag="12" class="form-check-input grade-checkbox" type="checkbox" id="sec3">
                  <label class="form-check-label" for="sec3"> الثاني عشر  </label>
                </div>

            </div>

          </div>

        </div>
       </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">إغلاق</button>
        </div>
      </form>

    </div>
  </div>
</div>
</main>

{{-- /////////////////////////////////////////////////// --}}


        @stop

        @section('js')
            <script>
            var  table = $('#datatable').DataTable({

                    processing: true,
                    serverSide: true,
                    responsive: true,

                    ajax: {
                        url: '{{ route('dash.grade.getdata') }}' //مسؤول عن عرض البيانات في داتا تيبل
                    },

                    //col الي بدي اعرضها

                    columns: [{
                            data: 'DT_RowIndex', //ترقيم في الجدول
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                        },

                        {
                            data: 'name', //
                            name: 'name',
                            title:'الاسم',
                            orderable: true,
                            searchable: true,
                        },

                        {
                            data: 'stage',  // function name
                            name: 'stage_id',//database name
                            title:'المرحلة',
                            orderable: true,
                            searchable: true,
                        },

                        {
                            data: 'status',
                            name: 'status',
                            title:'الحالة',
                            orderable: true,
                            searchable: true,
                        },

                        {
                            data: 'action',
                            name: 'action',
                            title:'الشعبة',
                            orderable: false,
                            searchable: false,
                        },


                    ],

                    // language: {
                    //     url:'cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json' // رابط الترجمة للداتاتيبل
                    // }

                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json' // لترجمة
                        }




                });


//script model
$('.master-checkbox').on('change', function() {
    var target = $(this).data('target');
    var checked = $(this).prop('checked');

    if (!checked) {
      $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات
    } else {
      $(target).find('input[type=checkbox]').prop('disabled', false); // تمكين التشيك بوكسات
    }
  });


  $('.grade-checkbox').on('change',function(){ //
     var checkbox = $(this);// كاني بقله الي صار عليه تغير خزنه داخل متغير
     var status = checkbox.is(':checked') ? 1 : 0 ; //if short handling يعني جملة شرط في سطر واحد 1:يعني صار تشك
      // بدي المرحلة والصف تبعه
       var stage = checkbox.data('stage'); // data type
       var tag  = checkbox.data('tag');
       var name  = checkbox.data('name');

       $.ajax({
        url: "{{route('dash.grade.add')}}" ,
        type:"post",
        data: {
            'stage': stage,// p, m ,H
            'name': name, //الصف الاول والصف الثاني....for each stage
            'tag': tag, //tag grade = 1,2,3,4,.... for each stage
            'status':status,//حالة check oe not
            '_token':"{{csrf_token()}}",
        },

        success: function(res){
        // console.log(res.message);
        //  toastr.success(res.success)// استخدم مكتبة توستر
         table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
        },

        error: function(res){
            alert('حدث مشكلة في الكود');

       },
       });
  });
/////////////////////////////////////////////ajax lect 15 for data active ///////////////////////////////

$.ajax({
   url:"{{route('dash.grade.getactive')}}" ,
   type :"GET" ,
   success: function(res){
     //لو جبلي ال active
      var activeTags = res.tags.map(Number); //from res get tags then convert to number about map ()
      // alert(activeTags);
      $('.grade-checkbox').not('.master-checkbox').each(function(){  // not: ما عدا (بدون)master.checkbox:المرحلة الابتدائية والاعدادية والثانوية
        var checkbox = $(this); //يعني هذا الشيك الي انا فيه
        var datatag = checkbox.data('tag'); // هاتلي من هذا الشيك data-tag = grade.
       //بدي اقارن  this datatag and tag from database
       if (activeTags.includes(datatag)){//if the num of html included in num from database or function then do the check
            checkbox.prop('checked' ,true);//prop:change the html [checkbox in html change to checked]
            checkbox.prop('disabled' ,false);
        }
    });
    } ,
});

//***********************************lect 15 :37:20  this for check الشعب ***********************************************************************************************
 $(document).ready(function(){  // becuse the button in controller not here ,then the line to arrive to this code .

    $(document).on('click' ,'.btn-add-section',function(e){
    e.preventDefault();// هيك تم تعطيل الزر
    var button = $(this); //هذا هو الزر المضغوط عليه حاليا
    var gradetag = button.data('tag');//هذا الزر موجود في داتا تايب =  data type = tag // هنا التقت التاج من البوتن  tag from button then go to add inside the input hidden
    //alert(gradetag);
    $('#gradetag').val(gradetag);//  هاتلي  العنصر الي id =gradetag then value = gradetag from button

    })
});

    $('.section-checkbox').on('change',function(){
     var checkbox = $(this);
     var status = checkbox.is(':checked') ? 1 : 0 ;

       var  section = checkbox.data('section');//data_section
       var gradetag  = $('#gradetag').val();//id = gradetag

       $.ajax({
        url: "{{route('dash.grade.addsection')}}" ,
        type:"post",
        data: {
             'section':section,
             'gradetag':gradetag,
             'status':status,//بعد ما ضفته في الجدول بدي ابعت مع البيانات
            '_token':"{{csrf_token()}}",
        },

        success: function(res){
        //  console.log(res.message);
        // toastr.success(res.success)
         table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
        },

        error: function(res){
            alert('حدث مشكلة في الكود');

       },
       });
  });
//////////////////////////////active grade/////////////////////////
    // $.ajax({
    //     url:"{{route('dash.grade.getactive')}}" ,
    //     type :"GET" ,
    //     success: function(res){

    //         var activeTags = res.tags.map(Number);

    //         $('.grade-checkbox').not('.master-checkbox').each(function(){
    //             var checkbox = $(this);
    //             var datatag = checkbox.data('tag');

    //         if (activeTags.includes(datatag)){
    //                 checkbox.prop('checked' ,true);
    //                 checkbox.prop('disabled' ,false);
    //             }
    //         });
    //         } ,
    // });
/////////////////////////////lect 16 0:24:12 for master checkbox ,stages //////////////////////////////////////////
    $.ajax({
        url:"{{route('dash.grade.getactive.stage')}}" ,
        type :"GET" ,
        success: function(res){ // [2]  tags <=وصلتني هنا برسبونس

            var activeTags = res.tags;// ما عملنا تحويل لرقم لانه تاج عبارة عن [p ,m,H]
            // alert(activeTags);

            $('.master-checkbox').each(function(){
                var checkbox = $(this);
                var datatagstage = checkbox.data('tagstage');

            if (activeTags.includes(datatagstage)){
                    checkbox.prop('checked' ,true);
                    checkbox.prop('disabled' ,false);
                }else{
                    checkbox.prop('checked' ,false);
                    var target = $(this).data('target');
                    $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات

             }
            });
            } ,
    });

  ////////////////////////////////change check box for stage //////////////////////////////////////////

  $('.master-checkbox').on('change',function(){ //
     var checkbox = $(this);// كاني بقله الي صار عليه تغير خزنه داخل متغير
     var status = checkbox.is(':checked') ? 1 : 0 ; //if short handling يعني جملة شرط في سطر واحد 1:يعني صار تشك
      // بدي المرحلة والصف تبعه
       // data type
       var tagstage = checkbox.data('tagstage');//p ,m ,h


       $.ajax({
        url: "{{route('dash.grade.changemaster')}}" ,
        type:"post",
        data: {
            'tag': tagstage , //tag grade = 1,2,3,4,.... for each stage
            'status':status,//حالة check oe not
            '_token':"{{csrf_token()}}",
        },

        success: function(res){
        // console.log(res.message);
        //  toastr.success(res.success)// استخدم مكتبة توستر
         table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
        },

    //     error: function(res){
    //         alert('حدث مشكلة في الكود');

    //    },
       });
  });
 ///////////////////////////////////lect 16 active for  section الشعب////////////////////////////////////////////////////////////

    //المشكلة: كانت انه كل الشعبة لكل الصفوف[2 ] ]
    ///الصف الي بدك تبحث عنه هات الاكتيف له وبسid  و خد معك get section  الحل :الامر المشترك في هذا المودل انه اضغط على زر الشعب فلما تضغط على زر ابعتلي رابط
    //يعني when click at btn then =>send the request not when reload =>send the request.
    //active for grade click.=>add in btn in  function getdata() =>data-tag-id="'.$qur->id.'".
    $(document).ready(function(){  // becuse the button in controller not here ,then the line to arrive to this code .

    $(document).on('click' ,'.btn-add-section',function(e){
    e.preventDefault();// هيك تم تعطيل الزر
    var button = $(this); //هذا هو الزر المضغوط عليه حاليا
    var gradeid = button.data('grade-id'); // function getdata()موجود في btn
    //alert(gradeid);tag id== gradeid

    $.ajax({//[1] active for  section الشعب
    url:"{{route('dash.grade.getactive.section')}}" ,
    type :"GET" ,
    data:{
        'gradeId': gradeid, // gradeid من المتغير id جياخد معه
    },
    success: function(res){
        //لو جبلي ال active
        var activeSection = res.names.map(Number); //from res get tags then convert to number about map ()
        $('.section-checkbox').not('.master-checkbox').each(function(){  // not: ما عدا (بدون)master.checkbox:الشعب 1 و2و3و----
            var checkbox = $(this); //يعني هذا الشيك الي انا فيه
            var datasection = checkbox.data('section'); // هاتلي من هذا الشيك data-section
        //بدي اقارن  this datasection and names from database
        if (activeSection.includes(datasection)){//if the num of html included in num from database or function then do the check .// اعمل شيك html يعني الي جاي من داتا بيز نفس الي في
                checkbox.prop('checked' ,true);//prop:change the html [checkbox in html change to checked]
                checkbox.prop('disabled' ,false);
              }else{
                checkbox.prop('checked' ,false);
              }
           });
          } ,
       });
    });
});

  </script>
   @stop
