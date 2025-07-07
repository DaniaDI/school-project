@extends('dashboard.master')

@section('title')
        online school  | الصفحة الرئيسية للمحاضرات
@stop

@section('content')


    <main class="page-content">
        {{-- ---------------------------------------------model lect 14 add model----------------------------------------------- --}}
        <div class="modal fade" id="add-model" tabindex="-1" aria-labelledby="stagesModalLabel" aria-hidden="true">
            {{-- model يكون تابت add model --}}
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="stagesModalLabel"> اضافة كوز جديد</h5>
                        <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <form method="post" action="{{ route("dash.teacher.quizz.add") }}" id="add-form" class="add-form">

                        {{-- form يكون تابت add form --}}
                        <div class="modal-body">

                            <div class="container">
                                {{-- ------------lect 17 addmodel for section--------------- --}}


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    @csrf
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
                    <form method="post" action="{{ route('dash.teacher.lecture.update') }}" id="update-form" class="update-form">
                        {{-- form يكون تابت add form --}}
                        <div class="modal-body">

                            <div class="container">
                                {{-- ------------lect 17 addmodel for section--------------- --}}


                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">

                                @csrf


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

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                              <h5 class="mb-0">انشاء اختبار جديد </h5>
                            </div>

                    <div class="card-body">

                        <form action="{{ route('dash.teacher.quizz.add') }}" method="POST" id="quiz-form">
                            @csrf
                        <div class="mb-3">
                                <label class="form-label">عنوان الاختبار</label>
                                <input type="text" name="title" class="form-control "
                                    placeholder="عنوان الاختبار" required>
                            </div>
                            <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">مدة الاختبار(دقائق)</label>
                                <input type="number" name="time" class="form-control "
                                    placeholder="مدة الاختبار" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">تاريخ البدء</label>
                                <input type="datetime-local" name="start" class="form-control "
                                    placeholder="تاريخ البدء" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">تاريخ الانتهاء</label>
                                <input type="datetime-local" name="end" class="form-control "
                                    placeholder="تاريخ الانتهاء" required>
                            </div>

                        </div>
                        <hr>
                        <div id=questions-container></div>

                        <button  type="submit" class="btn btn-outline-primary col-12  mt-3 "  id="add-question-btn"> اضافة سؤال</button>

                    <hr>

                        <button type="submit"  class="btn btn-success col-12 ">حفظ الاختبار</button>

                    </form>
                </div>
                </div>
                </div>
            <!--*********************************************************************************-->




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
                url: "{{ route('dash.teacher.lecture.getdata') }}",
                data: function(n) { // متغير n : name نائب عن
                    //n.subject = $('#search-subject').val();
                    n.title = $('#search-title-lecture').val();
                    n.description = $('#search-description-lecture').val();
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
                var title = button.data('title');
                var description = button.data('description');
                var link = button.data('link');
                var status = button.data('status');

                /// inputs in form
                $('#id').val(id);
                $('#title').val(title);
                $('#description').val(description);
                $('#link').val(link);



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
