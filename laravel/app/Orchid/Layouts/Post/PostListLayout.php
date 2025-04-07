<?php

namespace App\Orchid\Layouts\Post;

use App\Models\Post;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PostListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'posts';

    /**
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', 'Заголовок поста')
                ->render(function (Post $post) {
                    return Link::make($post->title)
                        ->route('platform.posts.list', [
                            'category_slug' => $post->category->slug,
                            'post_slug' => $post->slug,
                        ])
                        ->icon('pencil');
                }),

            TD::make('created_at', 'Дата создания')
                ->render(fn(Post $post) => $post->created_at->format('d.m.Y')),

            TD::make('actions', 'Действия')
                ->render(function (Post $post) {
                    return Link::make('Просмотреть')
                        ->route('platform.posts.list', [
                            'category_slug' => $post->category->slug,
                            'post_slug' => $post->slug,
                        ])
                        ->icon('eye');
                }),
        ];
    }
}
