@extends('dashboard.master')

@section('title')
    مدرسة ليرن | الصفحة الرئيسية للمحاضرات
@stop

@section('content')


    <main class="page-content">


        <!--****************************************lect 21 subjects filter*****************************************-->
        {{-- <div class="row">
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
                    <input type="text" id="search-title" class="form-control" placeholder="عنوان المحاضرة">

                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" id="search-description" class="form-control" placeholder="وصف المحاضرة">

                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" id="search-subject" class="form-control" placeholder="اسم المادة">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" id="search-teacher" class="form-control" placeholder="اسم المعلم">
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mb-3">
                <button type="submit" id="search-btn" class="btn btn-outline-success col-6">بحث</button>
                <button type="reset"id="reset-btn" class="btn btn-outline-secondary col-6 ">تنظيف</button>

            </div>
            <button class="btn btn-outline-primary col-12 btn-add" data-bs-toggle="modal" data-bs-target="#add-model">
                اضافة محاضرة
            </button>

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
                  {{-- ما بيلزم اسم المعلم لانه  واحد--}}

                </div>
                        <div class="d-flex justify-content-end gap-2 mb-3">
                            <button type="submit" id="search-btn" class="btn btn-outline-success col-6">بحث</button>
                            <button type="reset"id="reset-btn" class="btn btn-outline-secondary col-6 ">تنظيف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        {{--
        <div class="card-body">
            <div class="row mb-3">

                <div class="col-md-4 mb-3">
                    <input type="text" id="search-title" class="form-control" placeholder="عنوان المحاضرة">

                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" id="search-description" class="form-control" placeholder="وصف المحاضرة">

                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" id="search-subject" class="form-control" placeholder="اسم المادة">
                </div>
                <div class="col-md-4 mb-3">
                    <input type="text" id="search-teacher" class="form-control" placeholder="اسم المعلم">
                </div>
            </div>
            <div class="d-flex justify-content-end gap-2 mb-3">
                <button type="submit" id="search-btn" class="btn btn-outline-success col-6">بحث</button>
                <button type="reset"id="reset-btn" class="btn btn-outline-secondary col-6 ">تنظيف</button>

            </div>
            <button class="btn btn-outline-primary col-12 btn-add" data-bs-toggle="modal" data-bs-target="#add-model">
                اضافة محاضرة
            </button> --}}


        <!--*********************************************************************************-->

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h5 class="mb-0"> جميع محاضرات مادة"{{ $subject->title }}" للمعلم "{{$subject->teacher->name}}"</h5>
                                {{-- [جميه محاضرات مادة " اسم المادة" --}}
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
                                        <th> الوصف</th>
                                        <th>رابط المحاضرة</th>
                                        <th>اسم المعلم</th>

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
                url: "{{ route('dash.subject.getdata.lectures') }}",
                data: function(n) { // متغير n : name نائب عن
                    n.id = {{ $subject->id }};
                    n.title = $('#search-title-lecture').val();

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


        $('#reset-btn').on('click', function(e) { //    اعملي search-btn لما نضغط على
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
                var title = button.data('title');
                var description = button.data('description');
                var subject_id = button.data('subject_id');
                var teacher_id = button.data('teacher_id');
                var link = button.data('link');
                var status = button.data('status');

                /// inputs in form
                $('#id').val(id);
                $('#title').val(title);
                $('#description').val(description);
                $('#subject_id').val(subject_id);
                $('#teacher_id').val(teacher_id);
                $('#link').val(link);
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
                swal({ //sweetalert
                    title: "هل انت متاكد من العملية ",
                    text: " سيتم  تفعيل العنصر المعطل ",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "الغاء",
                            value: null,
                            visible: true,
                            className: "custom-cancel-btn",
                            closeModel: true,
                        },
                        confirm: {
                            text: "احذف",
                            value: true,
                            visible: true,
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
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                //   toastr.success(res.success)
                                table.draw();

                            },

                        });
                    } else { // لو ما ضغط على زر الموافق
                        toastr.error('تم الغاء عملية التفعيل')
                    }
                });
            });
        });
    </script>
@stop
