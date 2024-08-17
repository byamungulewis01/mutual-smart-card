<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MutualPayment;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dateOfBirth = $this->family_header_id ? $this->family->dateOfBirth : $this->member->dateOfBirth;
        $dob = new \DateTime($dateOfBirth);
        $ageInterval = now()->diff($dob);
        $age = $ageInterval->y;
        $family_id = $this->family_header_id ? $this->family->id : $this->member->family_header_id;

        return [
            'id' => $this->id,
            'card_number' => $this->card_number,
            'first_name' => $this->family_header_id ? $this->family->first_name : $this->member->first_name,
            'last_name' => $this->family_header_id ? $this->family->last_name : $this->member->last_name,
            'national_id' => $this->family_header_id ? $this->family->national_id : $this->member->national_id,
            'phone' => $this->family_header_id ? $this->family->phone : $this->member->phone,
            'image' => $this->family_header_id ? $this->family->image : $this->member->image,
            'gender' => $this->family_header_id ? $this->family->gender : $this->member->gender,
            'dateOfBirth' => $this->family_header_id ? Carbon::parse($this->family->dateOfBirth)->format('M d, Y') : Carbon::parse($this->member->dateOfBirth)->format('M d, Y'),
            'age' => $age,
            'created_at' => $this->created_at->format('d M, Y'),
            'status' => $this->deleted_at ?? null,
            'payment' => MutualPayment::where('family_header_id', $family_id)->latest()->first(),

        ];
    }
}
