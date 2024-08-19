<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\CentroCosto;
use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\CondicionesPago;
use App\Models\CondicionIva;
use App\Models\Departamento;
use App\Models\Deposito;
use App\Models\Flota;
use App\Models\FormasPagos;
use App\Models\Localidad;
use App\Models\Marca;
use App\Models\Medida;
use App\Models\OrdenCompra;
use App\Models\PlanCuenta;
use App\Models\Proveedor;
use App\Models\Provincia;
use App\Models\RetencionGanancia;
use App\Models\RetencionIngresosBruto;
use App\Models\Rubro;
use App\Models\TipoComprobante;
use App\Models\TipoDocumento;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        Permission::truncate();
        User::truncate();
        Provincia::truncate();
        Departamento::truncate();
        Localidad::truncate();
        TipoDocumento::truncate();
        Cliente::truncate();
        Categoria::truncate();
        TipoComprobante::truncate();
        CondicionIva::truncate();
        RetencionIngresosBruto::truncate();
        PlanCuenta::truncate();
        FormasPagos::truncate();
        RetencionIngresosBruto::truncate();
        CondicionesPago::truncate();
        RetencionGanancia::truncate();
        Medida::truncate();
        Marca::truncate();
        Deposito::truncate();
        Rubro::truncate();
        Proveedor::truncate();
        Cliente::truncate();
        Chofer::truncate();
        Flota::truncate();
        OrdenCompra::truncate();
        Ubicacion::truncate();
        CentroCosto::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            RolesSeeder::class,
            PermissionsSeeder::class,
            UsersSeeder::class,
            ProvinciaSeeder::class,
            DepartamentoSeeder::class,
            LocalidadSeeder::class,
            TipoDocumentoSeeder::class,
            CategoriaSeeder::class,
            TipoComprobanteSeeder::class,
            CondicionIvaSeeder::class,
            RetencionIngresosBrutoSeeder::class,
            PlanCuentaSeeder::class,
            FormasPagosSeeder::class,
            RetencionIngresosBrutoSeeder::class,
            CondicionesPagoSeeder::class,
            RetencionGananciaSeeder::class,
            MedidaSeeder::class,
            MarcaSeeder::class,
            DepositoSeeder::class,
            RubroSeeder::class,
            ProveedorSeeder::class,
            ClienteSeeder::class,
            ChoferSeedeer::class,
            ProductoSeeder::class,
            OrdenCompraSeeder::class,
            UbicacionSeeder::class,
            CentroCostoSeeder::class,
            FlotaSeedeer::class,
        ]);
    }
}
