<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    ////////////////////////////////////////////
    public static function generateSlug($name){
        $slugBase = Str::slug(trim($name), '-');
        $slugs = \App\Models\Trip::orderBy('slug')->pluck('slug')->toArray();
        $num = 1;
        $slugNumbers = [];
        
        foreach ($slugs as $slug) {
            if (preg_match('/-(\d+)$/', $slug, $matches)) {
                $slugNumbers[] = intval($matches[1]);
            }
        }

        while (in_array($num, $slugNumbers)) {
            $num++;
        }

        $slug = $slugBase . '-' . $num;

        if(preg_match('/-(\d+)$/', $slugBase, $matches)){
            if(!in_array($matches[1],$slugNumbers)){
                $slug=$slugBase;   
            }
        }
        return $slug;
    }
}
