<?php

namespace App\Orchid\Screens\Category;

use App\Orchid\Layouts\Category\CategoryListLayout;
use App\Services\CategoryService;
use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return iterable
     */
    public function query(): iterable
    {
        return [
            'categories' => $this->categoryService->getAll()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Категории';
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
            CategoryListLayout::class,
        ];
    }
}
