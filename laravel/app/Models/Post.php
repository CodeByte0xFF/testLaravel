<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $postSlug)
 * @property mixed $title
 * @property mixed $category
 * @property mixed $description
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'category_id'];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
