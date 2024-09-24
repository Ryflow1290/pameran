<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalConfig extends Model
{

    use HasFactory;

    protected $table = 'global_config_tables';

    protected $fillable = [
        'key',
        'value'
    ];

}
