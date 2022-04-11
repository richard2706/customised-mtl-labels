<?php

namespace App\Models;

use App\Enums\AgeCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class IntakeProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'max_calories',
        'max_total_fat',
        'max_saturated_fat',
        'max_total_sugar',
        'max_salt',
    ];

    /**
     * Gets the user who has this intake profile.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
