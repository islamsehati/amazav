<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ config('app.name', 'Laravel') }}</title>
            <link rel="icon" type="image/x-icon"  href="{{ Str::replace('%2F', '/',url('storage', '/favicon.png')) }}"/>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <tallstackui:script />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @layer utilities {
                  /* Hide scrollbar for Chrome, Safari and Opera */
                  .no-scrollbar::-webkit-scrollbar {
                      display: none;
                  }
                 /* Hide scrollbar for IE, Edge and Firefox */
                  .no-scrollbar {
                      -ms-overflow-style: none;  /* IE and Edge */
                      scrollbar-width: none;  /* Firefox */
                }
              }
        </style>
    </head>

    <body class="font-sans antialiased"
        x-cloak
        @if (Auth::check()) 
            {
                x-data="{ 
                        name: @js(auth()->user()->name), 
                        phone: @js(auth()->user()->phone) 
                }"
            }
        @endif
        x-on:name-updated.window="name = $event.detail.name"
        x-bind:class="{ 'dark bg-primary-900': darkTheme, 'bg-primary-100': !darkTheme }"
        @php 
        if (Auth::check()) {
            $userPhoto = auth()->user()->photo;
            $CountUsers = App\Models\User::whereNotIn('id', [Auth::id()])->count();
            $CountCatatan = App\Models\Catatan::count();
            }
        @endphp
    >
    <x-layout>
        <x-slot:top>
            <x-dialog />
            <x-toast />
        </x-slot:top>
        <x-slot:header>
            <x-layout.header without-mobile-button>
                <x-slot:left >
                    <span x-on:click="$dispatch('tallstackui-menu-mobile', { status : true })" class="cursor-pointer">
                        <img src="{{ Str::replace('%2F', '/',url('storage', '/AmazavLOGO.png')) }}" class="size-6" />
                    </span>
                    <h4 x-on:click="$dispatch('tallstackui-menu-mobile', { status : true })" 
                    class="cursor-pointer text-primary-700 dark:text-primary-200">
                        Amazav
                    </h4>
                </x-slot:left>
                <x-slot:right>
                    <x-theme-switch only-icons />
                    <x-icon onclick="toggle_full_screen();" id="lyrpenuh" name="arrows-pointing-out" class="h-5 w-5 ml-2 cursor-pointer text-primary-600 dark:text-primary-200">
                    </x-icon>
                    <x-icon onclick="toggle_full_screen();" id="lyrpenuhtutup" name="arrows-pointing-in" class="h-5 w-5 ml-2 cursor-pointer text-primary-600 dark:text-primary-200 hidden">
                    </x-icon>
                    <x-icon x-on:click="$dispatch('tallstackui-menu-mobile', { status : true })" name="bars-3" class="size-7 ml-2 cursor-pointer text-primary-600 dark:text-primary-200">
                    </x-icon>
                </x-slot:right>
            </x-layout.header>
        </x-slot:header>


        <x-slot:menu>

            <x-side-bar smart navigate>
 
                <x-slot:brand>
                    <div class="mt-6 flex items-center justify-center">
                        {{-- <img src="{{ asset('/assets/images/tsui.png') }}" /> --}}
                        <img src="{{ Str::replace('%2F', '/',url('storage', '/AmazavLOGO.png')) }}" class="size-24" />
                    </div>
                </x-slot:brand>

                <x-side-bar.item text="Amazav" icon="paper-airplane" :route="route('home')"/>
                
                @auth
                @if (auth()->user()->is_admin == 1)
                <x-side-bar.item text="Menu Utama" icon="book-open">
                    <div class="flex flex-nowrap">
                        <div class="w-full">
                            <x-side-bar.item text="Armada" icon="document-text" :route="route('armada.index')" />
                        </div>
                    </div>
                    <div class="flex flex-nowrap">
                        <div class="w-full">
                            <x-side-bar.item text="Users" icon="users" :route="route('users.index')"/>
                        </div>
                        @auth
                        <x-badge text="{{ $CountUsers }}" color="amber" outline class="absolute right-6 mt-2.5" />
                        @endauth
                    </div> 
                    <div class="flex flex-nowrap">
                        <div class="w-full">
                            <x-side-bar.item text="Catatan" icon="document-text" :route="route('catatan.index')" />
                        </div>
                        @auth
                        <x-badge text="{{ $CountCatatan }}" color="amber" outline class="absolute right-6 mt-2.5" />
                        @endauth
                    </div>
                </x-side-bar.item>
                @endif
                @endauth

                <x-side-bar.item text="About" icon="information-circle" :route="route('about')"/>
                <a href="https://wa.me/6287881231119?text=Assalamu'alaikum Admin"  target="_blank">
                    <div class="w-full cursor-pointer items-center flex font-medium text-primary-500 bg-white hover:bg-primary-50 dark:text-white dark:bg-primary-900 dark:hover:bg-primary-600 rounded-md py-2 px-3 mb-2">
                        <span><x-icon name="phone" class="size-5 me-3"/></span> Bantuan
                    </div>
                </a>

                <div class="relative bottom-0 h-24">
                    
                </div>
            
                
                <div class="fixed bottom-2 ms-2 me-2 xs:w-72 w-[calc(100%-5.8rem)] max-w-70">
                    @auth
                        <div class="w-full">
                            <x-dropdown position="top-start">
                                <x-slot:action>
                                        <div class="xs:w-[calc(100%+5rem)] w-[calc(100vw-6rem)] max-w-[18rem] cursor-pointer items-center flex text-primary-400 bg-white outline-primary-400 hover:bg-primary-100 dark:text-white dark:bg-primary-800 dark:outline-white dark:hover:bg-primary-900 outline-2 rounded-md py-2 px-3 mb-2" x-on:click="show = !show">
                                            <div class="flex flex-nowrap">
                                                <img src="{{ $userPhoto == null ? url('storage/avatars/user.png') : url('storage/'.$userPhoto) }}" alt="avatar" class="object-cover rounded-full size-10">
                                                <div class="grid grid-cols-1 pl-2 -space-y-1 -mt-0.5">
                                                    <span class="text-base font-semibold text-primary-500 dark:text-white" x-text="name"></span>
                                                    <span class="text-sm font-normal text-primary-500 dark:text-white" x-text="phone"></span> 
                                                </div>
                                            </div>
                                            <div class="ms-auto">
                                                <x-icon name="chevron-up-down" class="h-5 w-5"/>
                                            </div>
                                        </div>
                                </x-slot:action>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown.items text="Profile" :href="route('user.profile')" wire:navigate />
                                    <x-dropdown.items text="Logout" onclick="event.preventDefault(); this.closest('form').submit();" separator />
                                </form>
                            </x-dropdown>
                        </div>
                    @else

                        <a href="/login"><div class="w-full cursor-pointer items-center flex justify-between text-primary-600 bg-white outline-primary-400 hover:bg-primary-100 dark:text-white dark:bg-primary-800 dark:outline-white dark:hover:bg-primary-900 outline-2 rounded-md py-2 px-3 mb-2">
                            Login Sekarang <span><x-icon name="arrow-right-end-on-rectangle" class="h-5 w-5"/></span>
                        </div></a>

                    @endauth
                </div>
            </x-side-bar>
        </x-slot:menu>
        <main>
            {{ $slot }}
        </main>
    </x-layout>
    @livewireScripts

    
  <script>
    function toggle_full_screen()
       {
           if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen))
           {
               if (document.documentElement.requestFullScreen){
                   document.documentElement.requestFullScreen();
                  document.getElementById("lyrpenuh").classList.add("hidden");
                  document.getElementById("lyrpenuhtutup").classList.remove("hidden");
               }
               else if (document.documentElement.mozRequestFullScreen){ /* Firefox */
                   document.documentElement.mozRequestFullScreen();
                  document.getElementById("lyrpenuh").classList.add("hidden");
                  document.getElementById("lyrpenuhtutup").classList.remove("hidden");
               }
               else if (document.documentElement.webkitRequestFullScreen){   /* Chrome, Safari & Opera */
                   document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
                  document.getElementById("lyrpenuh").classList.add("hidden");
                  document.getElementById("lyrpenuhtutup").classList.remove("hidden");
               }
               else if (document.msRequestFullscreen){ /* IE/Edge */
                   document.documentElement.msRequestFullscreen();
                  document.getElementById("lyrpenuh").classList.add("hidden");
                  document.getElementById("lyrpenuhtutup").classList.remove("hidden");
               }
           }
           else
           {
               if (document.cancelFullScreen){
                   document.cancelFullScreen();
                  document.getElementById("lyrpenuh").classList.remove("hidden");
                  document.getElementById("lyrpenuhtutup").classList.add("hidden");
               }
               else if (document.mozCancelFullScreen){ /* Firefox */
                   document.mozCancelFullScreen();
                  document.getElementById("lyrpenuh").classList.remove("hidden");
                  document.getElementById("lyrpenuhtutup").classList.add("hidden");
               }
               else if (document.webkitCancelFullScreen){   /* Chrome, Safari and Opera */
                   document.webkitCancelFullScreen();
                  document.getElementById("lyrpenuh").classList.remove("hidden");
                  document.getElementById("lyrpenuhtutup").classList.add("hidden");
               }
               else if (document.msExitFullscreen){ /* IE/Edge */
                   document.msExitFullscreen();
                  document.getElementById("lyrpenuh").classList.remove("hidden");
                  document.getElementById("lyrpenuhtutup").classList.add("hidden");
               }
           }
       }
 </script>

    </body>
</html>
