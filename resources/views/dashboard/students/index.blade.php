@extends('dashboard.master')

@section('title')
    مدرسة ليرن | صفحة المواد
@stop

@section('content')
    <main class="page-content">
        <!--import model lect 23part2-->
        <div class="modal fade" id="import-model" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة ملف اكسل جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.student.import') }}"
                        enctype="multipart/form-data">

                            @csrf


                     <div class="modal-body">
                         <div class="modal-container">
                            <input type="hidden" name="id" id="id" value="{{csrf_token()}}">

                            <div class="mb-3 form-group">
                                <label>ملف  الاكسل </label>
                                <input name="excel" type="file" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-success col-12" type="submit">إضافة</button>
                            <button type="button" class="btn btn-outline-secondary col-12"
                                data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Add Subject Modal -->
        <div class="modal fade" id="add-model" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة طالب جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                     <form method="post" action="{{ route('dash.student.add') }}" id="add-form" class="add-form"
                        enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">
                         <div class="modal-container">
                            <input type="hidden" name="id" id="id" value="{{csrf_token()}}">

                            <div class="mb-3 form-group">
                                <label> الاسم الطالب الاول</label>
                                <input name="first_name" id="first_name" type="text" class="form-control"
                                    placeholder="   اسم الطالب الاول">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> الاسم الطالب الاخير</label>
                                <input name="last_name" id="last_name" type="text" class="form-control"
                                    placeholder="اسم الطالب الاخير ">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> البريد الالكتروني </label>
                                <input name="email" id="email" type="email" class="form-control"
                                    placeholder=" البريد الالكتروني">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>الاسم ولي الامر</label>
                                <input name="parent_name" id="parent_name" type="text" class="form-control"
                                    placeholder="اسم ولي الامر">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>رقم هاتف ولي الامر</label>
                                <input name="parent_phone" id="parent_phone" type="phone" class="form-control"
                                    placeholder="  رقم  الهاتف ولي الامر">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>تاريخ الميلاد</label>
                                <input name="date_of_birth" id="date_of_birth" type="date" class="form-control"
                                    placeholder="تاريخ  الميلاد">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> الشعبة الدراسية</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option selected disabled>اختر الشعبة</option>
                                    @foreach ($sections as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}الشعبة</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>الصف الدراسي</label>
                                <select name="grade_id" id="grade_id" class="form-control">
                                    <option selected disabled>اختر الصف</option>
                                    @foreach ($grades as $g)
                                        <option value="{{ $g->tag }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> الجنس </label>
                                <select name="gender" id="gender" class="form-control">
                                    <option selected disabled>اختر الجنس</option>
                                    <option value="m">ذكر</option>
                                    <option value="fm">انثى</option>

                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-success col-12" type="submit">إضافة</button>
                            <button type="button" class="btn btn-outline-secondary col-12"
                                data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Update Subject Modal -->
        <div class="modal fade" id="update-model" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الطالب</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route('dash.student.update') }}" id="update-form" class="update-form"
                        enctype="multipart/form-data">
                      @csrf

                        <div class="modal-body">
                         <div class="modal-container">
                            <input type="hidden" name="id" id="id" value="{{csrf_token()}}">

                            <div class="mb-3 form-group">
                                <label> الاسم الطالب الاول</label>
                                <input name="first_name" id="first_name" type="text" class="form-control"
                                    placeholder="   اسم الطالب الاول">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> الاسم الطالب الاخير</label>
                                <input name="last_name" id="last_name" type="text" class="form-control"
                                    placeholder="اسم الطالب الاخير ">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> البريد الالكتروني </label>
                                <input name="email" id="email" type="email" class="form-control"
                                    placeholder=" البريد الالكتروني">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>الاسم ولي الامر</label>
                                <input name="parent_name" id="parent_name" type="text" class="form-control"
                                    placeholder="اسم ولي الامر">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>رقم هاتف ولي الامر</label>
                                <input name="parent_phone" id="parent_phone" type="phone" class="form-control"
                                    placeholder="  رقم  الهاتف ولي الامر">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>تاريخ الميلاد</label>
                                <input name="date_of_birth" id="date_of_birth" type="date" class="form-control"
                                    placeholder="تاريخ  الميلاد">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> الشعبة الدراسية</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option selected disabled>اختر الشعبة</option>
                                    @foreach ($sections as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}الشعبة</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label>الصف الدراسي</label>
                                <select name="grade_id" id="grade_id" class="form-control">
                                    <option selected disabled>اختر الصف</option>
                                    @foreach ($grades as $g)
                                        <option value="{{ $g->tag }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 form-group">
                                <label> الجنس </label>
                                <select name="gender" id="gender" class="form-control">
                                    <option selected disabled>اختر الجنس</option>
                                    <option value="m">ذكر</option>
                                    <option value="fm">انثى</option>

                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-info col-12" type="submit">تعديل</button>
                            <button type="button" class="btn btn-outline-secondary col-12"
                                data-bs-dismiss="modal">إغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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


                    <!-- Filters -->
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <input  name="first_name" type="text" id="search-student" class="form-control search-input"
                                    placeholder="بحث عن اسم الطالب  ">
                            </div>
                            <div class="col-md-4 mb-3">
                                <select id="search-section" class="form-control search-input">
                                    <option value="">اختر الشعبة</option>
                                    @foreach ($sections as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}الشعبة</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <select id="search-grade" class="form-control search-input">
                                    <option value="">اختر الصف</option>
                                    @foreach ($grades as $g)
                                        <option value="{{ $g->tag }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mb-3">
                            <button id="search-btn" class="btn btn-outline-success col-6">بحث</button>
                            <button id="reset-btn" class="btn btn-outline-secondary col-6">تنظيف</button>
                        </div>

                        <button class="btn btn-outline-primary col-12 mb-2 btn-add" data-bs-toggle="modal"
                            data-bs-target="#add-model">
                            إضافة طالب جديد
                        </button>
                        <button class="btn btn-outline-primary col-12  btn-add" data-bs-toggle="modal"
                        data-bs-target="#import-model">
                        إضافة عبر الاكسل
                    </button>

                    </div>
                </div>
            </div>
            <!-- DataTable -->

            <div class="row">
                <div class="col-12 col-lg-12 col-xl-12 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header bg-transparent">
                            <div class="row g-3 align-items-center">
                                <div class="col">
                                    <h5 class="mb-0">جميع الطلاب</h5>
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
                                            <th>الاسم الاول</th>
                                            <th>الاسم الاخير</th>
                                            <th>بريد الالكتروني</th>
                                            <th>اسم ولي الامر</th>
                                            <th>رقم هاتف ولي الامر</th>
                                            <th>الجنس</th>
                                            <th>تاريخ الميلاد</th>
                                            <th>الصف</th>
                                            <th>الشعبة</th>
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

@endsection

@section('js')
    <script>
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('dash.student.getdata') }}",
                data: function(n) {
                    n.title = $('#search-student').val();
                    n.teacher_id = $('#search-section').val();
                    n.grade_id = $('#search-grade').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },

                {
                    data: 'first_name',
                    name: 'first_name',
                    title: 'الاسم الاول',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'last_name',
                    name: 'last_name',
                    title: 'الاسم الاخير',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'email',
                    name: 'email',
                    title: 'البريد الالكتروني',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'parent_name',
                    name: 'parent_name',
                    title: 'اسم ولي الامر',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'parent_phone',
                    name: 'parent_phone',
                    title: 'رقم هاتف ولي الامر',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'gender',
                    name: 'gender',
                    title: 'الجنس',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'date_of_birth',
                    name: 'date_of_birth',
                    title: 'تاريخ الميلاد',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'grade_id',
                    name: 'grade_id',
                    title: 'الصف الدراسي',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'section_id',
                    name: 'section_id',
                    title: 'الشعبة الدراسية',
                    orderable: true,
                    searchable: true,
                },

                {
                    data: 'action',
                    name: 'action',
                    title: 'العمليات',
                    orderable: false,
                    searchable: false,

                }
            ],

            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json'
            }
        });

        $('#search-btn').on('click', function(e) {
            e.preventDefault();
            table.draw();
        });


        $('#reset-btn').on('click', function(e) { //    اعملي search-btn لما نضغط على
            e.preventDefault();
            $('.search-input').val("").trigger('change');
            table.draw();
        });

        //     $('#search-title').val('');
        //     $('#search-book').val('');
        //     $('#search-teacher').val('');
        //     $('#search-grade').val('');

        //     table.draw();
        // });
        $(document).ready(function() {
            $(document).on('click', '.update_btn', function(e) {
                e.preventDefault();
                   var button = $(this);
                    $('#id').val(button.data('id'));
                    $('#first_name').val(button.data('first-name'));
                    $('#last_name').val(button.data('last-name'));
                    $('#email').val(button.data('email'));
                    $('#parent_name').val(button.data('parent-name'));
                    $('#parent_phone').val(button.data('parent-phone'));
                    $('#date_of_birth').val(button.data('date-of-birth'));
                    $('#grade_id').val(button.data('grade-id'));
                    $('#section_id').val(button.data('section-id'));
                    $('#gender').val(button.data('gender'));

            });

        });
        $('.btn-add').on('click', function() {
            $('input, select').removeClass('is-invalid');
            $('.invalid-feedback').text('');
        });

        //     $(document).on('click', '.update_btn', function(e) {
        //     e.preventDefault();
        //     var button = $(this);
        //     $('#id').val(button.data('id'));
        //     $('#title').val(button.data('title'));
        //     $('#book').val(button.data('book'));
        //     $('#teacher_id').val(button.data('teacher-id'));
        //     $('#grade_id').val(button.data('grade-id'));
        // });
    </script>
@stop
