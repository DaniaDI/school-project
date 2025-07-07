@extends('dashboard.master')

@section('title')
online school   | الصفحة الرئيسية للمعلمين
@stop

@section('content')


    <main class="page-content">
        {{-- ---------------------------------------------model lect 14 add model----------------------------------------------- --}}
        <div class="modal fade" id="add-model" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            {{-- model يكون تابت add model --}}
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel"> اضافة معلم جديد</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.teacher.add') }}" id="add-form" class="add-form">
                        {{-- form يكون تابت add form --}}
                        <div class="modal-body">

                            <div class="container">
                                {{-- ------------lect 17 addmodel for section--------------- --}}


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="mb-4 form-group">
                                    <label>الاسم الكامل </label>
                                    <input name="name" class="form-control" placeholder="الاسم الكامل">
                                    <div class="invalid-feedback"></div> {{-- error message like:the name field is required.--}}
                                </div>
                                <div class="mb-4 form-group">
                                    <label> البريد الالكتروني </label>
                                    <input name="email" type="email" class="form-control"
                                        placeholder="البريد الالكتروني">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label> رقم الهاتف</label>
                                    <input name="phone" class="form-control" placeholder="رقم الهاتف">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label> التخصص الجامعي</label>
                                    <input name="spec" class="form-control" placeholder="التخصص الجامعي">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label>المؤهل العلمي </label>
                                    <select name="qualification" class="form-control">
                                        <option selected disabled> اختر المؤهل العلمي</option>
                                        <option value="Diploma"> دبلوم </option>
                                        <option value="Bachelors"> بكالوريوس </option>
                                        <option value="Master"> ماجستير </option>
                                        <option value="Dr"> دكتوراه </option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label> الجنس</label>
                                    <select name="gender" class="form-control">
                                        <option selected disabled> اختر الجنس </option>
                                        <option value="m"> ذكر </option>
                                        <option value="fm"> انثى </option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label> تاريخ التعيين</label>
                                    <input name="hire_date" type="date" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label> تاريخ الميلاد</label>
                                    <input name="date_of_birth" type="date" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>






                            </div>
                        </div>
                        <div class="modal-footer mb-3">
                            <button class="btn btn-outline-success col-12" type="submit"> اضافة</button>
                            <button type="button" class="btn btn-outline-secondary col-12 mb-3"
                                data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        {{-- ------------------------------------lect 20 update model-------------------------------------------------------------------- --}}
        <div class="modal fade" id="update-model" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel"> تعديل المعلم</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.teacher.update') }}" id="update-form" class="update-form">
                        {{-- form يكون تابت add form --}}
                        <div class="modal-body">

                            <div class="container">
                                {{-- ------------lect 17 addmodel for section--------------- --}}


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="mb-4 form-group">{{-- form-group  befor input --}}
                                    <label>الاسم الكامل </label>
                                    <input name="name" id="name" class="form-control"{{-- id عشان يمسك البيانات المدخلة --}}
                                        placeholder="الاسم الكامل">
                                    <div class="invalid-feedback"></div>{{-- invalid-feedback after input --}}
                                </div>
                                <div class="mb-4 form-group">
                                    <label> البريد الالكتروني </label>
                                    <input name="email" id="email" type="email" class="form-control"
                                        placeholder="البريد الالكتروني">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label> رقم الهاتف</label>
                                    <input name="phone" id="phone" class="form-control" placeholder="رقم الهاتف">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label> التخصص الجامعي</label>
                                    <input name="spec" id="spec" class="form-control"
                                        placeholder="التخصص الجامعي">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label>المؤهل العلمي </label>
                                    <select name="qualification" id="qualification" class="form-control">
                                        <option selected disabled> اختر المؤهل العلمي</option>
                                        <option value="Diploma"> دبلوم </option>
                                        <option value="Bachelors"> بكالوريوس </option>
                                        <option value="Master"> ماجستير </option>
                                        <option value="Dr"> دكتوراه </option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4 form-group">
                                    <label> الجنس</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option selected disabled> اختر الجنس </option>
                                        <option value="m"> ذكر </option>
                                        <option value="fm"> انثى </option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4  form-group">
                                    <label> الحالة</label>
                                    <select name="status" id="status" class="form-control">
                                        <option selected disabled> اختر الحالة </option>
                                        <option value="active"> مفعل </option>
                                        <option value="inactive"> معطل </option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label> تاريخ التعيين</label>
                                    <input name="hire_date" id="hire_date" type ="date" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label> تاريخ الميلاد</label>
                                    <input name="date_of_birth" id="date_of_birth" type ="date" class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer mb-3">
                            <button class="btn btn-outline-info col-12" type="submit">تعديل</button>
                            <button type="button" class="btn btn-outline-secondary col-12 mb-3"
                                data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!--****************************************lect 21 subjects filter*****************************************-->
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h5 class="mb-0">التصفية </h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">

                                </div>
                            </div>
                        </div>
                    </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                <input type="text"    id="search-name" class="form-control  search-input " placeholder="الاسم المعلم">

            </div>
            <div class="col-md-4 mb-3">
                <input type="email" id="search-email" class="form-control search-input"
                    placeholder="البريد الالكتروني">

            </div>
            <div class="col-md-4 mb-3">
                <input  type="text" id="search-phone"  class="form-control search-input" placeholder="رقم الجوال">

            </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mb-3">
            <button  type="submit" id="search-btn" class="btn btn-outline-success col-6">بحث</button>
            <button type="reset"id="reset-btn" class="btn btn-outline-secondary col-6 ">تنظيف</button>

        </div>
        <button class="btn btn-outline-primary col-12 btn-add" data-bs-toggle="modal"
         data-bs-target="#add-model">
         اضافة معلم
        </button>
    </div>
</div>
</div>
            <!--*********************************************************************************-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h5 class="mb-0">جميع المعلمين</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table align-middle mb-0 ">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الالكتروني</th>
                                        <th>رقم الهاتف</th>
                                        <th>تاريخ الميلاد</th>
                                        <th>تاريخ التعيين </th>
                                        <th>الجنس</th>
                                        <th>التخصص الجامعي</th>
                                        <th>المؤهل العلمي </th>
                                        <th>الحالة</th>
                                        <th>العمليات</th>
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
                <button class="btn btn-primary col-12 btn-add" data-bs-toggle="modal" data-bs-target="#add-model">
                    اضافة معلم
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
        var table = $('#datatable').DataTable({

            processing: true,
            serverSide: true,
            responsive: true,

            ajax: {
                url: "{{ route('dash.teacher.getdata') }}",
                data: function(n){ // متغير n : name نائب عن
                   n.name = $('#search-name').val(); // first request -> name => search-name give me value .
                   n.email =$('#search-email').val();
                   n.phone =$('#search-phone').val();
                }
            },


            columns: [{
                    data: 'DT_RowIndex', //ترقيم في الجدول
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'name', //
                    name: 'name',
                    title: 'الاسم',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'email', //
                    name: 'email',
                    title: 'البريد الالكتروني',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'phone', //
                    name: 'phone',
                    title: 'رقم الهاتف',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'date_of_birth', //
                    name: 'date_of_birth',
                    title: 'تاريخ الميلاد',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'hire_date', //
                    name: 'hire_date',
                    title: 'تاريخ التعيين',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'gender', //
                    name: 'gender',
                    title: 'الجنس',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'spec', //
                    name: 'spec',
                    title: 'التخصص الجامعي',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'qualification', //
                    name: 'qualification',
                    title: 'المؤهل العلمي',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'status',
                    name: 'status',
                    title: 'الحالة',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'action',
                    name: 'action',
                    title: 'العمليات',
                    orderable: false,
                    searchable: false,
                },


            ],

            // language: {
            //     url:'cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json' // رابط الترجمة للداتاتيبل
            // }

            language: {

                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json',

 // لترجمة
              //  url: "{{ asset('datatable_custom/i18n/ar.json') }}",
            }
        });
// lect 21 ////////in master added///////////////////////////////////////////

     //  in master وتاخد معها الداتا تبعت الفلتر  controller تروح على get data  زر البحث هدا بخلي
        // $('#search-btn').on('click',function(e){//    اعملي search-btn لما نضغط على
        //     e.preventDefault();
        //     table.draw();
        // });

        // $('#reset-btn').on('click',function(e){//    اعملي search-btn لما نضغط على
        //     e.preventDefault();
        //     $('.search-input').val("").trigger('change');
        //     table.draw();
        // });

//////////////////////////////////////////////////////////////////
        $(document).ready(function() {
            $(document).on('click', '.update_btn', function(e) {
                e.preventDefault();
                var button = $(this); // btn  this click .
                var id = button.data('id'); //كدا التقتهم  من الكونترور
                // alert(id);
                var name = button.data('name');
                var phone = button.data('phone');
                var email = button.data('email');
                var spec = button.data('spec');
                var qualification = button.data('qualification');
                var gender = button.data('gender');
                var hire_date = button.data('hire-date');
                var date_of_birth = button.data('date-of-birth');
                var status = button.data('status');

                /// inputs in form
                $('#id').val(id);
                $('#name').val(name);
                $('#phone').val(phone);
                $('#email').val(email);
                $('#spec').val(spec);
                $('#qualification').val(qualification);
                $('#gender').val(gender);
                $('#hire_date').val(hire_date);
                $('#date_of_birth').val(date_of_birth);
                $('#status').val(status);


            });
        });

        $('.btn-add').on('click',function(e){//class name = btn-add in button when click
            $('input').removeClass('is-invalid'); // when click =>make every input remove class name= is-invalid
            $('select').removeClass('is-invalid');
            $('.invalid-feedback').text('');// make every class name invalid -feedback =>his text is empty
      });

///lect 20 => 12:09
      $(document).ready(function(e) { // هاي عشان مكتوب ب الكونترولور
            $(document).on('click', '.active-btn', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.data('id');
                var url = button.data('url');
                swal({//sweetalert
                    title: "هل انت متاكد من العملية ",
                    text: " سيتم  تفعيل العنصر المعطل ",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "الغاء",
                            value: null,
                            visable: true,
                            className: "custom-cancel-btn",
                            closeModel: true,
                        },
                        confirm: {
                            text: "احذف",
                            value: true,
                            visable: true,
                            className: "custom-confrim-btn",
                            closeModel: true,
                        },
                    },
                    dangerMode: false,

                }).then((willDelete) => { // اذا تمت العملية الحذف
                    if (willDelete) { // يعني ضغط على اي زر
                        $.ajax({
                            url: url, // btn data
                            type: "post",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(res) {
                                toastr.success(res.success)
                                table.draw();

                            },

                        });
                    } else { // لو ما ضغط على زر الموافق
                        toastr.error('تم الغاء عملية التفعيل')
                    }
                });
            });
        });




        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////lect 19  بدي اخد الداتا من الفورم  وبعدها ابعتها بالفنكشن//////////////////////////////////////
    </script>
@stop
