<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use App\Models\Cliente;
use App\Models\Flota;
use App\Models\Movimiento;
use App\Models\TipoViaje;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $total_movimientos;
    protected $clientes_saldo = 0;
    protected $choferes_saldo = 0;

    public function __construct()
    {
        $this->middleware('auth');
        $this->total_movimientos = Movimiento::toBase()
            ->selectRaw("COUNT(CASE WHEN saldo_total != 0 THEN 1 END) AS con_saldo")
            ->selectRaw("COUNT(CASE WHEN saldo_total = 0 THEN 1 END) AS sin_saldo")
            ->first();
        $this->clientes_saldo = Cliente::where('saldo', '!=', 0)->count();
        $this->choferes_saldo = Chofer::where('saldo', '!=', 0)->count();
    }

    public function index()
    {
        $clientes = Cliente::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'total')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $choferes = Chofer::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'comision_chofer')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $flotas = Flota::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $tipos = TipoViaje::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $totales = [
            'saldo_cliente' => $clientes->sum('movimientos_sum_total'),
            'total_movimientos_cliente' => $clientes->sum('movimientos_count'),
            'saldo_chofer' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_comision' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_movimientos_chofer' => $choferes->sum('movimientos_count'),
            'total_movimientos_flota' => $flotas->sum('movimientos_count'),
            'total_movimientos_tipo' => $tipos->sum('movimientos_count'),
        ];
        return view('home', [
            'clientes' => $clientes,
            'choferes' => $choferes,
            'flotas' => $flotas,
            'tipos' => $tipos,
            'totales' => $totales,
            'total_movimientos' => $this->total_movimientos,
            'clientes_saldo' => $this->clientes_saldo,
            'choferes_saldo' => $this->choferes_saldo,
        ]);
    }

    public function searchCliente(Request $request)
    {
        $clientes = Cliente::withMostMovimientos(
            $request->input('desde'),
            $request->input('hasta')
        )
            ->withSum('movimientos', 'total')
            ->take(5)
            ->get();
        $choferes = Chofer::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'comision_chofer')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $flotas = Flota::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $tipos = TipoViaje::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $totales = [
            'saldo_cliente' => $clientes->sum('movimientos_sum_total'),
            'total_movimientos_cliente' => $clientes->sum('movimientos_count'),
            'saldo_chofer' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_comision' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_movimientos_chofer' => $choferes->sum('movimientos_count'),
            'total_movimientos_flota' => $flotas->sum('movimientos_count'),
            'total_movimientos_tipo' => $tipos->sum('movimientos_count'),
        ];
        return view('home', [
            'clientes' => $clientes,
            'choferes' => $choferes,
            'flotas' => $flotas,
            'tipos' => $tipos,
            'totales' => $totales,
            'total_movimientos' => $this->total_movimientos,
            'clientes_saldo' => $this->clientes_saldo,
            'choferes_saldo' => $this->choferes_saldo,
        ]);
    }

    public function searchChofer(Request $request)
    {
        $choferes = Chofer::withMostMovimientos(
            $request->input('desde'),
            $request->input('hasta')
        )
            ->withSum('movimientos', 'comision_chofer')
            ->take(5)
            ->get();
        $clientes = Cliente::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'total')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $flotas = Flota::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $tipos = TipoViaje::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $totales = [
            'saldo_cliente' => $clientes->sum('movimientos_sum_total'),
            'total_movimientos_cliente' => $clientes->sum('movimientos_count'),
            'total_movimientos_chofer' => $choferes->sum('movimientos_count'),
            'saldo_chofer' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_comision' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_movimientos_flota' => $flotas->sum('movimientos_count'),
            'total_movimientos_tipo' => $tipos->sum('movimientos_count'),
        ];
        return view('home', [
            'clientes' => $clientes,
            'choferes' => $choferes,
            'flotas' => $flotas,
            'tipos' => $tipos,
            'totales' => $totales,
            'total_movimientos' => $this->total_movimientos,
            'clientes_saldo' => $this->clientes_saldo,
            'choferes_saldo' => $this->choferes_saldo,
        ]);
    }

    public function searchFlota(Request $request)
    {
        $flotas = Flota::withMostMovimientos(
            $request->input('desde'),
            $request->input('hasta')
        )
            ->withSum('movimientos', 'total')
            ->take(5)
            ->get();

        $choferes = Chofer::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'comision_chofer')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $clientes = Cliente::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'total')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $tipos = TipoViaje::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $totales = [
            'saldo_cliente' => $clientes->sum('movimientos_sum_total'),
            'total_movimientos_cliente' => $clientes->sum('movimientos_count'),
            'saldo_chofer' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_comision' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_movimientos_chofer' => $choferes->sum('movimientos_count'),
            'total_movimientos' => $this->total_movimientos,
            'total_movimientos_flota' => $flotas->sum('movimientos_count'),
            'total_movimientos_tipo' => $tipos->sum('movimientos_count'),
        ];
        return view('home', [
            'clientes' => $clientes,
            'choferes' => $choferes,
            'flotas' => $flotas,
            'tipos' => $tipos,
            'totales' => $totales,
            'total_movimientos' => $this->total_movimientos,
            'clientes_saldo' => $this->clientes_saldo,
            'choferes_saldo' => $this->choferes_saldo,
        ]);
    }

    public function searchTipoViaje(Request $request)
    {
        $tipos = TipoViaje::withMostMovimientos(
            $request->input('desde'),
            $request->input('hasta')
        )
            ->withSum('movimientos', 'total')
            ->take(5)
            ->get();

        $clientes = Cliente::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'total')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $choferes = Chofer::query()
            ->withCount('movimientos')
            ->withSum('movimientos', 'comision_chofer')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();
        $flotas = Flota::query()
            ->withCount('movimientos')
            ->orderBy('movimientos_count', 'desc')
            ->take(5)
            ->get();

        $totales = [
            'saldo_cliente' => $clientes->sum('movimientos_sum_total'),
            'total_movimientos_cliente' => $clientes->sum('movimientos_count'),
            'saldo_chofer' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_comision' => $choferes->sum('movimientos_sum_comision_chofer'),
            'total_movimientos_chofer' => $choferes->sum('movimientos_count'),
            'total_movimientos_flota' => $flotas->sum('movimientos_count'),
            'total_movimientos_tipo' => $tipos->sum('movimientos_count'),
        ];
        return view('home', [
            'tipos' => $tipos,
            'clientes' => $clientes,
            'choferes' => $choferes,
            'flotas' => $flotas,
            'totales' => $totales,
            'total_movimientos' => $this->total_movimientos,
            'clientes_saldo' => $this->clientes_saldo,
            'choferes_saldo' => $this->choferes_saldo,
        ]);
    }
}
