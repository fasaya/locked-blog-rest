<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;

    /**
     * Get all of the posts that are assigned this category.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'content', 'password_contents');
    }
}
