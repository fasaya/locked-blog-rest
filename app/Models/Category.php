<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'slug',
        'name',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the posts that are assigned this category.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'content', 'category_contents');
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
