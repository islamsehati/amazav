<?php

namespace App\Livewire\Armada;

use App\Livewire\Traits\Alert;
use App\Models\Armada;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use Alert, WithFileUploads;

    public Armada $armada;

    public $name;
    public $slug;
    public $description;
    public $status;
    public $type;
    public $categories;
    public $tags = [];
    public $price;

    // For multiple files the property must be an array 
    // #[Validate('image|max:1024|mimes:png,jpg,jpeg|nullable')] // 1MB Max
    #[Validate(['images.*' => 'image|max:2048|mimes:png,jpg,jpeg|nullable'])]
    public $images = [];

    // 1. We create a property that will temporarily store the uploaded files
    public $backup = [];

    public function updatingPhotos(): void
    {
        // 2. We store the uploaded files in the temporary property
        $this->backup = $this->images;
    }

    public function updatedPhotos(): void
    {
        if (!$this->images) {
            return;
        }

        // 3. We merge the newly uploaded files with the saved ones
        $file = Arr::flatten(array_merge($this->backup, [$this->images]));

        // 4. We finishing by removing the duplicates
        $this->images = collect($file)->unique(fn(UploadedFile $item) => $item->getClientOriginalName())->toArray();
    }

    public function deleteUpload(array $content): void
    {
        /*
        the $content contains:
        [
            'temporary_name',
            'real_name',
            'extension',
            'size',
            'path',
            'url',
        ]
        */

        if (! $this->images) {
            return;
        }

        $files = Arr::wrap($this->images);

        /** @var UploadedFile $file */
        $file = collect($files)->filter(fn(UploadedFile $item) => $item->getFilename() === $content['temporary_name'])->first();

        // 1. Here we delete the file. Even if we have a error here, we simply
        // ignore it because as long as the file is not persisted, it is
        // temporary and will be deleted at some point if there is a failure here.
        rescue(fn() => $file->delete(), report: false);

        $collect = collect($files)->filter(fn(UploadedFile $item) => $item->getFilename() !== $content['temporary_name']);

        // 2. We guarantee restore of remaining files regardless of upload
        // type, whether you are dealing with multiple or single uploads
        $this->images = is_array($this->images) ? $collect->toArray() : $collect->first();
    }


    public function render()
    {
        return view('livewire.armada.create');
    }

    public function save()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:armadas',
            'description' => 'required|string',
            'price' => 'required',
        ]);
        $armada = new Armada();

        $images = [];

        if ($this->images != null) {
            foreach ($this->images as $key => $image) {
                Storage::disk('public')->putFile('armada', $image);
                $images[] = Storage::disk('public')->putFile('armada', $image);
            }

            $armada->images = $images;
        } else {
            $armada->images = [];
        }

        $armada->name = $this->name;
        $armada->slug = $this->slug;
        $armada->description = $this->description;
        $armada->status = $this->status;
        $armada->type = $this->type;
        $armada->categories = $this->categories;
        $armada->tags = $this->tags;
        $armada->price = Str::replace('.', '', $this->price);

        $armada->save();

        $this->toast()->success('Berhasil', 'Data baru dibuat')->send();

        $this->redirect('/armada', navigate: true);
    }
}
