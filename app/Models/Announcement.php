<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Allow mass assignment on these fields
    protected $fillable = [
        'title',        // <- added title
        'description',
        'image',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isModerator()
    {
        return $this->role === 'moderator';
    }
    
    public function isStaff()
    {
        return in_array($this->role, ['admin', 'moderator']);
    }
}
