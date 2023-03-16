<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'team_id',
        'role'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function attributes()
    {
        return $this->hasOne(Attribute::class);
    }

    public function getNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('role', 'asc');
        });
    }

}
