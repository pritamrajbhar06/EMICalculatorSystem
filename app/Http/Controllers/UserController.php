<?php

namespace App\Http\Controllers;

use App\Models\EmiRule;
use App\Services\EmiRuleService;
use App\Services\TenureService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $tenureService;
    protected $emiRuleService;
    public function __construct(TenureService $tenureService, EmiRuleService $emiRuleService)
    {
        $this->tenureService = $tenureService;
        $this->emiRuleService = $emiRuleService;
    }

    public function dashboard()
    {
        return view('user.dashboard')->with([
            'tenures' => $this->tenureService->getAllTenures(),
        ]);
    }

    public function calculate(Request $request)
     {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'tenure_id' => 'required|exists:tenures,id'
        ]);

        $amount = $request->amount;
        $tenure_id = $request->tenure_id;

        $emiRule = $this->emiRuleService->checkEmiRuleExists($amount, $amount, $tenure_id);

        if (!$emiRule) {
            return redirect()->route('user.dashboard')->with('emi_error', 'No EMI Rule found for this selection.');
        }


        $ratePerMonth = ($emiRule->interest_rate / 100) / 12;
        $months = $emiRule->tenure->months;

        $emi = ($amount * $ratePerMonth * pow(1 + $ratePerMonth, $months)) / (pow(1 + $ratePerMonth, $months) - 1);
        $totalAmount = $emi * $months;

        return back()->with([
            'emi' => number_format($emi, 2),
            'total' => number_format($totalAmount, 2),
        ]);

    }

    
}
