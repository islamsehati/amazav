<?php

namespace App\Livewire;

use App\Livewire\Traits\Alert;
use App\Models\Armada;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Str;

class ArmadaDetail extends Component
{
    use Alert;

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

    public function buatjadwal(): void
    {
        $schedule = new Schedule();

        $schedule->nama = $this->nama;
        $schedule->kontak = $this->noWA;
        $schedule->tglawal = $this->tglAwal;
        $schedule->tglakhir = $this->tglAkhir;
        $schedule->tujuan = $this->tujuan;
        $schedule->terbayar = false;
        $schedule->harga = 0;
        $schedule->narahubung = 1;
        // $schedule->narahubung = User::where('phone', $this->cust_service)->value('id');

        $schedule->save();

        $armada = Armada::where('slug', $this->slug)->firstOrFail();
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

        $textPesan = "Halo AMAZAV%0D%0ASaya *" . Str::title($this->nama) . "* ingin melakukan booking armada :  %0D%0A_" . $armada->name . "_ %0D%0A%0D%0Apada : %0D%0A" . $hariAwl . " " . date('d-M-Y H:i', strtotime($this->tglAwal)) . " s.d %0D%0A" . $hariAkh . " " . date('d-M-Y H:i', strtotime($this->tglAkhir)) . "%0D%0A%0D%0ATujuan : %0D%0A*" . Str::title($this->tujuan) . "* %0D%0A%0D%0AHub saya kembali : " . $this->noWA;
        redirect('https://wa.me/' . $this->cust_service . '?text=' . $textPesan);

        $this->nama = '';
        $this->noWA = '';
        $this->tglAwal = '';
        $this->tglAkhir = '';
        $this->tujuan = '';
        $this->cust_service = '';
        $this->toast()->success('Berhasil', 'Penjadwalan telah diajukan')->send();
    }
}
