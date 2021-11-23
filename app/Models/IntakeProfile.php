<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeProfile extends Model
{
    use HasFactory;

    /**
     * Gets the user who has this intake profile.
     */
    public function user() {
        return $this->hasOne(User::class);
    }
}
