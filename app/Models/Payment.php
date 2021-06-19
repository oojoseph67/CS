<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'fID',
        'first_name',
        'last_name',
        'email',
        'fee_type',
        'status',
        'session',
        'order_number',
        'order_date',
    ];
}
