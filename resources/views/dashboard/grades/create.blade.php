@extends('dashboard.master')

@section('title')
    learn school | الصفحة الرئيسية للمستويات
@stop

@section('content')
    <main class="page-content">
        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent">
                        <div class="row g-3 align-items-center">
                            <div class="col">
                                <h5 class="mb-0">Recent Orders</h5>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
                                <div class="d-flex align-items-center">
                                    <div class="fs-3 text-danger"><i class="bi bi-x-circle-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <ul>
                                            @foreach ($errors->all() as $e)
                                                <li>{{ $e }}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                        @endif

                        <form id="formcreate" method="POST" action="{{ route('dash.grade.add') }}">
                            @csrf
                            <label class="mb-3">اسم المستوى </label>
                            <input id="name" name="stage" class="form-control mb-3" type="text"
                                placeholder=" اسم المستوى ">
                            <label class="mb-3"> المرحلة </label>
                           <select  id="stage"   class="form-control mb-3">
                                <option selected disabled>اختر المرحلة</option>
                                @foreach ($stages as $stage)
                                    <option value="{{ $stage->id }}"> {{ $stage->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success col-12">اضافة</button>
                        </form>
                    </div>
                </div>
            </div>



        @stop

        @section('js')

            <script>
                $('#formcreate').submit(function(e) {
                            // alert('ff');
                            e.preventDefault(); // stop html
                            var name = $('#name').val(); // هات من input اسم id تعته name value تعته
                            var stage = $('#stage').val();
                            //  alert(name);

                            $.ajax({
                                    url: "{{ route('dash.grade.add') }}",
                                    type: 'post',//type :method
                                    data: {//data for transfer
                                        "name": name,
                                        "_token":"{{csrf_token()}}",
                                        "stage": stage,
                                    },
                                    success: function(res) {//res:response لما يتنجح بدي افضي الفورم
                                     alert(res);
                                     $('#formcreate').trigger('reset');
                                    },
                                    error: function(e) {//e:error
                                            console.log(e);
                                        }
                                    })
                            })
            </script>

        @stop
