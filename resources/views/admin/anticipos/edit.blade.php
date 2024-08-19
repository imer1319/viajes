@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Anticipos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.anticipos.index') }}">Listado de anticipos</a></li>
                        <li class="breadcrumb-item active">Editar anticipo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-3">

        <div class="card card-primary card-outline ñpt-4">
            <div class="card-header">Editar anticipo</div>

            <div class="card-body">
                <anticipo-edit :anticipo="{{ $anticipo }}" redirect="true"></anticipo-edit>
            </div>
        </div>

    </section>
@endsection
