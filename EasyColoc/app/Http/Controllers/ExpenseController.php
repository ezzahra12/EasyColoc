<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Colocation;
use App\Models\Settlement;
use App\Models\Expense;
use Illuminate\Http\Request;


class ExpenseController extends Controller
{
     public function store(ExpenseRequest $request, Colocation $colocation)
    {
        $payer = auth()->user();

        $expense = $colocation->expenses()->create([
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'category_id' => $request->category_id,
            'payer_id' => $payer->id,
        ]);

        $users = $colocation->users;

        $splitAmount = $expense->amount / $users->count();
         foreach ($users as $user) {
        Settlement::create([
            'amount' => $splitAmount,
            'creditor_id' => $expense->payer_id,
            'debtor_id' => $user->id,
            'colocation_id' => $colocation->id,
            'is_paid' => $user->id === $expense->payer_id ? true : false,
        ]);
    }

        return redirect()->back()->with('success', 'Expense added and split successfully!');
    }
}
