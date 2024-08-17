<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalCard extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'family_header_id',
        'family_member_id',
        'card_number',
        'status',
        'user_id',
    ];
    public function family()
    {
        return $this->belongsTo(FamilyHeader::class, 'family_header_id');
    }
    public function member()
    {
        return $this->belongsTo(FamilyMember::class, 'family_member_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
