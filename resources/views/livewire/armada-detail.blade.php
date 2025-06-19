<div class="md:space-y-6 space-y-3 max-w-2xl mx-auto pb-10">

    @php
    foreach ( $armada->images as $image) {
        $imgArmd[] = [
            'src' => Str::replace('%2F', '/',url('storage', $image)),
            'alt' => 'armada',
        ];
    }
    // dd($imgArmd);
    @endphp

    <div class="bg-white rounded-xl">
        @if (count($imgArmd) == 1)
            <x-carousel autoplay stop-on-hover without-indicators
            :images="$imgArmd"
            />
        @else
            <x-carousel autoplay stop-on-hover
            :images="$imgArmd"
            />
        @endif
    </div>
    <div class="bg-white rounded-xl min-h-40 p-3">
        <div class="dark:text-primary-900 text-2xl mb-2">{{ $armada->name }}</div>
        <p class="text-primary-500">{{ $armada->description	 }}</p>
        <div class="dark:text-primary-700 mt-2">
            <x-badge text="{{ $armada->type }}" color="red" outline xs/>
            <x-badge text="{{ $armada->categories }}" color="blue" outline xs/>
            @foreach ($armada->tags as $tag)
            <x-badge text="{{ $tag }}" color="lime" outline xs/>
            @endforeach
        </div>
    </div>

    <div class="bg-white rounded-xl min-h-40 p-3 space-y-4">
        <div class="text-xl text-center font-bold">Formulir Penjadwalan</div>
        <div class="grid xs:grid-cols-2 grid-cols-1 w-full gap-2">
            <x-input wire:model.live="nama" label="Nama"/>
            <x-input type="number" wire:model.live="noWA" label="No. Whatsapp"/>
        </div>
        <div class="grid xs:grid-cols-2 grid-cols-1 w-full gap-2">
            <x-input type="datetime-local" wire:model.live="tglAwal" label="Tanggal Awal" />
            <x-input type="datetime-local" wire:model.live="tglAkhir" label="Tanggal Akhir" />
        </div>
        <x-input wire:model.live="tujuan" label="Tujuan"/>

        <div class="mb-1">Pilih Kontak</div>
        <ul class="grid xs:grid-cols-2 grid-cols-1 w-full gap-2">
            <li class="group">
                <input  wire:model.live='cust_service' class="hidden peer" id="CS01" required="" type="radio" value="6285183059925" />
                <label class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:group-hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 group-hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:group-hover:bg-gray-700" for="CS01">
                    <div class="block">
                        <div class="relative z-10 w-full pr-1 text-xl font-semibold bg-white rounded-sm dark:bg-gray-800 dark:group-hover:bg-gray-700 xs:text-lg group-hover:bg-gray-100">
                            Fani - Admin
                        </div>
                    </div>
                    <span style="scale: 2; margin-right:0.5rem;"><x-icon name="user" class="size-4" /></span>
                </label>
                </input>
            </li>
            <li class="group">
                <input wire:model.live='cust_service' class="hidden peer" id="CS02" type="radio" value="6283820634317">
                <label class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:group-hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 group-hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:group-hover:bg-gray-700" for="CS02">
                    <div class="block">
                        <div class="relative z-10 w-full pr-1 text-xl font-semibold bg-white rounded-sm dark:bg-gray-800 dark:group-hover:bg-gray-700 xs:text-lg group-hover:bg-gray-100">
                            Yuri - Driver
                        </div>
                    </div>
                    <span style="scale: 2; margin-right:0.5rem;"><x-icon name="users" class="size-4" /></span>
                </label>
                </input>
            </li>
        </ul>
        <div class="font-mono mt-4 text-sm">*lengkapi data di atas dan tekan Ajukan</div>
    </div>

    @php
    $textPesan = "Halo AMAZAV%0D%0ASaya *".Str::title($this->nama)."* ingin melakukan booking armada :  %0D%0A_".$armada->name."_ %0D%0A%0D%0Apada : %0D%0A".$hariAwl." ".date('d-M-Y H:i', strtotime($this->tglAwal))." s.d %0D%0A".$hariAkh." ".date('d-M-Y H:i', strtotime($this->tglAkhir))."%0D%0A%0D%0ATujuan : %0D%0A*".Str::title($this->tujuan)."* %0D%0A%0D%0AHub saya kembali : ".$this->noWA;
    @endphp

    @if ($nama == null || $noWA == null || $tglAwal == null || $tglAkhir == null || $tujuan == null || $cust_service == null)        
    <div class="w-full ">
        <x-button text="Ajukan Sekarang" color="gray" light class="w-full" />
    </div>
    @else
    <div class="w-full">
        <a href="https://wa.me/{{ $this->cust_service }}?text={{ $textPesan }}"  target="_blank"><x-button text="Ajukan Sekarang" color="green" light class="w-full" /></a>
    </div>
    @endif
</div>
