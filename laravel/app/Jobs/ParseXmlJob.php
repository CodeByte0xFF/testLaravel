<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Str;

class ParseXmlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(): void
    {
        $xml = simplexml_load_file($this->filePath);

        foreach ($xml as $item) {

            $name = (string)$item->Category->Name;

            $category = Category::firstOrCreate(
                ['title' => $name,],
                ['slug' => Str::slug($name),],
            );

            $elements = $item->Category->Elements->children();

            foreach ($elements as $element) {

                $postTitle = (string)$element->Name;
                $postDescription = (string)$element->Description;

                $post = $category->posts()->firstOrCreate(
                    ['slug' => Str::slug($postTitle)],
                    [
                        'title' => $postTitle,
                        'description' => $postDescription,
                    ]
                );

                $pictKey = 1;
                while (property_exists($element, "Pict$pictKey")) {
                    $pict = (string)($element->{"Pict$pictKey"} ?? '');

                    if ($pict) {
                        if (!$post->images()->where('path', $pict)->exists()) {
                            $post->images()->firstOrCreate([
                                'path' => $pict
                            ]);
                        }
                    }
                    $pictKey++;
                }
            }
        }
    }
}

