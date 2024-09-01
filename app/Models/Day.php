<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\Stop;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [ 'trip_id','date'];
    
    public function Trip()
    {
        return $this->belongsTo(Trip::class);
    }
    public function Stops()
    {
        return $this->hasMany(Stop::class);
    }
}
