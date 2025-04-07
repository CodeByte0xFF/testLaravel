<?php
namespace App\Orchid\Screens\Upload;

use App\Models\Category;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use App\Jobs\ParseXmlJob;
use Str;

class UploadXmlScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    public function name(): ?string
    {
        return 'Импорт XML';
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('raw_file')
                    ->type('file')
                    ->title('Выберите файл, максимальный размер 2 МБ')
                    ->accept('.xml')
                    ->vertical(),

                Button::make('Default')->method('import')->type(Color::BASIC)->name('Импортировать'),
            ])
        ];
    }

    /**
     * @param Request $request
     * @return void
     */
    public function import(Request $request): void
    {
        $file = $request->file('raw_file');

        if (!$file) {
            Toast::error('Файл не выбран', 'error');
            return;
        }

        if ($file->getClientOriginalExtension() !== 'xml') {
            Toast::error('Файл должен быть в формате XML');
            return;
        }

        $path = $file->store('uploads/xml', 'public');
        $fullPath = storage_path("app/public/{$path}");

        ParseXmlJob::dispatch($fullPath);

        Toast::info('Файл принят, обработка начата', 'success');
    }
}
