<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'value',
        'icon',
        'colour'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    public function definitions() {
        return $this->belongsToMany(Definition::class)
            ->using(DefinitionRating::class)
            ->withPivot('value')
            ->withTimestamps();
    }

    public function getIcons(){

        return ['star', 'lemon', 'x', 'check', 'thumbs-up', 'thumbs-down', 'poo'];
    }

}
