<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'department_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'hire_date',
        'salary',
        'status',
    ];

    /**
     * Employee belongs to a Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Accessor for full name
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function birthday()
    {
        return $this->hasOne(BirthdayCorner::class);
    }

}
