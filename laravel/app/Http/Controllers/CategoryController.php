<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $categoryService,
        protected PostService $postService
    ) {}

    public function index(Request $request): View
    {
        $categories = $this->categoryService->getAll();
        $currentCategory = $this->categoryService->getBySlug($request->categorySlug);
        $posts = $this->postService->getByCategory($currentCategory->id);

        return view('categories.index', compact('categories', 'currentCategory', 'posts'));
    }
}
