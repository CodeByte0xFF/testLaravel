<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function index(Request $request): View
    {
        $category = Category::where('slug', $request->categorySlug)
            ->with('posts')
            ->firstOrFail();

        return view('categories.index', compact('category'));
    }
}
