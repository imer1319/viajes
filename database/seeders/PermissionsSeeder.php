<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    protected $permissions = [

        // Inventario

        'Depositos' => [
            [
                'name' => 'depositos.index',
                'description' => 'Consulta de Depositos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'depositos.create',
                'description' => 'Nuevo Deposito',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'depositos.edit',
                'description' => 'Modificar Deposito',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'depositos.destroy',
                'description' => 'Eliminar Deposito',
                'roles' => ['ADM'],
            ]
        ],

        'Marcas' => [
            [
                'name' => 'marcas.index',
                'description' => 'Consulta de Marcas',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'marcas.create',
                'description' => 'Nuevo Marca',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'marcas.edit',
                'description' => 'Modificar Marca',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'marcas.destroy',
                'description' => 'Eliminar Marca',
                'roles' => ['ADM'],
            ]
        ],

        'Centro de Costo' => [
            [
                'name' => 'centros.costos.index',
                'description' => 'Consulta de Centro de Costo',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'centros.costos.create',
                'description' => 'Nuevo Centro de Costo',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'centros.costos.edit',
                'description' => 'Modificar Centro de Costo',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'centros.costos.destroy',
                'description' => 'Eliminar Centro de Costo',
                'roles' => ['ADM'],
            ]
        ],

        'Ubicación' => [
            [
                'name' => 'ubicaciones.index',
                'description' => 'Consulta de Ubicación',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'ubicaciones.create',
                'description' => 'Nuevo Ubicación',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'ubicaciones.edit',
                'description' => 'Modificar Ubicación',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'ubicaciones.destroy',
                'description' => 'Eliminar Ubicación',
                'roles' => ['ADM'],
            ]
        ],


        'Rubros' => [
            [
                'name' => 'rubros.index',
                'description' => 'Consulta de Rubros',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'rubros.create',
                'description' => 'Nuevo Rubro',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'rubros.edit',
                'description' => 'Modificar Rubro',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'rubros.destroy',
                'description' => 'Eliminar Rubro',
                'roles' => ['ADM'],
            ]
        ],

        // Configuracion

        'Medidas' => [
            [
                'name' => 'medidas.index',
                'description' => 'Consulta de Medidas',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'medidas.create',
                'description' => 'Nuevo Medida',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'medidas.edit',
                'description' => 'Modificar Medida',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'medidas.destroy',
                'description' => 'Eliminar Medida',
                'roles' => ['ADM'],
            ]
        ],
        'Tipos Comprobantes' => [
            [
                'name' => 'tipos.comprobantes.index',
                'description' => 'Consulta de Tipos Comprobantes',
                'roles' => ['ADM'],
            ]
        ],

        'Planes Cuentas' => [
            [
                'name' => 'planes.cuentas.index',
                'description' => 'Consulta de Planes Cuentas',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'planes.cuentas.create',
                'description' => 'Nuevo Plan Cuenta',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'planes.cuentas.edit',
                'description' => 'Modificar Plan Cuenta',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'planes.cuentas.destroy',
                'description' => 'Eliminar Plan Cuenta',
                'roles' => ['ADM'],
            ]
        ],

        'Formas Pagos' => [
            [
                'name' => 'formas.pagos.index',
                'description' => 'Consulta de Formas Pagos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'formas.pagos.create',
                'description' => 'Nuevo Formas Pagos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'formas.pagos.edit',
                'description' => 'Modificar Formas Pagos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'formas.pagos.destroy',
                'description' => 'Eliminar Formas Pagos',
                'roles' => ['ADM'],
            ]
        ],

        'Proveedores' => [
            [
                'name' => 'proveedores.index',
                'description' => 'Consulta de Proveedores',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'proveedores.create',
                'description' => 'Nuevo Proveedor',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'proveedores.show',
                'description' => 'Ver Proveedor',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'proveedores.edit',
                'description' => 'Modificar Proveedores',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'proveedores.destroy',
                'description' => 'Eliminar Proveedores',
                'roles' => ['ADM'],
            ]
        ],

        'Remitos' => [
            [
                'name' => 'remitos.index',
                'description' => 'Consulta de Remitos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'remitos.create',
                'description' => 'Nuevo Remito',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'remitos.show',
                'description' => 'Ver Remito',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'remitos.edit',
                'description' => 'Modificar Remitos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'remitos.destroy',
                'description' => 'Eliminar Remito',
                'roles' => ['ADM'],
            ]
        ],

        'Orden Compra' => [
            [
                'name' => 'orden.compras.index',
                'description' => 'Consulta de Orden de Compras',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'orden.compras.create',
                'description' => 'Nuevo Orden de Compra',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'orden.compras.show',
                'description' => 'Ver Orden de Compra',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'orden.compras.edit',
                'description' => 'Modificar Orden de Compras',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'orden.compras.destroy',
                'description' => 'Eliminar Orden de Compras',
                'roles' => ['ADM'],
            ]
        ],

        'Condiciones Pago' => [
            [
                'name' => 'condiciones.pagos.index',
                'description' => 'Consulta de Condiciones Pago',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'condiciones.pagos.create',
                'description' => 'Nuevo Condiciones Pago',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'condiciones.pagos.edit',
                'description' => 'Modificar Condiciones Pago',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'condiciones.pagos.destroy',
                'description' => 'Eliminar Condiciones Pago',
                'roles' => ['ADM'],
            ]
        ],

        'Retencion Ingresos Bruto' => [
            [
                'name' => 'retencion.ingresos.bruto.index',
                'description' => 'Consulta de Retencion Ingresos Bruto',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'retencion.ingresos.bruto.create',
                'description' => 'Nuevo Retencion Ingresos Bruto',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'retencion.ingresos.bruto.edit',
                'description' => 'Modificar Retencion Ingresos Bruto',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'retencion.ingresos.bruto.destroy',
                'description' => 'Eliminar Retencion Ingresos Bruto',
                'roles' => ['ADM'],
            ]
        ],
        
        'Retenciones Ganancias' => [
            [
                'name' => 'retenciones.ganancias.index',
                'description' => 'Consulta de Retenciones Ganancias',
                'roles' => ['ADM'],
            ]
        ],

        'Condiciones Ivas' => [
            [
                'name' => 'condiciones.ivas.index',
                'description' => 'Consulta de Condiciones Ivas',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'condiciones.ivas.create',
                'description' => 'Nueva Condicion Iva',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'condiciones.ivas.edit',
                'description' => 'Modificar Condicion Iva',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'condiciones.ivas.destroy',
                'description' => 'Eliminar Condicion Iva',
                'roles' => ['ADM'],
            ]
        ],

        // Productos
        
        'productos' => [
            [
                'name' => 'productos.index',
                'description' => 'Consulta de Productos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'productos.create',
                'description' => 'Crear Producto',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'productos.show', 
                'description' => 'Ver Producto',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'productos.edit',
                'description' => 'Modificar Producto',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'productos.destroy',
                'description' => 'ELiminar Producto',
                'roles' => ['ADM'],
            ],
        ],
        // Clientes
        'clientes' => [
            [
                'name' => 'clientes.index',
                'description' => 'Consulta de Clientes',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.create',
                'description' => 'Consulta de Clientes',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.show',
                'description' => 'Ver Cliente',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.edit',
                'description' => 'Modificar Cliente',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'clientes.destroy',
                'description' => 'Eliminar Cliente',
                'roles' => ['ADM'],
            ]
        ],
        // Usuarios
        'users' => [
            [
                'name' => 'users.index',
                'description' => 'Consulta de usuarios',
                'roles' => ['ADM']
            ],
            [
                'name' => 'users.create',
                'description' => 'Crear usuario',
                'roles' => ['ADM']
            ],
            [
                'name' => 'users.edit',
                'description' => 'Modificar usuario',
                'roles' => ['ADM']
            ],
        ],
        // Roles
        'roles' => [
            [
                'name' => 'roles.index',
                'description' => 'Consulta de roles',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.create',
                'description' => 'Crear rol',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.edit',
                'description' => 'Modificar rol',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.destroy',
                'description' => 'Eliminar rol',
                'roles' => ['ADM'],
            ],
        ],
        // Permisos
        'permissions' => [
            [
                'name' => 'roles.permissions.index',
                'description' => 'Consulta de permisos',
                'roles' => ['ADM'],
            ],
            [
                'name' => 'roles.permissions.edit',
                'description' => 'Modificar permiso',
                'roles' => ['ADM'],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->permissions)->each(function ($abilities, $group) {
            foreach ($abilities as $ability) {
                $permission = Permission::forceCreate(
                    Arr::except($ability, ['roles'])
                );

                foreach ($ability['roles'] as $rol) {
                    Role::findByName($rol)->givePermissionTo($permission);
                }
            }
        });
    }
}
