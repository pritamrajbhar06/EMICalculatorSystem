<?php

namespace App\Services;
use App\Models\EmiRule;

class EmiRuleService
{
    public function getAllEmiRules()
    {
        return EmiRule::with('tenure')->get();
    }

    public function getEmiRuleById($id)
    {
        return EmiRule::findOrFail($id);
    }

    public function checkEmiRuleExists($minAmount, $maxAmount, $tenureId, $id = null)
    {
        $query = EmiRule::where('min_amount', '<=', $maxAmount)
            ->where('max_amount', '>=', $minAmount)
            ->where('tenure_id', $tenureId);

        if ($id) {
            $query->where('id', '!=', $id);
        }

        return $query->first();
    }

    public function createEmiRule(array $data)
    {
        return EmiRule::create($data);
    }

    public function updateEmiRule($id, array $data)
    {
        $emiRule = $this->getEmiRuleById($id);
        $emiRule->update($data);
        return $emiRule;
    }

    public function deleteEmiRule($id)
    {
        $emiRule = $this->getEmiRuleById($id);
        $emiRule->delete();
        return true;
    }
}
