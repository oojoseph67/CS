<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'fID',
        'passport',
        'o/l_certificate',
        'o/l_card',
        'ufd/hnd_certificate',
        'rhd/diploma_certificate',
        'nysc/exemption_certificate',
        'clearnce_certificate_fupre',
        'birth_certificate',
        'state_of_origin_certificate',
        'marriage_certificate',
        'admission_letter',
        'application_form',
        'transcript'
    ];
}
