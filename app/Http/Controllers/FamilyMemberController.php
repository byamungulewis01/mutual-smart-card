<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('Sector/FamilyMember/Create', ['family' => request('family')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'phone' => 'nullable',
            'national_id' => 'nullable|numeric|digits:16',
            'gender' => 'required',
            'photo' => 'required',
            'matialStatus' => 'required',
            'dateOfBirth' => 'required',
            'family_header_id' => 'required',
        ]);
        try {
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->store('profile', 'public');
                $request->merge(['image' => $photo]);
            }
            FamilyMember::create($request->all());
            return to_route('sector.families.show', $request->family_header_id)->with('message', 'Member registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            // dd($th->getMessage());
            return back()->with('warning', 'Something went wrong, please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FamilyMember $family_member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyMember $family_member)
    {
      return Inertia::render('Sector/FamilyMember/Edit', compact('family_member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyMember $family_member)
    {
        $request->validate([
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'phone' => 'nullable',
            'national_id' => 'nullable|numeric|digits:16',
            'gender' => 'required',
            'photo' => 'nullable',
            'matialStatus' => 'required',
            'dateOfBirth' => 'required',
        ]);

        try {
            if ($request->hasFile('photo')) {
                Storage::delete($family_member->image);
                $photo = $request->file('photo')->store('profile', 'public');
                $request->merge(['image' => $photo]);
            }
            $family_member->update($request->all());
            return to_route('sector.families.show', $family_member->family_header_id)->with('message', 'Member updated successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('warning', 'Something went wrong, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyMember $family_member)
    {
        try {
            //code...
            $family_member->delete();
            return back()->with('message', 'Member Deleted successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('warning', 'Something went wrong, please try again');

        }
    }

}
