<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyHeader extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'national_id',
        'dateOfBirth',
        'gender',
        'image',
        'phone',
        'matialStatus',
        'mutual_category',
        'district',
        'sector',
        'cell',
        'village',
    ];

}
