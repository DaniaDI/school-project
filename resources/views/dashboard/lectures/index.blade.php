@extends('dashboard.master')

@section('title')
    مدرسة ليرن | الصفحة الرئيسية للمحاضرات
@stop

@section('content')


    <main class="page-content">
        {{-- ---------------------------------------------model lect 14 add model----------------------------------------------- --}}
        <div class="modal fade" id="add-model" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            {{-- model يكون تابت add model --}}
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel"> اضافة محاضرة جديد</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.lecture.add') }}" id="add-form" class="add-form">
                        {{-- form يكون تابت add form --}}
                        <div class="modal-body">

                            <div class="container">
                                {{-- ------------lect 17 addmodel for section--------------- --}}


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="mb-4 form-group">
                                    <label> عنوان المحاضرة </label>
                                    <input name="title" class="form-control" placeholder="عنوان المحاضرة">
                                    <div class="invalid-feedback"></div> {{-- error message like:the name field is required. --}}
                                </div>
                                <div class="mb-4 form-group">
                                    <label> وصف المحاضرة </label>
                                    <input name="description" type="text" class="form-control"
                                        placeholder=" وصف المحاضرة  ">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>المادة الدراسية </label>
                                    <select name="subject" class="form-control">
                                        <option selected disabled> اختر المادة الدراسية </option>
                                        @foreach ($subjects as $s)
                                            <option value="{{ $s->id }}"> {{ $s->title }} </option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label> مدرس المادة</label>
                                    <select name="teacher" class="form-control">
                                        <option selected disabled> اختر المدرس </option>
                                        @foreach ($teachers as $t)
                                            <option value="{{ $t->id }}"> {{ $t->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>رابط المحاضرة</label>
                                    <input name="link" type="url" class="form-control"
                                        placeholder="  رابط المحاضرة  ">
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
                        <h5 class="modal-title" id="stagesModalLabel"> تعديل محاضرة</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.lecture.update') }}" id="update-form" class="update-form">
                        {{-- form يكون تابت add form --}}
                        <div class="modal-body">

                            <div class="container">
                                {{-- ------------lect 17 addmodel for section--------------- --}}


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">



                                <div class="mb-4 form-group">
                                    <label> عنوان المحاضرة </label>
                                    <input name="title" class="form-control" placeholder="عنوان المحاضرة">
                                    <div class="invalid-feedback"></div> {{-- error message like:the name field is required. --}}
                                </div>
                                <div class="mb-4 form-group">
                                    <label> وصف المحاضرة </label>
                                    <input name="description" type="text" class="form-control"
                                        placeholder=" وصف المحاضرة  ">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>المادة الدراسية </label>
                                    <select name="subject" class="form-control">
                                        <option selected disabled> اختر المادة الدراسية </option>
                                        @foreach ($subjects as $s)
                                            <option value="{{ $s->id }}"> {{ $s->title }} </option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label> مدرس المادة</label>
                                    <select name="teacher" class="form-control">
                                        <option selected disabled> اختر المدرس </option>
                                        @foreach ($teachers as $t)
                                            <option value="{{ $t->id }}"> {{ $t->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-4 form-group">
                                    <label>رابط المحاضرة</label>
                                    <input name="link" type="url" class="form-control"
                                        placeholder="  رابط المحاضرة  ">
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
        {{-- <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">

                            <div class="col">
                                <h5 class="mb-0">جميع المحاضرات</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary col-12 btn-add" data-bs-toggle="modal"
                            data-bs-target="#add-model">
                            اضافة محاضرة
                        </button>

                    </div>
                </div>
            </div>
        </div> --}}


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
                                <input type="text" id="search-title-lecture" class="form-control search-input"
                                    placeholder="عنوان المحاضرة">
                            </div>

                            <div class="col-md-4 mb-3">
                                <input type="text" id="search-name-teacher" class="form-control search-input" placeholder="اسم المعلم">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2 mb-3">
                            <button type="submit" id="search-btn" class="btn btn-outline-success col-6">بحث</button>
                            <button type="reset"id="reset-btn" class="btn btn-outline-secondary col-6 ">تنظيف</button>
                        </div>

                        <button class="btn btn-outline-primary col-12 btn-add" data-bs-toggle="modal"
                            data-bs-target="#add-model">
                            اضافة محاضرة
                        </button>

                    </div>
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
                                      <h5 class="mb-0">جميع المحاضرات</h5>
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
                                            <th>العنوان</th>
                                            <th> الوصف </th>
                                            <th>رابط المحاضرة</th>
                                            <th>اسم المعلم</th>
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
                url: "{{ route('dash.lecture.getdata') }}",
                data: function(n) { // متغير n : name نائب عن
                    //n.subject = $('#search-subject').val();
                    n.title = $('#search-title-lecture').val();
                    n.teacher = $('#search-name-teacher').val();
                            }


            },


            columns: [{
                    data: 'DT_RowIndex', //ترقيم في الجدول
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'title',
                    name: 'title',
                    title: 'العنوان',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'description',
                    name: 'description',
                    title: 'الوصف',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'link',
                    name: 'link',
                    title: 'رابط المحاضرة',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'teacher',
                    name: 'teacher',
                    title: 'اسم المعلم',
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

        //////////////////////////////////////////////////////////////////
        $('#search-btn').on('click', function(e) {
        e.preventDefault();
        table.draw();
    });


        $('#reset-btn').on('click',function(e){//    اعملي search-btn لما نضغط على
            e.preventDefault();
            $('.search-input').val("").trigger('change');
            table.draw();
        });

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

        $('.btn-add').on('click', function(e) { //class name = btn-add in button when click
            $('input').removeClass('is-invalid'); // when click =>make every input remove class name= is-invalid
            $('select').removeClass('is-invalid');
            $('.invalid-feedback').text(''); // make every class name invalid -feedback =>his text is empty
        });

        ///lect 20 => 12:09
        $(document).ready(function(e) { // هاي عشان مكتوب ب الكونترولور
            $(document).on('click', '.active-btn', function(e) {
                e.preventDefault();
                var button = $(this);
                var id = button.data('id');
                var url = button.data('url');
                swal({
                    title: "هل انت متاكد من العملية ",
                    text: " سيتم  تفعيل العنصر المعطل ",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "الغاء",
                            value: null,
                            visible: true, // <--- كنت كاتبة visable خطأ، لازم visible
                            className: "custom-cancel-btn",
                            closeModal: true, // كان مكتوب closeModel خطأ
                        },
                        confirm: {
                            text: "تأكيد",
                            value: true,
                            visible: true,
                            className: "custom-confirm-btn",
                            closeModal: true,
                        }
                    },
                    dangerMode: false
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            type: "post",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                table.draw();
                                // toastr.success(res.success);
                            }
                        });
                    } else {
                        toastr.error('تم الغاء عملية التفعيل');
                    }
                });
            });
        });
    </script>
@stop
