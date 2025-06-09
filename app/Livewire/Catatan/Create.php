<?php

namespace App\Livewire\Catatan;

use App\Livewire\Traits\Alert;
use App\Models\Catatan;
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

    public Catatan $catatan;

    public bool $modal = false;

    public $status;
    public $type;
    public $categories;
    public $tags = [];
    public $tanggal;
    #[Validate('required')]
    public $target;
    #[Validate('required')]
    public $collected;

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


    public function mount(): void
    {
        $this->catatan = new Catatan();
    }

    public function render(): View
    {
        return view('livewire.catatan.create');
    }

    public function rules(): array
    {
        return [
            'catatan.title' => [
                'required',
                'string',
                'max:255'
            ],
            'catatan.slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('catatans', 'slug'),
            ],
            'catatan.catatan' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $images = [];

        if ($this->images != null) {
            foreach ($this->images as $key => $image) {
                Storage::disk('public')->putFile('catatan', $image);
                $images[] = Storage::disk('public')->putFile('catatan', $image);
            }

            $this->catatan->images = $images;
        } else {
            if ($this->catatan->images == null) {
                $this->catatan->images = [];
            }
        }

        $this->catatan->status = $this->status ?? $this->catatan->status;
        $this->catatan->type = $this->type ?? $this->catatan->type;
        $this->catatan->categories = $this->categories ?? $this->catatan->categories;
        $this->catatan->tags = $this->tags ?? $this->catatan->tags;
        $this->catatan->tanggal = $this->tanggal ?? $this->catatan->tanggal;
        $this->catatan->target = Str::replace('.', '', $this->target) ?? $this->catatan->target;
        $this->catatan->collected = Str::replace('.', '', $this->collected) ?? $this->catatan->collected;

        $this->catatan->save();

        $this->dispatch('created');

        $this->reset();
        $this->catatan = new Catatan();

        $this->success();
    }
}
