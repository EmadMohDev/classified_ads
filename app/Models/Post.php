<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'contact_phone_number', 'image', 'user_id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && file_exists('uploads/posts/' . $value) ? "uploads/posts/$value" : null,
        );
    }

    public function scopeFilter(Builder $builder)
    {
        return $builder->when(request('users'), function($query) {
            return $query->where('user', request('user'));
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
