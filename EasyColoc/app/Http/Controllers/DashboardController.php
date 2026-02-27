<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colocation;
class DashboardController extends Controller
{
    public function show(Colocation $colocation)
    {
        $allColocs = auth()->user()->colocations;

        $expenses = $colocation->expenses()->with('payer')->latest()->take(5)->get();

        return view('colDashboard', compact('colocation', 'allColocs', 'expenses'));
    }
}

