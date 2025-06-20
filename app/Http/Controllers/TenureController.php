<?php

namespace App\Http\Controllers;

use App\Models\Tenure;
use Illuminate\Http\Request;

class TenureController extends Controller
{
    public function index()
    {
        return view('admin.tenure')->with([
            'tenures' => \App\Models\Tenure::all(),
        ]);
    }

    public function edit($id)
    {
        $tenure = Tenure::findOrFail($id);
        return view('admin.tenure_edit', compact('tenure'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'months' => 'required|integer|min:1|unique:tenures,months,' . $id
        ]);

        $tenure = Tenure::findOrFail($id);
        $tenure->update($request->all());

        return redirect()->route('tenures.index')->with('message', 'Tenure updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'months' => 'required|integer|min:1|unique:tenures,months'
        ]);

        Tenure::create($request->all());

        return redirect()->route('tenures.index')->with('message', 'Tenure created successfully.');
    }

    public function destroy($id)
    {
        $tenure = Tenure::findOrFail($id);
        $tenure->delete();

        return redirect()->route('tenures.index')->with('message', 'Tenure deleted successfully.');
    }
}
