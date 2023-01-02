<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordContent extends Model
{
    use HasFactory;

    public function password()
    {
        return $this->belongsTo(Password::class, 'content_id', 'id');
    }
}
