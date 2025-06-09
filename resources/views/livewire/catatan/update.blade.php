<div>
    <x-button sm color="yellow" icon="pencil" wire:click="$toggle('modal')" />

    <x-modal :title="__('Update Catatan: #:id', ['id' => $catatan->id])" wire>
        <form id="catatan-update-{{ $catatan->id }}" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="Judul *" x-ref="title" wire:model="catatan.title" required />
            </div>

            <div>
                <x-input label="Slug *" wire:model="catatan.slug" required />
            </div>

            <div>
                <x-input label="Catatan *" wire:model="catatan.catatan" required />
            </div>

            <x-select.styled label="Status" wire:model="status"
                 placeholder="Custom Placeholder"
                 hint="You can choose baru, proses, selesai or gagal"
                 :options="['baru', 'proses', 'selesai', 'gagal']" />

            <x-select.styled label="Type" wire:model="type"
                 placeholder="Custom Placeholder"
                 :options="['ziswaf', 'program', 'qurban']" />

            <x-select.styled label="Categories" wire:model="categories" searchable
                 placeholder="Custom Placeholder"
                 :options="['waqaf', 'pendidikan', 'kambing', 'domba', 'sapi']" />

            <x-tag label="Tags" hint="Tambahkan Tag" wire:model="tags" />

            <div>   
                <x-date multiple label="Tanggal *" wire:model="tanggal" />
            </div>

            <div>   
                <x-input type="alfanumeric" wire:model="target" label="Target" prefix="Rp" x-mask:dynamic="$money($input, ',', '.')" />
            </div>
            <div>   
                <x-input type="alfanumeric" wire:model="collected" label="Collected" prefix="Rp" x-mask:dynamic="$money($input, ',', '.')" />
            </div>

            <div>
                <x-upload delete multiple label="Images" wire:model="images" hint="We need to analyze your images" tip="Drag and drop your images here" />
            </div>
            {{-- <div wire:click="resetUpload()" class="mx-auto text-center text-red-400 cursor-pointer "><x-badge text="reset upload images" color="red" outline /></div> --}}
            <div>
                @if ($catatan->images != null)
                <div class="flex flex-wrap gap-3">
                    @foreach ($catatan->images as $image)
                    <img src="{{ url('storage/'.$image) }}" alt="images" class="object-cover text-center mx-auto size-[120px] rounded-lg">
                    @endforeach
                </div>
                @else
                    <img src="{{ url('storage/avatars/user.png') }}" alt="images" class="object-cover text-center mx-auto size-[200px] rounded-lg">
                @endif
            </div>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="catatan-update-{{ $catatan->id }}">
                Save
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
