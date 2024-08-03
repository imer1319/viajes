<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../../index3.html" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Configuracion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.retencion-ingresos-bruto.index') }}" class="nav-link">
                                <i class="fa fa-keyboard nav-icon"></i>
                                <p>Retenciones Ingresos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.retencion-ganancias.index') }}" class="nav-link">
                                <i class="fas fa-chart-area nav-icon"></i>
                                <p>Retenciones Ganancias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tipo-comprobantes.index') }}" class="nav-link">
                                <i class="fa fa-file nav-icon"></i>
                                <p>Tipo Comprobante</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.forma-pagos.index') }}" class="nav-link">
                                <i class="fa fa-money-check nav-icon"></i>
                                <p>Formas Pagos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.condicion-pagos.index') }}" class="nav-link">
                                <i class="fa fa-cash-register nav-icon"></i>
                                <p>Condiciones Pagos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.condicion-iva.index') }}" class="nav-link">
                                <i class="fas fa-comments-dollar nav-icon"></i>
                                <p>Condiciones Iva</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.medidas.index') }}" class="nav-link">
                                <i class="fas fa-ruler-combined nav-icon"></i>
                                <p>Medidas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Administracion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.clientes.index') }}" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.proveedores.index') }}" class="nav-link">
                                <i class="fas fa-user-friends nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Acciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.movimientos.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Movimientos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Flota</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pago cliente</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="../widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
