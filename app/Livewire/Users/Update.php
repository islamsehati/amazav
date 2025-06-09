<?php

namespace App\Livewire\Users;

use App\Livewire\Traits\Alert;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class Update extends Component
{
    use Alert, WithFileUploads;

    public User $user;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public $date_active;

    // For multiple files the property must be an array 
    // #[Validate('image|max:1024|mimes:png,jpg,jpeg|nullable')] // 1MB Max
    #[Validate(['photo.*' => 'image|max:2048|mimes:png,jpg,jpeg|nullable'])]
    public $photo;

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

        if (! $this->photo) {
            return;
        }

        $files = Arr::wrap($this->photo);

        /** @var UploadedFile $file */
        $file = collect($files)->filter(fn(UploadedFile $item) => $item->getFilename() === $content['temporary_name'])->first();

        // 1. Here we delete the file. Even if we have a error here, we simply
        // ignore it because as long as the file is not persisted, it is
        // temporary and will be deleted at some point if there is a failure here.
        rescue(fn() => $file->delete(), report: false);

        $collect = collect($files)->filter(fn(UploadedFile $item) => $item->getFilename() !== $content['temporary_name']);

        // 2. We guarantee restore of remaining files regardless of upload
        // type, whether you are dealing with multiple or single uploads
        $this->photo = is_array($this->photo) ? $collect->toArray() : $collect->first();
    }

    public function mount()
    {

        $this->date_active = $this->user->date_active;
    }

    public function render(): View
    {

        return view('livewire.users.update',);
    }

    public function rules(): array
    {
        return [
            'user.name' => [
                'required',
                'string',
                'max:255'
            ],
            'user.email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],
            'user.age' => [
                'required',
                'integer',
                'min:17',
            ],
            'user.skill' => [
                'required',
            ],
            'date_active' => [
                'nullable',
            ],
            'photo' => [
                'nullable',
            ],
        ];
    }

    // public function resetUpload()
    // {
    //     $this->reset('photo');
    // }


    public function save(): void
    {
        $this->validate();

        if ($this->photo != null) {
            Storage::disk('public')->putFile('avatars', $this->photo);
            $photo = Storage::disk('public')->putFile('avatars', $this->photo);
            $this->user->photo = $photo;
        } else {
            $this->user->photo = $this->user->photo;
        }

        $this->user->date_active = $this->date_active ?? $this->user->date_active;
        $this->user->password = when($this->password !== null, bcrypt($this->password), $this->user->password);
        $this->user->update();

        $this->dispatch('updated');

        $this->resetExcept('user');

        $this->success();
    }
}
