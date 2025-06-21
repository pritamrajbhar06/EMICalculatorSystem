<?php

namespace App\Http\Controllers;

use App\Models\Tenure;
use App\Services\TenureService;
use Illuminate\Http\Request;

class TenureController extends Controller
{
    protected $tenureService;
    public function __construct(TenureService $tenureService)
    {
        $this->tenureService = $tenureService;
    }

    public function index()
    {
        return view('admin.tenure')->with([
            'tenures' => $this->tenureService->getAllTenures(),
        ]);
    }

    public function edit($id)
    {
        $tenure = $this->tenureService->getTenureById($id);
        return view('admin.tenure_edit', compact('tenure'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'months' => 'required|integer|min:1|unique:tenures,months,' . $id
        ]);

        $this->tenureService->updateTenure($id, $request->all());

        return redirect()->route('tenures.index')->with('message', 'Tenure updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'months' => 'required|integer|min:1|unique:tenures,months'
        ]);

        $this->tenureService->createTenure($request->all());

        return redirect()->route('tenures.index')->with('message', 'Tenure created successfully.');
    }

    public function destroy($id)
    {
        $this->tenureService->deleteTenure($id);

        return redirect()->route('tenures.index')->with('message', 'Tenure deleted successfully.');
    }
}
