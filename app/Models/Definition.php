<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Definition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'word_id',
        'definition',
        'appropriate',
        'published_at',
        'word_type_id',
        'user_id',
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
        'published_at'=>'dateTime'

    ];

    // Definitions
    public function ratings(): BelongsToMany
    {
        return $this->belongsToMany(Rating::class)
            ->using(DefinitionRating::class)
            ->withPivot('definition_rating.value')
            ->withTimestamps();
    }

    public function wordType(): BelongsTo
    {
        return $this->belongsTo(WordType::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }

    public function userRating()
    {
        $userRating = $this->ratings()->where('user_id', '=', Auth::user()->id)->first();

        if (!is_null($userRating)){
            $userRating = $userRating->value;
        }

        return $userRating;
    }

    public function totalRatings()
    {
        return $this->ratings()->count();
    }

    public function averageRating()
    {
        $average = $this->ratings()->average(DB::raw('ratings.value'));
        return round($average, 1);
    }

}


