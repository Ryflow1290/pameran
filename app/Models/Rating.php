<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'pameran_id', 'user_id', 'count', 'opinion'
    ];

    // Relationships

    public function pameran()
    {
        return $this->belongsTo(Pameran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
