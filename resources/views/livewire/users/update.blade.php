<div>
    <x-button sm color="yellow" icon="pencil" wire:click="$toggle('modal')" />

    <x-modal :title="__('Update User: #:id', ['id' => $user->id])" wire>
        <form id="user-update-{{ $user->id }}" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="Name *" wire:model="user.name" required />
            </div>

            <div>
                <x-input label="Email *" wire:model="user.email" required />
            </div>

            <div>
                <x-password label="Password"
                            hint="The password will only be updated if you set the value of this field"
                            wire:model="password"
                            rules
                            generator
                            x-on:generate="$wire.set('password_confirmation', $event.detail.password)" />
            </div>

            <div>
                <x-password label="Password" wire:model="password_confirmation" rules />
            </div>

            <div>
                <x-number label="Age *" wire:model="user.age" required centralized/>
            </div>
            <div>
                <x-select.styled :options="[
                    ['label' => 'TALL', 'value' => 1],
                    ['label' => 'LIVT', 'value' => 2],
                    ['label' => 'LARAVEL', 'value' => 3],
                    ['label' => 'LIVEWIRE', 'value' => 4],
                    ['label' => 'VOLT', 'value' => 5],
                ]" searchable multiple
                :placeholders="[
                    'default' => 'Pilih Skill',
                    'search'  => 'Cari',
                    'empty'   => 'Wajib isi',
                ]"
                label="Skill *" wire:model="user.skill" />
            </div>
            <div>   
                <x-date range label="Date Active *" wire:model="date_active" 
                />
            </div>
            <div>
                <x-upload delete label="Photo" wire:model="photo" hint="We need to analyze your photo" tip="Drag and drop your photo here" />
            </div>
            {{-- <div wire:click="resetUpload()" class="mx-auto text-center text-red-400 cursor-pointer "><x-badge text="reset upload Photo" color="red" outline /></div> --}}
            <div>
                @if ($user->photo != null)
                <div class="flex flex-wrap gap-3">
                    <img src="{{ url('storage/'.$user->photo) }}" alt="avatar" class="object-cover text-center mx-auto size-[120px] rounded-lg">
                </div>
                @else
                    <img src="{{ url('storage/avatars/user.png') }}" alt="avatar" class="object-cover text-center mx-auto size-[200px] rounded-lg">
                @endif
            </div>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="user-update-{{ $user->id }}">
                Save
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
