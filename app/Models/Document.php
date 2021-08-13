<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'fID',
        'passport',
        'ol_certificate',
        'ol_card',
        'ufd_hnd_certificate',
        'rhd_diploma_certificate',
        'nysc_exemption_certificate',
        'clearnce_certificate_fupre',
        'birth_certificate',
        'state_of_origin_certificate',
        'marriage_certificate',
        'admission_letter',
        'application_form',
        'transcript'
    ];
}
