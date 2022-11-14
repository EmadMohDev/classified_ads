<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rbt extends Model
{
    use HasFactory;

    protected $table = 'rbts';

    protected $fillable = ['code', 'ussd', 'content_id', 'operator_id'];

    public function slug()
    {
        return $this->code;
    }

	public function content() { return $this->belongsTo(Content::class, 'content_id')->select('id', 'title', 'content_type_id', 'data')->withDefault(['title' => '']); }

	public function operator() { return $this->belongsTo(Operator::class, 'operator_id')->select('id', 'name', 'country_id')->withDefault(['name' => '']); }

    public function scopeFilter($query)
    {
        return $query->when(request('content'), function($query) {
            $query->where('content_id', request('content'));
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDesc', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });
    }
}
