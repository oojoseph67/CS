<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuarrantorForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'fID',
        'name',
        'gsm',
        'email',
        'position',
        'title',
        'name_of_institution',
        'address_of_institution',
        'time_with_applicant',
        'capacity',
        'academic_performance',
        'academic_achievement',
        'research_potential',
        'originality',
        'judgment',
        'motivation',
        'ability_to_work_independently',
        'oral_expression',
        'written_expression',
        'potential',
        'reference_letter',
        'recommendation',
    ];
}
