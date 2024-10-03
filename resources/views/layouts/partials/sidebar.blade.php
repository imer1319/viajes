<aside class="main-sidebar elevation-4 sidebar-light-primary">
    <a href="../../index3.html" class="brand-link">
        <img src="{{ asset('img/icono.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <div class="sidebar os-theme-dark">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
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
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent nav-collapse-hide-child  sidebar-mini-xs"
                data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ setActiveRoute([
                            'home',
                        ]) }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ menuOpen([
                        'admin.retencion-ingresos-bruto.*',
                        'admin.retencion-ganancias.*',
                        'admin.tipo-comprobantes.*',
                        'admin.forma-pagos.*',
                        'admin.condicion-pagos.*',
                        'admin.condiciones-iva.*',
                        'admin.medidas.*',
                        'admin.bancos.*',
                        'admin.tipos-gasto.*',
                        'admin.tipo-viajes.*',
                    ]) }}">
                    <a href="#"
                        class="nav-link {{ setActiveRoute([
                            'admin.retencion-ingresos-bruto.*',
                            'admin.retencion-ganancias.*',
                            'admin.tipo-comprobantes.*',
                            'admin.forma-pagos.*',
                            'admin.condicion-pagos.*',
                            'admin.condiciones-iva.*',
                            'admin.medidas.*',
                            'admin.bancos.*',
                            'admin.tipos-gasto.*',
                            'admin.tipo-viajes.*',
                        ]) }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Configuracion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.retencion-ingresos-bruto.index') }}"
                                class="nav-link {{ setActiveRoute('admin.retencion-ingresos-bruto.*') }}">
                                <i class="fa fa-keyboard nav-icon"></i>
                                <p>Retenciones Ingresos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.retencion-ganancias.index') }}"
                                class="nav-link {{ setActiveRoute('admin.retencion-ganancias.*') }}">
                                <i class="fas fa-chart-area nav-icon"></i>
                                <p>Retenciones Ganancias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tipo-comprobantes.index') }}"
                                class="nav-link {{ setActiveRoute('admin.tipo-comprobantes.index') }}">
                                <i class="fa fa-file nav-icon"></i>
                                <p>Tipo Comprobante</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.forma-pagos.index') }}"
                                class="nav-link {{ setActiveRoute('admin.forma-pagos.*') }}">
                                <i class="fa fa-money-check nav-icon"></i>
                                <p>Formas Pagos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.condicion-pagos.index') }}"
                                class="nav-link {{ setActiveRoute('admin.condicion-pagos.*') }}">
                                <i class="fa fa-cash-register nav-icon"></i>
                                <p>Condiciones Pagos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.condiciones-iva.index') }}"
                                class="nav-link {{ setActiveRoute('admin.condiciones-iva.*') }}">
                                <i class="fas fa-comments-dollar nav-icon"></i>
                                <p>Condiciones Iva</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.medidas.index') }}"
                                class="nav-link {{ setActiveRoute('admin.medidas.*') }}">
                                <i class="fas fa-ruler-combined nav-icon"></i>
                                <p>Medidas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.bancos.index') }}"
                                class="nav-link {{ setActiveRoute('admin.bancos.*') }}">
                                <i class="fas fa-university nav-icon"></i>
                                <p>Bancos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tipos-gasto.index') }}"
                                class="nav-link {{ setActiveRoute('admin.tipos-gasto.*') }}">
                                <i class="fa fa-money-bill-wave nav-icon"></i>
                                <p>Tipos de gasto</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tipo-viajes.index') }}"
                                class="nav-link {{ setActiveRoute('admin.tipo-viajes.*') }}">
                                <i class="fa fa-suitcase nav-icon"></i>
                                <p>Tipos de viaje</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ menuOpen(['admin.users.*', 'admin.proveedores.*']) }}">
                    <a href="#" class="nav-link {{ setActiveRoute(['admin.users.*', 'admin.proveedores.*']) }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Administracion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="nav-link {{ setActiveRoute('admin.users.*') }}">
                                <i class="fa fa-user nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.proveedores.index') }}"
                                class="nav-link {{ setActiveRoute('admin.proveedores.*') }}">
                                <i class="fas fa-user-friends nav-icon"></i>
                                <p>Proveedores</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item {{ menuOpen([
                        'admin.movimientos.*',
                        'admin.flotas.*',
                        'admin.choferes.*',
                        'admin.anticipos.*',
                        'admin.gastos.*',
                        'admin.clientes.*',
                        'admin.liquidaciones.*',
                        'admin.recibos.*',
                        'admin.facturaciones.*',
                    ]) }}">
                    <a href="#"
                        class="nav-link {{ setActiveRoute([
                            'admin.movimientos.*',
                            'admin.flotas.*',
                            'admin.choferes.*',
                            'admin.anticipos.*',
                            'admin.gastos.*',
                            'admin.clientes.*',
                            'admin.liquidaciones.*',
                            'admin.recibos.*',
                            'admin.facturaciones.*',
                        ]) }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Acciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.movimientos.index') }}"
                                class="nav-link {{ setActiveRoute('admin.movimientos.*') }}">
                                <i class="fas fa-truck nav-icon"></i>
                                <p>Movimientos - Viajes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.flotas.index') }}"
                                class="nav-link {{ setActiveRoute('admin.flotas.*') }}">
                                <i class="fa fa-bus nav-icon"></i>
                                <p>Flotas</p>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ menuOpen(['admin.choferes.*', 'admin.anticipos.*', 'admin.gastos.*', 'admin.liquidaciones.*']) }}">
                            <a href="#"
                                class="nav-link {{ setActiveRoute(['admin.choferes.*', 'admin.anticipos.*', 'admin.gastos.*', 'admin.liquidaciones.*']) }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Choferes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.choferes.index') }}"
                                        class="nav-link {{ setActiveRoute('admin.choferes.*') }}">
                                        <i class="fa fa-user nav-icon"></i>
                                        <p>Listado de choferes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.anticipos.index') }}"
                                        class="nav-link {{ setActiveRoute('admin.anticipos.*') }}">
                                        <i class="fas fa-money-bill-wave-alt nav-icon"></i>
                                        <p>Agregar anticipo</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.gastos.index') }}"
                                        class="nav-link {{ setActiveRoute('admin.gastos.*') }}">
                                        <i class="fas fa-money-bill-wave-alt nav-icon"></i>
                                        <p>Agregar gasto</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.liquidaciones.index') }}"
                                        class="nav-link {{ setActiveRoute('admin.liquidaciones.*') }}">
                                        <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                        <p>Liquidaciones</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item {{ menuOpen(['admin.clientes.*', 'admin.recibos.*', 'admin.facturaciones.*']) }}">
                            <a href="#"
                                class="nav-link  {{ setActiveRoute(['admin.clientes.*', 'admin.recibos.*', 'admin.facturaciones.*']) }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Clientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.clientes.index') }}"
                                        class="nav-link {{ setActiveRoute('admin.clientes.*') }}">
                                        <i class="fa fa-user nav-icon"></i>
                                        <p>Listado de clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.facturaciones.index') }}"
                                        class="nav-link {{ setActiveRoute('admin.facturaciones.*') }}">
                                        <i class="fas fa-file-invoice nav-icon"></i>
                                        <p>Facturacion</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.recibos.index') }}"
                                        class="nav-link {{ setActiveRoute('admin.recibos.*') }}">
                                        <i class="fas fa-money-bill-wave-alt nav-icon"></i>
                                        <p>Cobro / Recibos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
