<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiasActividades extends Model
{
    use HasFactory;
    protected $table = 'dias_actividades';
    protected $guarded = [];
    public $timestamps = false;
}
