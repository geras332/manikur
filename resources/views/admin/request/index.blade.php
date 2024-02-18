@extends('admin.layouts.default')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Услуги</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.service.create') }}" class="btn btn-primary">Добавить услугу</a>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Номер</th>
                                    <th>Услуга</th>
                                    <th>Дата</th>
                                    <th>Время</th>
                                    <th>Создан в</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('scripts')

    <script>

        let columns = [
            {"data": "id", "name": "id"},
            {"data": "name", "name": "name"},
            {"data": "phone_number", "name": "phone_number"},
            {"data": "service.title", "name": "service.title"},
            {"data": "date", "name": "date"},
            {"data": "time", "name": "time"},
            {"data": "created_at", "name": "created_at"},
            {"data": "actions", "name": "actions", orderable: false, searchable: false},
        ];

        $(function () {
            $('#datatable').DataTable({
                "paging": true,
                "pageLength": 25,
                "processing": true,
                "serverSide": true,
                "columns": columns,
                "ajax": {
                    "url": "{{ route('admin.request.data') }}",
                    "dataSrc": "data",
                },
            });
        });

    </script>

@endpush
