<?php

namespace App\Orchid\Screens\Post;

use App\Orchid\Layouts\Post\PostListLayout;
use App\Services\CategoryService;
use App\Services\PostService;
use Orchid\Screen\Screen;

class PostListScreen extends Screen
{
    public string $categorySlug;

    protected CategoryService $categoryService;
    protected PostService $postService;

    public function __construct(CategoryService $categoryService, PostService $postService)
    {
        $this->categorySlug = request()->route('category_slug');
        $this->categoryService = $categoryService;
        $this->postService = $postService;
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        $category = $this->categoryService->getBySlug($this->categorySlug);

        $posts = $this->postService->getByCategory($category->id, 2);

        return [
            'category' => $category,
            'posts' => $posts
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список постов';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            PostListLayout::class,
        ];
    }
}
