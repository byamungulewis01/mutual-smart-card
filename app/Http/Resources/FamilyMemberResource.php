<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyMemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dob = new \DateTime($this->dateOfBirth);
        $ageInterval = now()->diff($dob);
        $age = $ageInterval->y;

        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'national_id' => $this->national_id,
            'phone' => $this->phone,
            'image' => $this->image,
            'matialStatus' => $this->matialStatus,
            'gender' => ($this->gender == 'male') ? 'Male' : 'Female',
            'dateOfBirth' => Carbon::parse($this->dateOfBirth)->format('M d, Y'),
            'age' => $age,
    
        ];
    }
}
