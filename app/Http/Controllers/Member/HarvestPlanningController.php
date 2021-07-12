<?php

namespace App\Http\Controllers\Member;

use App\HarvestPlanning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HarvestPlanningController extends Controller
{
    public function addHarvestPlanningAgriculture(Request $request)
    {        
        $this->validate($request, [
            'agricultural_group_id' => 'required',
            'step' => 'required',
            'type_harvest' => 'required',
            'date' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'estimated_selling_price' => 'required'
        ]);

        HarvestPlanning::create([
            'agricultural_group_id' => $request->agricultural_group_id,
            'step' => $request->step,
            'type_harvest' => $request->type_harvest,
            'date' => $request->date,
            'qty' => $request->qty,
            'unit' => $request->unit,
            'estimated_selling_price' => $request->estimated_selling_price,
            'total_income' => $request->qty * $request->estimated_selling_price

        ]);

        return redirect()->back()->with(['success' => 'Perencanaan panen telah ditambahkan']);
    }
}
