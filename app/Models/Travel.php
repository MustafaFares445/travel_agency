<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    use HasFactory , Sluggable , HasUuids;

    protected $table = 'travels';
    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
      'is_public',
      'slug',
      'name',
      'description',
      'number_of_days'
    ];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function scopePublic(Builder $builder): void
    {
        $builder->where('is_public' , true);
    }
    public function sluggable(): array
    {
        return [
           'slug' => [
               'source' => 'name'
           ]
        ];
    }

    public function numberOfNights(): Attribute
    {
        return Attribute::make(
          get: fn($value , $attributes) => $attributes['number_of_days'] - 1
        );
    }

//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }
}
