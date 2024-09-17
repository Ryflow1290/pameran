<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans';

    protected $fillable = [
        'name',
        'code'
    ];

    // Relation to Users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relation to Pameran
    public function pamerans()
    {
        return $this->hasMany(Pameran::class);
    }
}
