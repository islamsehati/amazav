<div class="max-w-2xl mx-auto">
    <x-card>
        <x-slot:header>
            Tambah Armada
        </x-slot:header>
         <form id="armada-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="Nama *" x-ref="name" wire:model="name" required />
            </div>

            <div>
                <x-input label="Slug *" wire:model="slug" required />
            </div>

            <div>
                <x-input label="Deskripsi *" wire:model="description" required />
            </div>

            <x-select.styled label="Status" wire:model="status"
                 placeholder="Custom Placeholder"
                 hint="Pilih status armada"
                 :options="['open', 'on_duty', 'maintenance', 'close', 'non-active']" />

            <x-select.styled label="Type" wire:model="type"
                 placeholder="Custom Placeholder"
                 :options="['M/T', 'A/T']" />

            <x-select.styled label="Categories" wire:model="categories" searchable
                 placeholder="Custom Placeholder"
                 :options="['MPV', 'SUV', 'Hatchback', 'Sedan', 'Commercial']" />

            <x-tag label="Tags" hint="Tambahkan Tag" wire:model="tags" />

            <div>   
                <x-input type="alfanumeric" wire:model="price" label="Harga" prefix="Rp" x-mask:dynamic="$money($input, ',', '.')" />
            </div>

            <div>
                <x-upload delete multiple label="Images" wire:model="images" hint="We need to analyze your images" tip="Drag and drop your images here" />
            </div>
            {{-- <div>
                @if ($armada->images != null)
                <div class="flex flex-wrap gap-3">
                    @foreach ($armada->images as $image)
                    <img src="{{ url('storage/'.$image) }}" alt="images" class="object-cover text-center mx-auto size-[120px] rounded-lg">
                    @endforeach
                </div>
                @else
                    <img src="{{ url('storage/avatars/user.png') }}" alt="images" class="object-cover text-center mx-auto size-[200px] rounded-lg">
                @endif
            </div> --}}
        </form>
        <x-slot:footer>
            <x-button type="submit" form="armada-create">
                Save
            </x-button>
        </x-slot:footer>
    </x-card>
</div>
