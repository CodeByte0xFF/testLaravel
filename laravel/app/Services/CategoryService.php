<?php
namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryService
{
    public function getAll(): Collection
    {
        return Category::select('id', 'title', 'slug')->withCount('posts')->get();
    }

    public function getBySlug(string $slug): Category
    {
        return Category::where('slug', $slug)->firstOrFail();
    }
}
