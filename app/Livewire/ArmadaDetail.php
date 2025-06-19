<?php

namespace App\Livewire;

use App\Models\Armada;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;

class ArmadaDetail extends Component
{
    public $slug;
    #[Url()]
    public $nama;
    #[Url()]
    public $noWA;
    #[Url()]
    public $tglAwal;
    #[Url()]
    public $tglAkhir;
    #[Url()]
    public $tujuan;
    #[Url()]
    public $cust_service;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $hariAwal = Carbon::parse($this->tglAwal)->format('l');
        if ($hariAwal === 'Sunday') {
            $hariAwl = 'Ahad';
        } elseif ($hariAwal === 'Monday') {
            $hariAwl = 'Senin';
        } elseif ($hariAwal === 'Tuesday') {
            $hariAwl = 'Selasa';
        } elseif ($hariAwal === 'Wednesday') {
            $hariAwl = 'Rabu';
        } elseif ($hariAwal === 'Thursday') {
            $hariAwl = 'Kamis';
        } elseif ($hariAwal === 'Friday') {
            $hariAwl = 'Jumat';
        } elseif ($hariAwal === 'Saturday') {
            $hariAwl = 'Sabtu';
        }
        // dd($hariAwl);

        $hariAkhir = Carbon::parse($this->tglAkhir)->format('l');
        if ($hariAkhir === 'Sunday') {
            $hariAkh = 'Ahad';
        } elseif ($hariAkhir === 'Monday') {
            $hariAkh = 'Senin';
        } elseif ($hariAkhir === 'Tuesday') {
            $hariAkh = 'Selasa';
        } elseif ($hariAkhir === 'Wednesday') {
            $hariAkh = 'Rabu';
        } elseif ($hariAkhir === 'Thursday') {
            $hariAkh = 'Kamis';
        } elseif ($hariAkhir === 'Friday') {
            $hariAkh = 'Jumat';
        } elseif ($hariAkhir === 'Saturday') {
            $hariAkh = 'Sabtu';
        }
        // dd($hariAkh);

        return view('livewire.armada-detail', [
            'armada' => Armada::where('slug', $this->slug)->firstOrFail(),
            'hariAwl' => $hariAwl,
            'hariAkh' => $hariAkh,
        ]);
    }
}
