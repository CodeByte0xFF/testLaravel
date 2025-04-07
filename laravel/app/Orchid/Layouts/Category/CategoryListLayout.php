<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    public $target = 'categories';

    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Название категории')
                ->render(function (Category $category) {
                    return Link::make($category->title)
                        ->route('platform.posts.list', ['category_slug' => $category->slug]);
                }),

            TD::make('posts_count', 'Кол-во постов')
                ->render(fn(Category $category) => $category->posts_count),
        ];
    }
}
