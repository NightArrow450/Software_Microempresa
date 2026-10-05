<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $usuariosActivos = User::where('status', true)->count();

        $administradores = User::where('status', true)
            ->whereHas('role', function ($query) {
                $query->where('name', 'Administrador');
            })
            ->count();

        $ventas = User::where('status', true)
            ->whereHas('role', function ($query) {
                $query->where('name', 'Ventas');
            })
            ->count();

        $produccionReparto = User::where('status', true)
            ->whereHas('role', function ($query) {
                $query->where('name', 'Producción/Reparto');
            })
            ->count();

        return view('dashboard.index', compact(
            'usuariosActivos',
            'administradores',
            'ventas',
            'produccionReparto'
        ));
    }
}