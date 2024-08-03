<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormaPago\StoreRequest;
use App\Http\Requests\FormaPago\UpdateRequest;
use App\Models\FormasPagos;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    public function index()
    {
        return view('admin.formaPagos.index', [
            'formaPagos' => FormasPagos::paginate(8)
        ]);
    }

    public function create()
    {
        return view('admin.formaPagos.create', [
            'comprobante' => new FormasPagos()
        ]);
    }

    public function store(StoreRequest $request)
    {
        FormasPagos::create($request->validated());
        return redirect()->route('admin.forma-pagos.index')->with('flash', 'Forma de pago creado corretamente');
    }

    public function edit(FormasPagos $formaPago)
    {
        return view('admin.formaPagos.edit', [
            'comprobante' => $formaPago
        ]);
    }

    public function update(UpdateRequest $request, FormasPagos $formaPago)
    {
        $formaPago->update($request->validated());
        return redirect()->route('admin.forma-pagos.index')->with('flash', 'Forma de pago actualizado corretamente');
    }

    public function destroy(FormasPagos $formaPago)
    {
        $formaPago->delete();
        return redirect()->route('admin.forma-pagos.index')->with('flash', 'Forma de pago eliminado corretamente');
    }
}
