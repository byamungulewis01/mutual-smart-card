<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_header_id',
        'first_name',
        'last_name',
        'national_id',
        'dateOfBirth',
        'gender',
        'image',
        'matialStatus',
        'phone',
    ];
}
