<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'contact_phone_number', 'image', 'user_id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }


protected function description(): Attribute
{
    return Attribute::make(
        get: fn ($value) => Str::limit($value , 512 , '...'),
    );
}


    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && file_exists('uploads/posts/' . $value) ? "uploads/posts/$value" : null,
        );
    }

    public function scopeExceptAuth($query)
    {
        return $query->where('user_id', '!=', auth()->id());
    }

    public function scopeFilter(Builder $builder)
    {
        return $builder->when(request('user'), function($query) {
            return $query->where('user_id', request('user'));
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });

        self::creating(function($model) {
            $model->user_id = auth()->id();
        });

        self::updating(function($model) {
            $model->user_id = auth()->id();
        });
    }
}
