<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyHoliday extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'description',
        'type',
    ];

    protected $dates = ['date'];

    protected $casts = [
        'date' => 'date',
    ];
}
