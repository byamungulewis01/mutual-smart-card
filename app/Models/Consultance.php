<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultance extends Model
{
    use HasFactory;
    protected $fillable = ['hospital_card_id', 'department', 'payment_status', 'status'];
    public function card()
    {
        return $this->belongsTo(HospitalCard::class, 'hospital_card_id');
    }
}

