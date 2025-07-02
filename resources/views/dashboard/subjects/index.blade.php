@extends('dashboard.master')

@section('title')
   مدرسة ليرن | صفحة المواد
@stop

@section('content')
<main class="page-content">

    <!-- Add Subject Modal -->
    <div class="modal fade" id="add-model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة مادة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <form method="post" action="{{ route('dash.subject.add') }}" id="add-form" enctype="multipart/form-data">

                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 form-group">
                            <label>عنوان المادة</label>
                            <input name="title" class="form-control" placeholder="عنوان المادة">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>كتاب المادة</label>
                            <input name="book" type="file" class="form-control" placeholder="اسم الكتاب">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>معلم المادة</label>
                            <select name="teacher_id" class="form-control">
                                <option selected disabled>اختر المعلم</option>
                                @foreach($teachers as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>الصف الدراسي</label>
                            <select name="grade_id" class="form-control">
                                <option selected disabled>اختر الصف</option>
                                @foreach($grades as $g)
                                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success col-12" type="submit">إضافة</button>
                        <button type="button" class="btn btn-outline-secondary col-12" data-bs-dismiss="modal">إغلاق</button>
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
                    <h5 class="modal-title">تعديل المادة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <form method="post" action="{{ route('dash.subject.update') }}" id="update-form"  enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="mb-3 form-group">
                            <label>عنوان المادة</label>
                            <input name="title" id="title" class="form-control" placeholder="عنوان المادة">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>كتاب المادة</label>
                            <input name="book"  type ="file" id="book" class="form-control" placeholder="اسم الكتاب">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>معلم المادة</label>
                            <select name="teacher_id" id="teacher_id" class="form-control">
                                <option selected disabled>اختر المعلم</option>
                                @foreach($teachers as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>الصف الدراسي</label>
                            <select name="grade_id" id="grade_id" class="form-control">
                                <option selected disabled>اختر الصف</option>
                                @foreach($grades as $g)
                                    <option value="{{$g->id }}">{{ $g->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-info col-12" type="submit">تعديل</button>
                        <button type="button" class="btn btn-outline-secondary col-12" data-bs-dismiss="modal">إغلاق</button>
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
            <input type="text" id="search-title" class="form-control  search-input" placeholder="بحث عن عنوان المادة">
        </div>
        <div class="col-md-4 mb-3">
            <input type="text" id="search-book" class="form-control search-input" placeholder="بحث عن كتاب المادة">
        </div>
        <div class="col-md-4 mb-3">
            <select id="search-teacher" class="form-control search-input">
                <option value="">اختر المعلم</option>
                @foreach($teachers as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <select id="search-grade" class="form-control search-input">
                <option value="">اختر الصف</option>
                @foreach($grades as $g)
                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mb-3">
        <button id="search-btn" class="btn btn-outline-success col-6">بحث</button>
        <button id="reset-btn" class="btn btn-outline-secondary col-6">تنظيف</button>
    </div>

    <button class="btn btn-outline-primary col-12  btn-add" data-bs-toggle="modal" data-bs-target="#add-model">
        إضافة مادة جديدة
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
                            <h5 class="mb-0">جميع المواد</h5>
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
                                <th>عنوان المادة</th>
                                <th>كتاب المادة</th>
                                <th>معلم المادة</th>
                                <th>الصف الدراسي</th>
                                <th>محاضرات المادة   </th>
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
            اضافة مادة دراسية
        </button>

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
            url: "{{ route('dash.subject.getdata') }}",
            data: function(d) {
                d.title = $('#search-title').val();
                d.book = $('#search-book').val();
                d.teacher_id = $('#search-teacher').val();
                d.grade_id = $('#search-grade').val();
            }
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
            },

            {
                 data: 'title',
                  name: 'title',
                  title: 'عنوان المادة',
                  orderable: true,
                  searchable: true,
            },

            {
                data: 'book',
                 name: 'book',
                 title: 'كتاب المادة',
                 orderable: true,
                searchable: true,
           },

            {
                data: 'teacher_name',
                 name: 'teacher.name',
                 title: 'معلم المادة',
                 orderable: true,
                searchable: true,
           },

            {
                 data: 'grade_name',
                  name: 'grade.name',
                  title: 'الصف الدراسي',
                  orderable: true,
                  searchable: true,
           },
           {
                 data: 'lectures',
                  name: 'lectures',
                  title: 'محاضرات المادة',
                  orderable: false,
                  searchable: false,
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


        $('#reset-btn').on('click',function(e){//    اعملي search-btn لما نضغط على
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
        $('#title').val(button.data('title'));
        $('#book').val(button.data('book'));
        $('#teacher_id').val(button.data('teacher-id'));
        $('#grade_id').val(button.data('grade-id'));
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
