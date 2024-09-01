<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Day;
class Stop extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_id',
        'title',
        'description',
        'image_cover',
        'longitude',
        'latitude',
    ];
    public function Day()
    {
        return $this->belongsTo(Day::class);
    }
}
