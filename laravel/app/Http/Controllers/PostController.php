<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected PostService $postService
    ) {}

    public function index(Request $request): View
    {
        $categories = $this->categoryService->getAll();

        $post = $this->postService->getBySlugs(
            $request->categorySlug,
            $request->postSlug
        );

        return view('posts.index', compact('categories', 'post'));
    }
}
