<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;

class Operator extends Model
{
    use HasFactory, HasTranslations, Searchable;

    protected $table = 'operators';

    protected $fillable = ['name', 'country_id'];

    public $translatable = ['name'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function toSearchableArray()
    {
        return $this->only(['name']);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->select('id', 'name');
    }

    public function fullName()
    {
        return $this->name . ' - ' . $this->country?->name;
    }

    public function name($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return $this->getTranslations('name')[$lang] ?? '';
    }

    public function slug()
    {
        return $this->name;
    }

    public function scopeFilter($query)
    {
        return $query->when(request('country'), function ($query) {
            return $query->where('country_id', request('country'));
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('country_id', 'ASC');
        });
    }
}
