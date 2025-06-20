<div class="md:space-y-6 space-y-3 max-w-2xl mx-auto xs:pb-10 pb-72">

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

    <form id="jadwal-create" wire:submit="buatjadwal">
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
                <label class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:group-hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 group-hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:group-hover:bg-gray-700" for="CS01">
                    <div class="block">
                        <div class="relative z-10 w-full pr-1 text-xl font-semibold bg-white rounded-sm dark:bg-gray-800 dark:group-hover:bg-gray-700 xs:text-lg group-hover:bg-gray-100">
                            Fani - Admin
                        </div>
                    </div>
                    <span style="scale: 2; margin-right:0.5rem;">
                        <svg class="size-4" fill="currentColor" height="800px" width="800px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                viewBox="0 0 512 512" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M442.433,274.634c19.101,0,34.641-15.54,34.641-34.641V171.74c0-16.355-11.397-30.09-26.665-33.703
                                        c-13.248-37.843-37.764-71.676-69.849-96.092C344.499,14.505,301.427,0,256,0s-88.498,14.505-124.559,41.945
                                        c-32.086,24.416-56.602,58.248-69.851,96.092c-15.267,3.614-26.665,17.348-26.665,33.703v68.252
                                        c0,19.101,15.54,34.641,34.641,34.641h26.192v62.775c-33.787,18.6-56.735,54.556-56.735,95.775V512h433.952v-78.817
                                        c0-41.218-22.948-77.174-56.735-95.775v-62.775H442.433z M149.861,66.151c30.72-23.378,67.423-35.734,106.14-35.734
                                        s75.419,12.356,106.141,35.734c24.223,18.433,43.388,43.148,55.298,70.949h-16.723C374.934,83.059,319.759,45.626,256,45.626
                                        S137.067,83.059,111.285,137.1H94.561C106.472,109.299,125.638,84.584,149.861,66.151z M385.743,210.206
                                        c-0.012,0.364-0.026,0.727-0.042,1.091c-0.055,1.324-0.126,2.646-0.22,3.962c-0.009,0.119-0.014,0.239-0.022,0.358
                                        c-0.109,1.458-0.246,2.911-0.405,4.358c-0.03,0.281-0.064,0.56-0.096,0.841c-0.151,1.309-0.319,2.613-0.509,3.912
                                        c-0.022,0.154-0.042,0.308-0.065,0.462c-0.216,1.439-0.457,2.871-0.72,4.297c-0.048,0.255-0.098,0.511-0.147,0.766
                                        c-0.229,1.203-0.477,2.402-0.739,3.596c-0.061,0.277-0.119,0.555-0.18,0.829c-0.301,1.328-0.625,2.649-0.967,3.964
                                        c-0.103,0.395-0.214,0.788-0.32,1.182c-0.247,0.914-0.505,1.822-0.772,2.727c-0.156,0.53-0.31,1.062-0.474,1.59
                                        c-0.294,0.953-0.602,1.9-0.918,2.844c-0.311,0.929-0.634,1.852-0.965,2.771c-0.133,0.369-0.266,0.737-0.401,1.104
                                        c-3.131,8.448-7.12,16.48-11.856,23.998l-70.266,0.448c-5.582-10.919-16.937-18.416-30.018-18.416h-19.28
                                        c-18.581,0-33.697,15.117-33.697,33.698c0,18.582,15.116,33.698,33.697,33.698h19.28c13.14,0,24.54-7.565,30.094-18.564
                                        l43.462-0.277c-22.546,18.868-51.565,30.244-83.195,30.244c-55.774,0-103.442-35.355-121.78-84.829
                                        c-0.136-0.367-0.269-0.736-0.401-1.104c-0.332-0.92-0.654-1.842-0.965-2.771c-0.315-0.944-0.624-1.891-0.918-2.844
                                        c-0.163-0.527-0.317-1.058-0.474-1.59c-0.267-0.905-0.525-1.815-0.772-2.727c-0.106-0.394-0.217-0.787-0.32-1.182
                                        c-0.343-1.315-0.665-2.635-0.967-3.964c-0.063-0.276-0.12-0.554-0.181-0.829c-0.263-1.193-0.51-2.392-0.739-3.596
                                        c-0.049-0.255-0.1-0.51-0.147-0.766c-0.263-1.426-0.505-2.858-0.72-4.297c-0.023-0.153-0.043-0.308-0.065-0.462
                                        c-0.19-1.299-0.358-2.603-0.509-3.912c-0.032-0.28-0.066-0.56-0.096-0.841c-0.157-1.448-0.295-2.9-0.405-4.358
                                        c-0.009-0.119-0.014-0.238-0.022-0.358c-0.095-1.316-0.165-2.638-0.22-3.962c-0.015-0.363-0.029-0.727-0.042-1.091
                                        c-0.048-1.443-0.08-2.888-0.08-4.339c0-1.087,0.014-2.171,0.043-3.28l0.047-1.279c0.021-0.647,0.042-1.293,0.073-1.924
                                        c0.014-0.275,0.031-0.549,0.049-0.822l0.032-0.528c0.036-0.614,0.072-1.23,0.118-1.842c0-0.006,0.001-0.012,0.001-0.017
                                        c0.025-0.35,0.057-0.698,0.087-1.046l0.056-0.641c0.045-0.513,0.086-1.028,0.137-1.54c0.042-0.409,0.087-0.815,0.133-1.223
                                        l0.039-0.356c0.039-0.348,0.078-0.695,0.12-1.042c0.019-0.169,0.036-0.335,0.059-0.507c0.06-0.481,0.125-0.959,0.191-1.438
                                        l0.028-0.207c0.01-0.078,0.022-0.157,0.032-0.235c0.059-0.427,0.117-0.855,0.179-1.281c0.079-0.525,0.163-1.047,0.243-1.545
                                        c0.002-0.01,0.003-0.02,0.005-0.029c9.141,1.657,18.438,2.497,27.789,2.497c37.26,0,72.377-12.979,100.362-36.828
                                        c27.987,23.849,63.102,36.828,100.362,36.828c9.351,0,18.648-0.841,27.789-2.497c0.084,0.526,0.169,1.052,0.25,1.592
                                        c0.084,0.563,0.161,1.128,0.237,1.693l0.005,0.039c0.064,0.47,0.128,0.94,0.186,1.408c0.065,0.523,0.122,1.049,0.18,1.575
                                        l0.049,0.439c0.044,0.38,0.086,0.76,0.124,1.144c0.016,0.159,0.028,0.32,0.043,0.48c0.034,0.358,0.065,0.716,0.095,1.074
                                        l0.053,0.602c0.03,0.344,0.061,0.686,0.085,1.012c0.049,0.657,0.086,1.317,0.126,1.976l0.028,0.455
                                        c0.016,0.258,0.033,0.515,0.047,0.791c0.042,0.843,0.071,1.688,0.096,2.536l0.024,0.669c0.027,1.089,0.042,2.181,0.042,3.277
                                        c0,0.008,0,0.015,0,0.023C385.824,207.317,385.792,208.763,385.743,210.206z M385.824,299.853v26.312
                                        c-4.494-0.925-9.053-1.559-13.661-1.91c-0.106-0.008-0.213-0.013-0.318-0.021c-0.783-0.058-1.566-0.109-2.352-0.15
                                        c-0.299-0.015-0.6-0.025-0.899-0.039c-0.599-0.026-1.198-0.052-1.8-0.069c-0.397-0.011-0.796-0.015-1.194-0.021
                                        c-0.403-0.007-0.804-0.019-1.208-0.021C372.354,316.624,379.53,308.549,385.824,299.853z M268.921,290.589
                                        c0,1.81-1.471,3.281-3.28,3.281h-19.28c-1.809,0-3.28-1.472-3.28-3.281c0-1.809,1.471-3.281,3.28-3.281h19.28
                                        C267.45,287.308,268.921,288.78,268.921,290.589z M298.002,360.547c-1.231,22.099-19.599,39.698-42.001,39.698
                                        s-40.77-17.599-42.001-39.698c0.038,0.01,0.075,0.018,0.113,0.028c1.48,0.401,2.968,0.774,4.459,1.132
                                        c0.442,0.106,0.886,0.208,1.329,0.31c1.192,0.275,2.388,0.536,3.587,0.784c0.388,0.08,0.775,0.164,1.163,0.241
                                        c1.54,0.306,3.084,0.591,4.635,0.851c0.293,0.05,0.587,0.091,0.881,0.139c1.285,0.208,2.572,0.401,3.864,0.577
                                        c0.461,0.063,0.924,0.125,1.386,0.183c1.306,0.167,2.616,0.318,3.928,0.454c0.282,0.029,0.563,0.064,0.845,0.091
                                        c1.086,0.105,2.175,0.196,3.264,0.28c0.1,0.008,0.2,0.017,0.3,0.025c0.386,0.029,0.774,0.057,1.161,0.083
                                        c0.407,0.027,0.813,0.049,1.221,0.073c0.369,0.022,0.738,0.047,1.108,0.066c0.208,0.011,0.414,0.026,0.622,0.038
                                        c0.654,0.032,1.31,0.054,1.966,0.078c0.453,0.017,0.907,0.035,1.362,0.049c0.253,0.007,0.505,0.02,0.758,0.026
                                        c1.347,0.033,2.698,0.052,4.052,0.052c1.354,0,2.704-0.018,4.052-0.052c0.253-0.006,0.505-0.019,0.758-0.026
                                        c0.454-0.013,0.907-0.031,1.362-0.049c0.655-0.024,1.312-0.046,1.966-0.078c0.208-0.01,0.414-0.026,0.622-0.038
                                        c0.37-0.02,0.739-0.044,1.108-0.066c0.407-0.024,0.814-0.045,1.221-0.073c0.387-0.026,0.775-0.054,1.161-0.083
                                        c0.1-0.008,0.2-0.017,0.3-0.025c1.09-0.084,2.178-0.174,3.264-0.28c0.282-0.027,0.563-0.063,0.845-0.091
                                        c1.312-0.135,2.622-0.287,3.928-0.454c0.462-0.059,0.925-0.121,1.386-0.183c1.291-0.176,2.578-0.369,3.864-0.577
                                        c0.294-0.048,0.588-0.089,0.881-0.139c1.55-0.261,3.094-0.545,4.635-0.851c0.388-0.077,0.776-0.161,1.163-0.241
                                        c1.198-0.247,2.394-0.508,3.587-0.784c0.443-0.102,0.887-0.204,1.329-0.31c1.491-0.358,2.979-0.73,4.459-1.132
                                        C297.925,360.565,297.964,360.557,298.002,360.547z M147.61,323.934c-0.404,0.002-0.805,0.015-1.208,0.021
                                        c-0.398,0.007-0.797,0.01-1.194,0.021c-0.6,0.016-1.199,0.043-1.799,0.069c-0.3,0.013-0.6,0.022-0.899,0.039
                                        c-0.786,0.041-1.57,0.092-2.352,0.149c-0.105,0.008-0.213,0.013-0.318,0.021c-4.61,0.352-9.169,0.988-13.662,1.911v-26.312
                                        C132.471,308.55,139.648,316.625,147.61,323.934z M136.285,155.647C155.958,108.927,202.21,76.043,256,76.043
                                        c53.661,0,99.821,32.726,119.573,79.266v0.361c-6.336,0.982-12.755,1.492-19.21,1.492c-33.987,0-65.756-13.434-89.455-37.83
                                        L256,108.103l-10.909,11.23c-23.698,24.395-55.467,37.83-89.455,37.83C149.132,157.162,142.666,156.643,136.285,155.647z
                                        M69.568,244.212v0.004c-2.329,0-4.224-1.895-4.224-4.224V171.74c0-2.329,1.895-4.224,4.224-4.224h30.842
                                        c-0.016,0.065-0.031,0.131-0.048,0.195c-0.924,3.766-1.712,7.582-2.364,11.445c-0.043,0.259-0.087,0.516-0.129,0.775l-0.027,0.167
                                        c-0.39,2.402-0.725,4.822-1.007,7.26c-0.019,0.17-0.041,0.341-0.059,0.512l-0.014,0.124c-0.074,0.66-0.15,1.32-0.215,1.982
                                        c0,0.002,0,0.004-0.001,0.007c-0.059,0.593-0.109,1.189-0.16,1.786l-0.04,0.464c-0.05,0.593-0.103,1.185-0.147,1.779
                                        c-0.043,0.585-0.078,1.172-0.115,1.759l-0.053,0.86c0,0.008-0.001,0.016-0.001,0.023c-0.024,0.428-0.053,0.856-0.074,1.285
                                        c-0.039,0.788-0.066,1.579-0.092,2.37l-0.018,0.489c-0.003,0.085-0.005,0.164-0.008,0.248c-0.048,1.601-0.079,3.205-0.079,4.817
                                        v38.349H69.568z M442.559,433.183v48.4H69.442v-48.4c0-43.469,35.364-78.833,78.833-78.833h35.241v3.828
                                        c0,39.968,32.516,72.484,72.484,72.484c39.968,0,72.484-32.516,72.484-72.484v-3.828h35.241
                                        C407.195,354.35,442.559,389.714,442.559,433.183z M416.191,201.837c0-0.01-0.001-0.02-0.001-0.03
                                        c-0.004-0.152-0.011-0.304-0.015-0.456c-0.006-0.156-0.01-0.312-0.016-0.468l-0.026-0.722c-0.025-0.766-0.053-1.53-0.089-2.276
                                        c0-0.005,0-0.01-0.001-0.014c-0.018-0.37-0.044-0.739-0.064-1.109c-0.003-0.046-0.005-0.091-0.008-0.137l-0.053-0.85
                                        c-0.038-0.622-0.075-1.242-0.122-1.882c0-0.003,0-0.005-0.001-0.008c-0.041-0.546-0.091-1.091-0.137-1.636l-0.042-0.48
                                        c-0.048-0.561-0.096-1.121-0.151-1.68c-0.065-0.666-0.14-1.329-0.214-1.993l-0.041-0.362c-0.043-0.385-0.088-0.771-0.134-1.157
                                        c-0.102-0.849-0.213-1.694-0.328-2.538l-0.043-0.306c-0.069-0.502-0.138-1.004-0.211-1.492c-0.108-0.73-0.225-1.456-0.344-2.183
                                        c-0.08-0.496-0.16-0.984-0.24-1.449c-0.635-3.688-1.398-7.332-2.281-10.929c-0.013-0.054-0.026-0.109-0.04-0.163h30.842
                                        c2.329,0,4.224,1.895,4.224,4.224v68.253c0,2.329-1.895,4.224-4.224,4.224h-26.192v-38.349c0-0.013,0-0.025,0-0.039
                                        C416.241,204.501,416.224,203.177,416.191,201.837z"/>
                                </g>
                            </g>
                            </svg>
                    </span>
                </label>
                </input>
            </li>
            <li class="group">
                <input wire:model.live='cust_service' class="hidden peer" id="CS02" type="radio" value="6283820634317">
                <label class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:group-hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 group-hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:group-hover:bg-gray-700" for="CS02">
                    <div class="block">
                        <div class="relative z-10 w-full pr-1 text-xl font-semibold bg-white rounded-sm dark:bg-gray-800 dark:group-hover:bg-gray-700 xs:text-lg group-hover:bg-gray-100">
                            Yuri - Driver
                        </div>
                    </div>
                    <span style="scale: 2; margin-right:0.5rem;">
                        <svg class="size-4" stroke="currentColor" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 800 800" style="enable-background:new 0 0 800 800;" xml:space="preserve">
                        <style type="text/css">
                            .st0{fill:none;stroke-width:80;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:160;}
                        </style>
                        <g id="steering-wheel" transform="translate(-2 -2)">
                            <path id="primary" class="st0" d="M482,746.8V597.6c0.1-96.8,78.6-175.1,175.3-175.1c6.4,0,12.7,0.4,19.1,1.1l80,9.2"/>
                            <path id="primary-2" class="st0" d="M48.4,432.8l80-9.2c96.2-10.2,182.5,59.6,192.6,155.8c0.6,6,1,12.1,1,18.2v149.2"/>
                            <path id="primary-3" class="st0" d="M736.8,288.8C628,257.1,515.3,241.4,402,242c-115-0.8-229.4,15.5-339.6,48.4"/>
                            <circle id="primary-4" class="st0" cx="402" cy="402" r="360"/>
                        </g>
                        </svg>
                    </span>
                </label>
                </input>
            </li>
        </ul>
        <div class="font-mono mt-4 text-sm">*lengkapi data di atas dan tekan Ajukan</div>
    </div>
    </form>

    {{-- @php
    $textPesan = "Halo AMAZAV%0D%0ASaya *".Str::title($this->nama)."* ingin melakukan booking armada :  %0D%0A_".$armada->name."_ %0D%0A%0D%0Apada : %0D%0A".$hariAwl." ".date('d-M-Y H:i', strtotime($this->tglAwal))." s.d %0D%0A".$hariAkh." ".date('d-M-Y H:i', strtotime($this->tglAkhir))."%0D%0A%0D%0ATujuan : %0D%0A*".Str::title($this->tujuan)."* %0D%0A%0D%0AHub saya kembali : ".$this->noWA;
    @endphp --}}

    @if ($nama == null || $noWA == null || $tglAwal == null || $tglAkhir == null || $tujuan == null || $cust_service == null)        
    <div class="w-full ">
        <x-button text="Ajukan Sekarang" color="gray" light class="w-full" />
    </div>
    @else
    <div class="w-full">
        {{-- <a href="https://wa.me/{{ $this->cust_service }}?text={{ $textPesan }}"  target="_blank"> --}}
            <x-button text="Ajukan Sekarang" color="green" light class="w-full" type="submit" form="jadwal-create" />
        {{-- </a> --}}
    </div>
    @endif
</div>
