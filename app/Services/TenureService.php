<?php

namespace App\Services;

use App\Models\Tenure;

class TenureService
{
    public function getAllTenures()
    {
        return Tenure::orderBy('months', 'asc')->get();
    }

    public function getTenureById($id)
    {
        return Tenure::findOrFail($id);
    }

    public function createTenure(array $data)
    {
        return Tenure::create($data);
    }

    public function updateTenure($id, array $data)
    {
        $tenure = $this->getTenureById($id);
        $tenure->update($data);
        return $tenure;
    }

    public function deleteTenure($id)
    {
        $tenure = $this->getTenureById($id);
        $tenure->delete();
        return true;
    }
}
