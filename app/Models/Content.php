<?php

namespace App\Models;

use App\Constants\ContentType as ConstantsContentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Scout\Searchable;

class Content extends Model
{
    use HasFactory, HasTranslations, Searchable;

    protected $table = 'contents';

    protected $fillable = ['title', 'data', 'video_thumb', 'content_type_id', 'category_id', 'patch_number'];

    public $translatable = ['title', 'data'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function toSearchableArray()
    {
        return $this->only(['title', 'data']);
    }

    public function contentType()
    {
        return $this->belongsTo(ContentType::class, 'content_type_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function rbts()
    {
        return $this->hasMany(Rbt::class);
    }

    protected function videoThumb(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && file_exists("uploads/contents/$value") ? "uploads/contents/$value" : null,
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTitle(),
        );
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getData(),
        );
    }

    public function getTitle($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return $this->getTranslations('title')[$lang] ?? '';
    }

    public function getData($lang = null)
    {

        $lang = $lang ?? app()->getLocale();
        $data = $this->getTranslations('data')[$lang] ?? '';
        return ConstantsContentType::dataHandler($this->content_type_id, $data);
    }

    public function getDataHtml($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        $data = $this->getTranslations('data')[$lang] ?? '';
        return ConstantsContentType::displatHtmlHandler($this->content_type_id, $data, 'contents/');
    }

    public function slug()
    {
        return $this->title;
    }

    public function contentTypeIs($name)
    {
        return $this->contentType->name == $name;
    }

    public function scopeFilter($query)
    {
        return $query->when(request('content'), function($query) {
                        $query->where('id', request('content'));
                    })->when(request('category'), function($query) {
                        $query->where('category_id', request('category'));
                    });
    }
}
