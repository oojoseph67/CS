<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'fID',
        'first_name',
        'last_name',
        'email',
        'gsm',
        'dob',
        'place_of_birth',
        'disability',
        'health_challenges',
        'sex',
        'marital_status',
        'title',
        'nationality',
        'religion',
        'state_of_origin',
        'lga',
        'martial_status',
        'language',
        'name_of_guarrantor',
        'address_of_guarrantor',
        'gsm_of_guarrantor',
        'resident_address',
        'private_address',
        'permmanent_address',
        'landlord_name',
        'landlord_address',
        'landlord_gsm',
        'parent_name',
        'parent_address',
        'employer_name',
        'employer_address',
        'employer_gsm',
        'sponsor_name',
        'sponsor_address',
        'sponsor_gsm',
        'name_of_next_of_kin',
        'address_of_next_of_kin',
        'gsm_of_next_of_kin',
        'email_of_next_of_kin',
        'level_of_entry',
        'mode_of_entry',
        'year_of_entry',
        'mode_of_study',
        'college',
        'dept',
        'mat_no',
        'programme_of_study',
        'expected_graduation_year',
        'qualification_on_entry',
        'qualification_currently',
        'institution_attended',
        'institution_attended_date',
    ];

}
