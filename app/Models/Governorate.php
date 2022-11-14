<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Laravel\Scout\Searchable;

class Governorate extends Model
{
    use HasFactory, HasTranslations, Searchable;

    protected $table = 'governorates';

    protected $fillable = ['name'];

    public $translatable = ['name'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function toSearchableArray()
    {
        return $this->only(['name']);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getName(),
        );
    }

    public function slug()
    {
        return $this->name;
    }

    public function getName($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return $this->getTranslations('name')[$lang] ?? '';
    }
}
