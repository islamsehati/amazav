<div class="md:space-y-6 space-y-3 max-w-2xl mx-auto">

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
        <div class="font-mono mt-4 text-sm">lengkapi data diatas dan tekan Ajukan</div>
    </div>

    @php
    $textPesan = "Halo AMAZAV%0D%0ASaya *".Str::title($this->nama)."* ingin melakukan booking _".$armada->name."_ pada ".date('l d-M-Y H:i a', strtotime($this->tglAwal))." s.d ".date('l d-M-Y H:i a', strtotime($this->tglAkhir))." tujuan *".Str::title($this->tujuan)."* %0D%0A%0D%0AHub saya kembali : ".$this->noWA;
    @endphp

    @if ($nama == null || $noWA == null || $tglAwal == null || $tglAkhir == null || $tujuan == null)        
    <div class="w-full ">
        <x-button text="Ajukan Sekarang" color="gray" light class="w-full" />
    </div>
    @else
    <div class="w-full ">
        <a href="https://wa.me/6285950540055?text={{ $textPesan }}"  target="_blank"><x-button text="Ajukan Sekarang" color="green" light class="w-full" /></a>
    </div>
    @endif
</div>
