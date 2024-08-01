@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Movimientos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content mx-3">
        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Crear movimiento</div>
            <div class="card-body">
                <movimiento-create />
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('.select2').select2()
    </script>
@endsection
