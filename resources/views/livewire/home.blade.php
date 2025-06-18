<div class="md:space-y-6 space-y-3 max-w-2xl mx-auto">

        <x-carousel :images="[
            ['src' => Str::replace('%2F', '/',url('storage', '/hiace-premio-white.png')), 'alt' => 'Wallpaper 1'],
            ['src' => Str::replace('%2F', '/',url('storage', '/hiace-premio-silver-metallic.png')), 'alt' => 'Wallpaper 2'],
            ['src' => Str::replace('%2F', '/',url('storage', '/kijang-innova-attitude-black.png')), 'alt' => 'Wallpaper 3'],
            ]" autoplay stop-on-hover wrapper="aspect-[16/9]" />

    <div class="mt-5 text-xl dark:text-white">
        Armada kami
    </div>

    <div class="space-y-3 mb-7 ">
    @foreach ($armadas as $armada)
        <a href="/armada-{{ $armada->slug }}" class="p-2 flex space-x-4 bg-white dark:bg-primary-700 rounded-xl">
            <div class="flex-none"><img src="{{ Str::replace('%2F', '/',url('storage', $armada->images[0])) }}" alt="" class="size-18 object-cover aspect-square rounded-md"></div>
            <div class="w-auto shrink">
                <div class="font-bold dark:text-white">{{ $armada->name }}</div>
                <div class="text-xs dark:text-primary-200">{{ $armada->type }} {{ $armada->categories }}</div>
                {{-- <div class="text-gray-500">@currency($armada->price)</div> --}}
                <div>
                    @foreach ($armada->tags as $tag)
                    <x-badge text="{{ $tag }}" color="lime" outline xs/>
                    @endforeach
                </div>
            </div>
            <div class="flex-none ms-auto bg-primary-600 rounded-r-md text-white w-5 items-center relative pt-6"><x-icon name="chevron-right" class="h-5 w-5"/></div>
        </a>
    @endforeach
    </div>
</div>
