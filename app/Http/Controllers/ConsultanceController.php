<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConsultanceResource;
use App\Models\Consultance;
use Inertia\Inertia;

class ConsultanceController extends Controller
{
    //
    public function index()
    {
        $consultances = ConsultanceResource::collection(Consultance::where('department', auth()->user()->department)->where('status', 'pending')->orderByDesc('id')->get());
        return Inertia::render('Consultance/Index', compact('consultances'));
    }
    public function allAdmission()
    {
        $consultances = ConsultanceResource::collection(Consultance::orderByDesc('id')->get());
        return Inertia::render('Consultance/All', compact('consultances'));
    }
    public function approveTreatment($id)
    {
        Consultance::find($id)->update(['status' => 'complete']);
        return back()->with('status', 'submited successfully');
    }
}
