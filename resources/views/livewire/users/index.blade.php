<div>
    <x-alert color="amber" icon="light-bulb">
        Remember to take a look at the source code to understand how the components in this area were built and are being used.
    </x-alert>

    <div class="mb-2 mt-4 grid grid-cols-2">
        <div class="text-xl font-bold text-primary-800 dark:text-primary-50">
            Users
        </div>
        <div class="flex justify-end space-x-2 items-center">
            <livewire:users.create @created="$refresh" />
            <x-dropdown>
                <x-slot:action>
                    <x-button x-on:click="show = !show" icon="list-bullet" color="yellow" light></x-button>
                </x-slot:action>
                <x-dropdown.items icon="clock" text="Bulk Age" wire:click="bulkAge()" />
                <x-dropdown.items icon="trash" text="Bulk Delete" wire:click="bulkDelete()" separator/>
            </x-dropdown>
        </div>
    </div>

    <x-table :$headers :$sort :rows="$this->rows" paginate persistent filter striped loading selectable wire:model="selected">
        @interact('column_action', $row)
            <x-dropdown position="left">
                <x-slot:action>
                    <x-button x-on:click="show = !show" sm outline icon="ellipsis-vertical" color="white"></x-button>
                </x-slot:action>
                <div class="flex flex-nowrap p-2 gap-2">
                        <livewire:users.update :user="$row" :key="uniqid()" @updated="$refresh" />
                        <livewire:users.delete :user="$row" :key="uniqid()" @deleted="$refresh" />
                </div>
            </x-dropdown>
        @endinteract
        @interact('column_photo', $row)
        @if ($row->photo)
            <img src="{{ url('storage/'.$row->photo) }}" alt="photo" class="object-cover size-[50px] rounded-full">
        @endif
        @endinteract
        @interact('column_created_at', $row)
            {{ $row->created_at->diffForHumans() }}
        @endinteract
                @interact('column_date_active', $row)
        @if ($row->date_active)
            <x-badge text="{{ $row->date_active[0] }}" color="cyan" light /> s.d <x-badge text="{{ $row->date_active[1] }}" color="cyan" light />
        @endif
        @endinteract
    </x-table>
</div>
