<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\ResponseCache\Facades\ResponseCache;
use Spatie\Translatable\HasTranslations;

class Link extends Model
{
    use HasTranslations;

    protected $fillable = ['internal_title', 'title', 'description', 'link'];

    protected $translatable = ['title', 'description'];

    public function agencies()
    {
        return $this->belongsToMany(Agency::class);
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class);
    }

    protected static function booted()
    {
        static::updated(function (self $link) {
//            $vehicles = Vehicle::whereIn('agency_id', $link->agencies->pluck('id'))->get();
//            foreach ($vehicles as $vehicle) {
//                dd($link);
//                echo $vehicle->id;
//                $vehicle->links()->syncWithoutDetaching($link->id);
//            }

            ResponseCache::forget('/api/links');
            ResponseCache::forget('/v1/links');

            ResponseCache::selectCachedItems()
                ->usingSuffix('en')
                ->forUrls('/v2/links', "/v2/links/{$link->id}")
                ->forget();
            ResponseCache::selectCachedItems()
                ->usingSuffix('fr')
                ->forUrls('/v2/links', "/v2/links/{$link->id}")
                ->forget();
        });
    }
}
