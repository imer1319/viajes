@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gastos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.gastos.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Listado</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="mx-3 my-2 d-flex align-items-center justify-content-between">
                    <h5>Listado de gastos</h5>
            </div>
            <div class="card-body">
                @include('admin.gastos.search')
                @include('admin.gastos.table')
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
        function create() {
            $(".btn").hide();
            $(".btn-importar").hide();
            $(".spinner-btn").show();
            window.location.href = "{{ route('admin.gastos.create') }}";
        }

        function search() {
            var url = "{{ route('admin.gastos.search') }}";
            $("#form").attr('action', url);
            $(".btn").hide();
            $(".btn-importar").hide();
            $(".spinner-btn").show();
            $("#form").submit();
        }

        function limpiar() {
            $(".btn").hide();
            $(".btn-importar").hide();
            $(".spinner-btn").show();
            window.location.href = "{{ route('admin.gastos.index') }}";
        }
    </script>
@endsection
