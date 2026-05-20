<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthdayCorner extends Model
{
    use HasFactory;

    protected $table = 'birthday_corner';

    protected $fillable = [
        'employee_id',
        'birthdate',
        'profile_picture'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
