<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'first_name' => $this->card->family_header_id ? $this->card->family->first_name : $this->card->member->first_name,
            'last_name' => $this->card->family_header_id ? $this->card->family->last_name : $this->card->member->last_name,
            'national_id' => $this->card->family_header_id ? $this->card->family->national_id : $this->card->member->national_id,
            'image' => $this->card->family_header_id ? $this->card->family->image : $this->card->member->image,
            'created_at' => $this->created_at->format('d M, Y H:i:s'),
            'payment_status' => $this->payment_status,
            'status' => $this->status,
            'department' => $this->department,

        ];
    }
}
