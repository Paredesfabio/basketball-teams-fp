<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'about',
        'color',
        'icon',
        'division_id',
        'mascot_name'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
