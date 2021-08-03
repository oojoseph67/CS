<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClearanceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'fID',
        'personal_form',
        'document',
        'preliminary_form',
        'clearance_form',
        'guarrantor_form',
        'hod_recommendation',
        'pg_officer_recommendation',
    ];
}
