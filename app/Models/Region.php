<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table='regions';
    protected $primaryKey='id';
    public $incrementing = false;
    public $timestamps = false;    
    
    protected $fillable = [
        'name',
        'slug',
    ];
}
