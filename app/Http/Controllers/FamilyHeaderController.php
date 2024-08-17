<?php

namespace App\Http\Controllers;

use App\Http\Resources\FamilyHeaderResource;
use App\Http\Resources\FamilyMemberResource;
use App\Models\FamilyHeader;
use App\Models\FamilyMember;
use App\Models\MutualCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FamilyHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = FamilyHeader::orderByDesc('id')->paginate(10);
        $families = FamilyHeaderResource::collection($collection);
        return Inertia::render('Sector/FamilyHeader/Index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $districts = DB::table('rwanda_addresses')
            ->select('dist_id', 'district')->groupBy('dist_id')->get();
        $categories = MutualCategory::all();
        return Inertia::render('Sector/FamilyHeader/Create', compact('districts', 'categories'));
    }

    public function getSectors($district)
    {
        $sectors = DB::table('rwanda_addresses')->where('dist_id', $district)
            ->select('sect_id', 'sector')->groupBy('sect_id')->get();
        return response()->json($sectors);
    }
    public function getCells($sector)
    {
        $cells = DB::table('rwanda_addresses')->where('sect_id', $sector)
            ->select('cell_id', 'cell')->groupBy('cell_id')->get();
        return response()->json($cells);
    }
    public function getVillages($cell)
    {
        $villages = DB::table('rwanda_addresses')->where('cell_id', $cell)
            ->select('vill_id', 'village')->groupBy('vill_id')->get();
        return response()->json($villages);
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
            'national_id' => 'required|numeric|digits:16',
            'gender' => 'required',
            'photo' => 'required',
            'matialStatus' => 'required',
            'mutual_category' => 'required',
            'dateOfBirth' => 'required',
            'district' => 'required|numeric',
            'sector' => 'required|numeric',
            'cell' => 'required|numeric',
            'village' => 'required|numeric',
        ]);
        try {
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo')->store('profile', 'public');
                $request->merge(['image' => $photo]);
            }
            FamilyHeader::create($request->all());
            return to_route('sector.families.index')->with('message', 'family Header registed successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('warning', 'Something went wrong, please try again');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FamilyHeader $family)
    {
        $family = new FamilyHeaderResource($family);
        $collection = FamilyMember::where('family_header_id', $family->id)->get();
        $family_members = FamilyMemberResource::collection($collection);

        return Inertia::render('Sector/FamilyHeader/Show', compact('family', 'family_members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyHeader $family)
    {
        $districts = DB::table('rwanda_addresses')
            ->select('dist_id', 'district')->groupBy('dist_id')->get();
        $sectors = DB::table('rwanda_addresses')->where('dist_id', $family->district)
            ->select('sect_id', 'sector')->groupBy('sect_id')->get();
        $cells = DB::table('rwanda_addresses')->where('sect_id', $family->sector)
            ->select('cell_id', 'cell')->groupBy('cell_id')->get();
        $villages = DB::table('rwanda_addresses')->where('cell_id', $family->cell)
            ->select('vill_id', 'village')->groupBy('vill_id')->get();
        $categories = MutualCategory::all();

        return Inertia::render('Sector/FamilyHeader/Edit', compact('districts', 'sectors', 'cells', 'villages', 'categories', 'family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyHeader $family)
    {
        $request->validate([
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'phone' => 'nullable',
            'national_id' => 'required|numeric|digits:16',
            'gender' => 'required',
            'photo' => 'nullable',
            'matialStatus' => 'required',
            'mutual_category' => 'required',
            'dateOfBirth' => 'required',
            'district' => 'required|numeric',
            'sector' => 'required|numeric',
            'cell' => 'required|numeric',
            'village' => 'required|numeric',
        ]);

        try {
            if ($request->hasFile('photo')) {
                Storage::delete($family->image);
                $photo = $request->file('photo')->store('profile', 'public');
                $request->merge(['image' => $photo]);
            }
            $family->update($request->all());
            return to_route('sector.families.index')->with('message', 'family Header Updated successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('warning', 'Something went wrong, please try again');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyHeader $family)
    {
        try {
            //code...
            $family->delete();
            return back()->with('message', 'Family Deleted successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('warning', 'Something went wrong, please try again');

        }
    }
}
