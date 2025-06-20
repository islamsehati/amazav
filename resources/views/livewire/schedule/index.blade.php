<div>
    {{-- <x-alert color="amber" icon="light-bulb">
        Remember to take a look at the source code to understand how the components in this area were built and are being used.
    </x-alert> --}}


    <div class="mb-2 mt-4 grid grid-cols-2">
        <div class="text-xl font-bold text-primary-800 dark:text-primary-50">
            Jadwal
        </div>
        <div class="flex justify-end space-x-2 items-center">
            {{-- <livewire:schedule.create @created="$refresh" /> --}}
            <x-dropdown>
                <x-slot:action>
                    <x-button x-on:click="show = !show" icon="list-bullet" color="yellow" light></x-button>
                </x-slot:action>
                <x-dropdown.items icon="clock" text="Bulk Selesai" wire:click="bulkStatusSelesai()" />
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
                    {{-- <a href="{{ route('schedule.show', ['scheduleid' => $row->id]) }}"><x-button  sm color="yellow" icon="pencil" /></a> --}}
                        {{-- <livewire:schedule.update :schedule="$row" :key="uniqid()" @updated="$refresh" /> --}}
                        {{-- <livewire:schedule.delete :schedule="$row" :key="uniqid()" @deleted="$refresh" /> --}}
                </div>
            </x-dropdown>
        @endinteract
        @interact('column_harga', $row)
            <span class="flex justify-end">@currency($row->target)</span>
        @endinteract
        @interact('column_narahubung', $row, $userAll)
            <span>{{ $userAll->find($row->narahubung)->name }}</span>
        @endinteract


        {{-- <x-slot:footer>
            <table class="w-full text-black dark:text-white my-3 rounded-md outline-2 shadow-sm bg-white outline-primary-200 dark:bg-slate-700 dark:outline-slate-600" >
                <tr class=" ">
                    <td class="p-2 w-2"></td>
                    <td class="p-2">TOTAL</td>
                    <td class="p-2 text-right w-5">@currency($sum_target)</td>
                    <td class="p-2 text-right w-5">@currency($sum_collected)</td>
                    <td class="p-2 w-2 text-right"></td>
                  </tr>
            </table>
        </x-slot:footer> --}}
    </x-table>

</div>
