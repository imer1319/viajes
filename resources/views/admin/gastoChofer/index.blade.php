@extends('layouts.admin')

@section('title','Gastos chofer')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gastos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.gastos.index') }}">Listado</a></li>
                        <li class="breadcrumb-item active">Gastos de {{ $chofer->nombre }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3">
        <div class="card card-primary card-outline">
            <div class="mx-3 my-2 d-flex align-items-center justify-content-between">
                <h5>Listado de gastos del chofer: <b>{{ $chofer->nombre }}</b></h5>
            </div>
            <div class="card-body">
                @include('admin.gastoChofer.search')
                @include('admin.gastoChofer.table')
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
            window.location.href = "{{ route('admin.gastos.chofer.create', $chofer->id) }}";
        }

        function search() {
            var url = "{{ route('admin.gastos.chofer.search', $chofer->id) }}";
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
            window.location.href = "{{ route('admin.gastos.chofer.index', $chofer->id) }}";
        }
    </script>
@endsection
