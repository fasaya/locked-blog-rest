<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'parent_id',
        'slug',
        'title',
        'preview',
        'content',
        'status',
        'meta_title',
        'meta_description',
        'published_at',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function boot()
    {
        parent::boot();
        date_default_timezone_set("Asia/Makassar");
        self::creating(function ($model) {
            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
        });

        self::updating(function ($model) {
            $model->updated_at = date("Y-m-d H:i:s");
        });
    }
}
