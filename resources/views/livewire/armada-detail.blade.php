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

            <x-carousel autoplay stop-on-hover wrapper="aspect-square"
            :images="$imgArmd"
            />
    <span class="dark:text-white">{{ $armada->name }} ..</span>
</div>
