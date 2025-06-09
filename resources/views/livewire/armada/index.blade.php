<div>
    {{-- <x-alert color="amber" icon="light-bulb">
        Remember to take a look at the source code to understand how the components in this area were built and are being used.
    </x-alert> --}}

    <div class="mb-2 mt-4 grid grid-cols-2">
        <div class="text-xl font-bold text-primary-800 dark:text-primary-50">
            Armada
        </div>
        <div class="flex justify-end space-x-2 items-center">
            <a href="{{ route('armada.create') }}"><x-button color="teal" icon="plus" /></a>
            <x-dropdown>
                <x-slot:action>
                    <x-button x-on:click="show = !show" icon="list-bullet" color="yellow" light></x-button>
                </x-slot:action>
                <x-dropdown.items icon="clock" text="Bulk Open" wire:click="bulkStatusOpen()" />
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
                    <a href="{{ route('armada.show', ['armadaid' => $row->id]) }}"><x-button  sm color="yellow" icon="pencil" /></a>
                    <livewire:armada.delete :armada="$row" :key="uniqid()" @deleted="$refresh" />
                </div>
            </x-dropdown>
        @endinteract
        @interact('column_images', $row)
        @if ($row->images)
            <div class="flex flex-nowrap -space-x-2">
                @foreach (Arr::take($row->images, 3) as $image)
                <img src="{{ url('storage/'.$image) }}" alt="images" class="object-cover size-[30px] rounded-full">
                @endforeach
            </div>
        @endif
        @endinteract
        @interact('column_tags', $row)
        @if ($row->tags)
            <div class="flex flex-nowrap space-x-2">
                @foreach (Arr::take($row->tags, 3) as $tag)
                <x-badge text="{{ $tag }}" color="cyan" light />
                @endforeach
            </div>
        @endif
        @endinteract

        @interact('column_price', $row)
            <span class="flex justify-end">@currency($row->price)</span>
        @endinteract


        {{-- <x-slot:footer>
            <table class="w-full text-black dark:text-white my-3 rounded-md outline-2 shadow-sm bg-white outline-primary-200 dark:bg-slate-700 dark:outline-slate-600" >
                <tr class=" ">
                    <td class="p-2 w-2"></td>
                    <td class="p-2">TOTAL</td>
                    <td class="p-2 text-right w-5">@currency($sum_price)</td>
                    <td class="p-2 w-2 text-right"></td>
                  </tr>
            </table>
        </x-slot:footer> --}}
    </x-table>

</div>
