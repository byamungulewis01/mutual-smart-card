<?php

namespace App\Http\Controllers;

use App\Models\MutualCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectorSettingsController extends Controller
{
    //
    public function index()
    {
       $categories = MutualCategory::all();
        return Inertia::render('Sector/Settings',['categories' => $categories]);

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        try {
            MutualCategory::create($request->all());
            return back()->with('message', 'Member registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('warning', 'Something went wrong, please try again');
        }
    }
}
