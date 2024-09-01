<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Day;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'name',
        'departure',
        'arrival',
        'start_date',
        'end_date',
        'duration',
        'slug'
    ];
    public function Days()
    {
        return $this->hasMany(Day::class);
    }
}
