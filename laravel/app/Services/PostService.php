<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function getByCategory(int $categoryId, int $perPage = 2): LengthAwarePaginator
    {
        return Post::with('images')
            ->where('category_id', $categoryId)
            ->paginate($perPage);
    }

    public function getBySlugs(string $categorySlug, string $postSlug): Post
    {
        return Post::where('slug', $postSlug)
            ->whereHas('category', fn($query) => $query->where('slug', $categorySlug))
            ->with(['category', 'images'])
            ->firstOrFail();
    }
}
