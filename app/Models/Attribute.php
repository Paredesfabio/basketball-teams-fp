<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'number',
        'position',
        'school',
        'height',
        'weight',
        'about_me',
        'player_id',
        'country_id',
        'birth_date',
        'draft_date'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'draft_date' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getExperienceAttribute()
    {
        return Carbon::now()->diff($this->draft_date)->y;
    }
}
