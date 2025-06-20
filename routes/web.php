<?php

use App\Livewire\Home;
use App\Livewire\Armada\Index as ArmadaIndex;
use App\Livewire\ArmadaDetail as ArmadaDetail;
use App\Livewire\Armada\Create as ArmadaCreate;
use App\Livewire\Armada\Update as ArmadaUpdate;
use App\Livewire\Schedule\Index as ScheduleIndex;
use App\Livewire\Catatan\CatatanDetail;
use App\Livewire\Catatan\Index as CatatanIndex;
use App\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Users\Index;

Route::get('/', Home::class)->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/armada-{slug}', ArmadaDetail::class)->name('armada.detail');

Route::middleware(['auth'])->group(function () {

    Route::get('/armada', ArmadaIndex::class)->name('armada.index');
    Route::get('/armada/create', ArmadaCreate::class)->name('armada.create');
    Route::get('/armada/{armadaid}', ArmadaUpdate::class)->name('armada.show');

    Route::get('/jadwal', ScheduleIndex::class)->name('schedule.index');

    Route::get('/users', Index::class)->name('users.index');
    Route::get('/catatan', CatatanIndex::class)->name('catatan.index');
    Route::get('/catatan/{catatanid}', CatatanDetail::class)->name('catatan.show');

    Route::get('/my-profile', Profile::class)->name('user.profile');
});

require __DIR__ . '/auth.php';
