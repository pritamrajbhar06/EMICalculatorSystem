<?php

namespace App\Http\Controllers;

use App\Models\EmiRule;
use App\Models\Tenure;
use App\Services\EmiRuleService;
use App\Services\TenureService;
use Illuminate\Http\Request;

class EmiRuleController extends Controller
{
    protected $emiRuleService;
    protected $tenureService;
    public function __construct(EmiRuleService $emiRuleService, TenureService $tenureService)
    {
        $this->emiRuleService = $emiRuleService;
        $this->tenureService = $tenureService;
    }
    
    public function index()
    {
        return view('admin.emi_rules')->with([
            'emiRules' => $this->emiRuleService->getAllEmiRules(),
            'tenures' => $this->tenureService->getAllTenures()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0|gt:min_amount',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'tenure_id' => 'required|exists:tenures,id',
        ]);


        // Checks if the EMI rule already exists
        $existingRule = $this->emiRuleService->checkEmiRuleExists($request->min_amount, $request->max_amount, $request->tenure_id);
        if ($existingRule) {
            return redirect()->route('emi-rules.index')->with('message', 'EMI Rule already exists.');
        }

        $this->emiRuleService->createEmiRule($request->all());

        return redirect()->route('emi-rules.index')->with('message', 'EMI Rule created successfully.');
    }

    public function edit($id)
    {
        $emiRule = $this->emiRuleService->getEmiRuleById($id);
        $tenures = $this->tenureService->getAllTenures();
        return view('admin.emi_rule_edit', compact('emiRule', 'tenures'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0|gt:min_amount',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'tenure_id' => 'required|exists:tenures,id',
        ]);

        $existingRule = $this->emiRuleService->checkEmiRuleExists($request->min_amount, $request->max_amount, $request->tenure_id, $id);

        if ($existingRule) {
            return redirect()->route('emi-rules.index')->with('message', 'Cannot update EMI Rule as it already exists.');
        }

        $this->emiRuleService->updateEmiRule($id, $request->all());

        return redirect()->route('emi-rules.index')->with('message', 'EMI Rule updated successfully.');
    }

    public function destroy($id)
    {
        $emi_rule = EmiRule::findOrFail($id);
        $emi_rule->delete();

        return redirect()->route('emi-rules.index')->with('message', 'EMI Rule deleted successfully.');
    }
}
