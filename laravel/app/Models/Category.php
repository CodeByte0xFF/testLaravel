<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, mixed $categorySlug)
 * @method static select(string $string, string $string1)
 * @method static withCount(string $string)
 * @property mixed $title
 * @property mixed $slug
 * @property mixed $posts_count
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
