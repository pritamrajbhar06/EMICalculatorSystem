<?php

namespace App\Http\Controllers;

use App\Models\EmiRule;
use App\Models\Tenure;
use Illuminate\Http\Request;

class EmiRuleController extends Controller
{
    public function index()
    {
        return view('admin.emi_rules')->with([
            'emiRules' => EmiRule::with('tenure')->get(),
            'tenures' => Tenure::all()
        ]);
    }

    public function create()
    {
        $tenures = Tenure::all();
        return view('admin.emi_rule_create', compact('tenures'));
    }


    public function edit($id)
    {
        $emiRule = EmiRule::findOrFail($id);
        return view('admin.emi_rule_edit', compact('emiRule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'tenure_id' => 'required|exists:tenures,id',
        ]);

        $emi_rule = EmiRule::findOrFail($id);
        $emi_rule->update($request->all());

        return redirect()->route('emi-rules.index')->with('message', 'EMI Rule updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'tenure_id' => 'required|exists:tenures,id',
        ]);

        EmiRule::create($request->all());

        return redirect()->route('emi-rules.index')->with('message', 'EMI Rule created successfully.');
    }

    public function destroy($id)
    {
        $emi_rule = EmiRule::findOrFail($id);
        $emi_rule->delete();

        return redirect()->route('emi_rules.index')->with('message', 'EMI Rule deleted successfully.');
    }
}
