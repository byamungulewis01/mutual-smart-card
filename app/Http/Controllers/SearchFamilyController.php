<?php

namespace App\Http\Controllers;

use App\Http\Resources\FamilyHeaderResource;
use App\Http\Resources\FamilyMemberResource;
use App\Http\Resources\SearchResource;
use App\Models\Consultance;
use App\Models\FamilyHeader;
use App\Models\FamilyMember;
use App\Models\HospitalCard;
use App\Models\MutualPayment;
use App\Models\PaypackTransaction;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Paypack\Paypack;

class SearchFamilyController extends Controller
{
    //
    public function manualSearch()
    {
        $family_number = request('family_number');

        $collection = FamilyHeader::when($family_number, function ($query) use ($family_number) {
            $query->where('national_id', 'like', '%' . $family_number . '%');
        })->paginate(10)->withQueryString();
        $families = FamilyHeaderResource::collection($collection);

        return Inertia::render('Hospital/ManualSearch', compact('families', 'family_number'));
    }
    public function smartSearch()
    {
        return Inertia::render('Hospital/SmartSearch');
    }
    public function departments()
    {
        $patient = (int) request('patient');
        return Inertia::render('Hospital/Departments', compact('patient'));
    }
    public function consultanceSubmit(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'patient' => 'required',
        ]);
        $patient = HospitalCard::find($request->patient);
        $family_id = $patient->family_header_id ? $patient->family->id : $patient->member->family_header_id;
        $payment = MutualPayment::where('family_header_id', $family_id)->latest()->first();

        Consultance::create([
            'hospital_card_id' => $request->patient,
            'department' => $request->department,
            'payment_status' => $payment ? 'mutual' : 'private',
            'status' => 'pending',
        ]);
        return to_route('smartSearch')->with('message', 'Well done , request submited successful');
    }
    public function saveCardNumber(Request $request)
    {
        $request->validate([
            'person_id' => 'required',
            'type' => 'required',
            'cardNumber' => 'required',
        ]);
        $check = HospitalCard::where('card_number', $request->cardNumber)->where('status', 'active')->first();
        if ($check) {
            return back()->with('warning', 'Card number is already in use by another');
        }

        try {
            HospitalCard::create([
                'family_header_id' => $request->type == 'header' ? $request->person_id : null,
                'family_member_id' => $request->type == 'member' ? $request->person_id : null,
                'card_number' => $request->cardNumber,
                'user_id' => auth()->id(),
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Card not registered something went wrong');
        }

        return back()->with('message', 'card Registration Success');
    }
    public function searchPerson($cardnumber)
    {
        $person = HospitalCard::where('card_number', $cardnumber)->where('status', 'active')->first();
        if ($person) {
            return response()->json(['success' => true, 'person' => new SearchResource($person)]);
        } else {
            return response()->json(['success' => false]);

        }

    }
    public function showFamily(FamilyHeader $family)
    {
        $family = new FamilyHeaderResource($family);
        $collection = FamilyMember::where('family_header_id', $family->id)->get();
        $family_members = FamilyMemberResource::collection($collection);
        return Inertia::render('Hospital/ShowFamily', compact('family', 'family_members'));
    }
    public function consultationPayment(Request $request, $patient)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'phone' => 'required|numeric|digits:10',
        ]);

        try {

            $setting = Setting::where('name', 'payment')->first();
            if ($setting->value) {
                $paypack = new Paypack();

                $paypack->config([
                    'client_id' => env('PAYPACK_CLIENT_ID'),
                    'client_secret' => env('PAYPACK_CLIENT_SECRET'),
                ]);

                $cashin = $paypack->Cashin([
                    'phone' => $request->phone,
                    'amount' => $request->amount,
                ]);

                PaypackTransaction::create([
                    'type' => 'consultance',
                    'patient' => $patient,
                    'ref' => $cashin['ref'],
                    'amount' => $request->amount,
                    'phone' => $request->phone,
                ]);

                return back()->with('payment', true);
            } else {
                return to_route('search.departments', ['patient' => $patient]);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'some thing went wrong');
        }
    }

}
