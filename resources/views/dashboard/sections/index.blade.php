@extends('dashboard.master')

@section('title')
     مدرسة ليرن   | الصفحة الرئيسية للمستويات
@stop

@section('content')


    <main class="page-content">
        {{-- ---------------------------------------------model lect 14----------------------------------------------- --}}
        <div class="modal fade" id="add-model" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel"> جميع الشعب</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>

                        <div class="modal-body">

                            <div class="container">
                                {{-- ------------lect 17 addmodel for section--------------- --}}

                                <form method="post" action="{{ route('dash.section.add') }}" id="add-form" >
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="mb-4">
                                        <label>عدد الشعب المرغوب بها:</label>
                                        <input  class="form-control" name="count_section" placeholder="">
                                    </div>
                                    <button class="btn btn-outline-success col-12" type="submit"> اضافة</button>
                                </form>




                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">إغلاق</button>
                        </div>


                </div>
            </div>
        </div>

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
                <button class="btn btn-primary col-12" data-bs-toggle="modal" data-bs-target="#add-model">
                     اضافة الشعب
                </button>

            </div>
        </div>
        </div>
        </div>
        <!--end row-->








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
                                  url:  '{{route('dash.section.getdata')}}'
                            },
        //                     //col الي بدي اعرضها
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
                                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json', // لترجمة
                                    url:"{{ asset('datatable_custom/i18n/ar.json') }}" ,
                                }
                            });

 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////lect 17  بدي اخد الداتا من الفورم  وبعدها ابعتها بالفنكشن//////////////////////////////////////


  //FormData:  submit بتجيب كل الانبوت الي انا محدده داخل الفورم لما اعمل
 $('#add-form').on('submit',function(e){ //  submit form عند ما يصير
              e.preventDefault();// stop default work.=>عشان اشتغل بطريقتي على الاجاكس
              var data = new FormData(this);//this: يعني بدي اخد افورم داتا انفذها على الفورم الي انا فيه
               var url = $(this).attr('action');//this : form , give me attribute  name in form action
               var type = $(this).attr('method');//this : form , give me attribute type:  name in form methode
            //   alert('dania');
            //  url ,type ,success ->model hide ,reset  الي بتغير هنا
              $.ajax({
                url: url, // ضفت الرابط في الاكشن في الفورم
                type:type,
                processData: false,// in defult data send at string =>here we dont need data string [fotmdata =لها شكلية خاصة بيها لاراسال البيانات]
                contentType: false,//بخلي المتصفح نفسه هو الي يحدد كل نوع انبوت الي بده ينبعت فيه البيانات
                data: data, //بجيب الداتا مها كان عدد الانبوت
                success: function(res){
                $('#add-model').modal('hide');//  بعد  ما نجح بعمل  انه اخفاء لمودل
                $('#add-form').trigger('reset');// انه لما ادخل الرقم مثللا 11 بعدها خلص يروح ما يضل موجود
                 //toastr.success(res.success);// استخدم مكتبة توستر
                 table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
                },

               });
          });

      $(document).ready(function(){  // becuse the button in controller not here ,then the line to arrive to this code .

            $(document).on('change' ,'.active-section-sw',function(e){ // زر السوتش
            e.preventDefault();// هيك تم تعطيل الزر
            var id = $(this).data('id');
            var status = $(this).data('status');
            $.ajax({ // id for last row active=>بدي ابعته مع الحالة الموجودة
                url: "{{ route('dash.section.changestatus') }}" ,//changestatus :disable
                type:"post",
                 data:{
                    'id' : id ,
                    'status':status,
                    '_token':"{{ csrf_token() }}",
                 },
                success: function(res){
                // toastr.success(res.success)// استخدم مكتبة توستر
                 table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
                  },
                });
              });
            });



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //script model
        // $('.master-checkbox').on('change', function() {
        //     var target = $(this).data('target');
        //     var checked = $(this).prop('checked');

        //     if (!checked) {
        //       $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات
        //     } else {
        //       $(target).find('input[type=checkbox]').prop('disabled', false); // تمكين التشيك بوكسات
        //     }
        //   });


        //   $('.grade-checkbox').on('change',function(){ //
        //      var checkbox = $(this);// كاني بقله الي صار عليه تغير خزنه داخل متغير
        //      var status = checkbox.is(':checked') ? 1 : 0 ; //if short handling يعني جملة شرط في سطر واحد 1:يعني صار تشك
        //       // بدي المرحلة والصف تبعه
        //        var stage = checkbox.data('stage'); // data type
        //        var tag  = checkbox.data('tag');
        //        var name  = checkbox.data('name');

        //        $.ajax({
        //         url: "{{ route('dash.grade.add') }}" ,
        //         type:"post",
        //         data: {
        //             'stage': stage,// p, m ,H
        //             'name': name, //الصف الاول والصف الثاني....for each stage
        //             'tag': tag, //tag grade = 1,2,3,4,.... for each stage
        //             'status':status,//حالة check oe not
        //             '_token':"{{ csrf_token() }}",
        //         },

        //         success: function(res){
        //         // console.log(res.message);
        //          toastr.success(res.success)// استخدم مكتبة توستر
        //          table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
        //         },

        //         error: function(res){
        //             alert('حدث مشكلة في الكود');

        //        },
        //        });
        //   });
        // /////////////////////////////////////////////ajax lect 15 for data active ///////////////////////////////

        // $.ajax({
        //    url:"{{ route('dash.grade.getactive') }}" ,
        //    type :"GET" ,
        //    success: function(res){
        //      //لو جبلي ال active
        //       var activeTags = res.tags.map(Number); //from res get tags then convert to number about map ()
        //       // alert(activeTags);
        //       $('.grade-checkbox').not('.master-checkbox').each(function(){  // not: ما عدا (بدون)master.checkbox:المرحلة الابتدائية والاعدادية والثانوية
        //         var checkbox = $(this); //يعني هذا الشيك الي انا فيه
        //         var datatag = checkbox.data('tag'); // هاتلي من هذا الشيك data-tag = grade.
        //        //بدي اقارن  this datatag and tag from database
        //        if (activeTags.includes(datatag)){//if the num of html included in num from database or function then do the check
        //             checkbox.prop('checked' ,true);//prop:change the html [checkbox in html change to checked]
        //             checkbox.prop('disabled' ,false);
        //         }
        //     });
        //     } ,
        // });

        //***********************************lect 15 :37:20  this for check الشعب ***********************************************************************************************
        //  $(document).ready(function(){  // becuse the button in controller not here ,then the line to arrive to this code .

        //     $(document).on('click' ,'.btn-add-section',function(e){
        //     e.preventDefault();// هيك تم تعطيل الزر
        //     var button = $(this); //هذا هو الزر المضغوط عليه حاليا
        //     var gradetag = button.data('tag');//هذا الزر موجود في داتا تايب =  data type = tag // هنا التقت التاج من البوتن  tag from button then go to add inside the input hidden
        //     //alert(gradetag);
        //     $('#gradetag').val(gradetag);//  هاتلي  العنصر الي id =gradetag then value = gradetag from button

        //     })
        // });

        //     $('.section-checkbox').on('change',function(){
        //      var checkbox = $(this);
        //      var status = checkbox.is(':checked') ? 1 : 0 ;

        //        var  section = checkbox.data('section');//data_section
        //        var gradetag  = $('#gradetag').val();//id = gradetag

        //        $.ajax({
        //         url: "{{ route('dash.grade.addsection') }}" ,
        //         type:"post",
        //         data: {
        //              'section':section,
        //              'gradetag':gradetag,
        //              'status':status,//بعد ما ضفته في الجدول بدي ابعت مع البيانات
        //             '_token':"{{ csrf_token() }}",
        //         },

        //         success: function(res){
        //         //  console.log(res.message);
        //         toastr.success(res.success)
        //          table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
        //         },

        //         error: function(res){
        //             alert('حدث مشكلة في الكود');

        //        },
        //        });
        //   });
        //////////////////////////////active grade/////////////////////////
            // $.ajax({
            //     url:"{{ route('dash.grade.getactive') }}" ,
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
            // $.ajax({
            //     url:"{{ route('dash.grade.getactive.stage') }}" ,
            //     type :"GET" ,
            //     success: function(res){ // [2]  tags <=وصلتني هنا برسبونس

            //         var activeTags = res.tags;// ما عملنا تحويل لرقم لانه تاج عبارة عن [p ,m,H]
            //         // alert(activeTags);

            //         $('.master-checkbox').each(function(){
            //             var checkbox = $(this);
            //             var datatagstage = checkbox.data('tagstage');

            //         if (activeTags.includes(datatagstage)){
            //                 checkbox.prop('checked' ,true);
            //                 checkbox.prop('disabled' ,false);
            //             }else{
            //                 checkbox.prop('checked' ,false);
            //                 var target = $(this).data('target');
            //                 $(target).find('input[type=checkbox]').prop('disabled', true); // تعطيل التشيك بوكسات

            //          }
            //         });
            //         } ,
            // });

          ////////////////////////////////change check box for stage //////////////////////////////////////////

        //   $('.master-checkbox').on('change',function(){ //
        //      var checkbox = $(this);// كاني بقله الي صار عليه تغير خزنه داخل متغير
        //      var status = checkbox.is(':checked') ? 1 : 0 ; //if short handling يعني جملة شرط في سطر واحد 1:يعني صار تشك
        //       // بدي المرحلة والصف تبعه
        //        // data type
        //        var tagstage = checkbox.data('tagstage');//p ,m ,h


        //        $.ajax({
        //         url: "{{ route('dash.grade.changemaster') }}" ,
        //         type:"post",
        //         data: {
        //             'tag': tagstage , //tag grade = 1,2,3,4,.... for each stage
        //             'status':status,//حالة check oe not
        //             '_token':"{{ csrf_token() }}",
        //         },

        //         success: function(res){
        //         // console.log(res.message);
        //          toastr.success(res.success)// استخدم مكتبة توستر
        //          table.draw();//draw:برجع بطلب الداتا تاني الي موجودة في داتا تيبل
        //         },

        //         error: function(res){
        //             alert('حدث مشكلة في الكود');

        //        },
        //        });
        //   });
         ///////////////////////////////////lect 16 active for  section الشعب////////////////////////////////////////////////////////////

            //المشكلة: كانت انه كل الشعبة لكل الصفوف[2 ] ]
            ///الصف الي بدك تبحث عنه هات الاكتيف له وبسid  و خد معك get section  الحل :الامر المشترك في هذا المودل انه اضغط على زر الشعب فلما تضغط على زر ابعتلي رابط
            //يعني when click at btn then =>send the request not when reload =>send the request.
            //active for grade click.=>add in btn in  function getdata() =>data-tag-id="'.$qur->id.'".
        //     $(document).ready(function(){  // becuse the button in controller not here ,then the line to arrive to this code .

        //     $(document).on('click' ,'.btn-add-section',function(e){
        //     e.preventDefault();// هيك تم تعطيل الزر
        //     var button = $(this); //هذا هو الزر المضغوط عليه حاليا
        //     var gradeid = button.data('grade-id'); // function getdata()موجود في btn
        //     //alert(gradeid);tag id== gradeid

        //     $.ajax({//[1] active for  section الشعب
        //     url:"{{ route('dash.grade.getactive.section') }}" ,
        //     type :"GET" ,
        //     data:{
        //         'gradeId': gradeid, // gradeid من المتغير id جياخد معه
        //     },
        //     success: function(res){
        //         //لو جبلي ال active
        //         var activeSection = res.names.map(Number); //from res get tags then convert to number about map ()
        //         $('.section-checkbox').not('.master-checkbox').each(function(){  // not: ما عدا (بدون)master.checkbox:الشعب 1 و2و3و----
        //             var checkbox = $(this); //يعني هذا الشيك الي انا فيه
        //             var datasection = checkbox.data('section'); // هاتلي من هذا الشيك data-section
        //         //بدي اقارن  this datasection and names from database
        //         if (activeSection.includes(datasection)){//if the num of html included in num from database or function then do the check .// اعمل شيك html يعني الي جاي من داتا بيز نفس الي في
        //                 checkbox.prop('checked' ,true);//prop:change the html [checkbox in html change to checked]
        //                 checkbox.prop('disabled' ,false);
        //               }else{
        //                 checkbox.prop('checked' ,false);
        //               }
        //            });
        //           } ,
        //        });
        //     });
        // });
    </script>
@stop
