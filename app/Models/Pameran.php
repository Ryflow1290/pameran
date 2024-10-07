<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pameran extends Model
{
    use HasFactory;

    protected $table = 'pamerans';

    protected $fillable = [
        'title',
        'user_id',
        'abstract',
        'description',
        'jurusan_id'

    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to PameranFile
    public function files()
    {
        return $this->hasMany(PameranFile::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function likes(){
        return $this->hasMany(Rating::class);
    }
}
