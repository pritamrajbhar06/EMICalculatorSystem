<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function calculate(Request $request)
     {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'tenure_id' => 'required|exists:tenures,id'
        ]);

        $amount = $request->amount;
        $tenure_id = $request->tenure_id;

        $rule = EmiRule::where('min_amount', '<=', $amount)
                        ->where('max_amount', '>=', $amount)
                        ->where('tenure_id', $tenure_id)
                        ->first();

        if (!$rule) return back()->withErrors(['No EMI Rule found for this selection.']);

        $rate = $rule->interest_rate;
        $months = $rule->tenure->months;
        $monthly_interest = ($amount * $rate / 100) / 12;
        $emi = ($amount / $months) + $monthly_interest;
        $total_payment = $emi * $months;

        return view('calculator_result', compact('amount', 'months', 'emi', 'total_payment', 'rate'));
    }

    
}
