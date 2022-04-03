<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'barcode',
        'product_name',
        'user_id'
    ];

    /**
     * Gets the user who scanned this product.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
