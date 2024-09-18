<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunLulus extends Model
{   

    use HasFactory;

    protected $table = 'tahun_lulus';

    protected $fillable = ['tahun', 'year'];

    public function users()
    {
        return $this->hasMany(User::class, 'tahun_lulus');
    }
}
