<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

use App\Services\CategoryService;

class HomeController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index(): View
    {
        $categories = $this->categoryService->getAll();
        return view('home', compact('categories'));
    }
}
