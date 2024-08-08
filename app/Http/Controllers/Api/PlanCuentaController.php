<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlanCuenta;
use Illuminate\Http\Request;

class PlanCuentaController extends Controller
{
    public function index()
    {
        return PlanCuenta::all();
    }
}
