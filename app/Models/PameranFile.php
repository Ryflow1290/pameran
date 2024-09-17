<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PameranFile extends Model
{
    use HasFactory;

    protected $table = 'pameran_files';

    protected $fillable = [
        'pameran_id',
        'path',
        'caption',
        'type',
        'size'
    ];

    // Relationship to Pameran
    public function pameran()
    {
        return $this->belongsTo(Pameran::class);
    }
}
