<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpManagement extends Model
{
    use HasFactory;
    
    protected $table = 'ip_management';

    protected $fillable = [
        'firstname',
        'lastname',
        'device',
        'ip_address',
        'status'
    ];

}
