<?php

namespace App\Livewire\Schedule;

use App\Livewire\Traits\Alert;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use WithPagination, Alert, Interactions;

    public ?int $quantity = 50;

    #[Url()]
    public ?string $search = null;

    #[Url()]
    public array $selected = [];

    public array $sort = [
        'column'    => 'created_at',
        'direction' => 'desc',
    ];

    public array $headers = [
        ['index' => 'action', 'label' => 'Act', 'sortable' => false],
        ['index' => 'id', 'label' => '#'],
        ['index' => 'nama', 'label' => 'Nama'],
        ['index' => 'kontak', 'label' => 'Kontak'],
        ['index' => 'tglawal', 'label' => 'Tgl Awal'],
        ['index' => 'tglakhir', 'label' => 'Tgl Akhir'],
        ['index' => 'tujuan', 'label' => 'Tujuan'],
        ['index' => 'terbayar', 'label' => 'Terbayar'],
        ['index' => 'harga', 'label' => '<span class="text-end text-amber-500">Harga</span>', 'unescaped' => true],
        ['index' => 'narahubung', 'label' => 'Narahubung'],
    ];

    public function render(): View
    {
        $sum_harga = Schedule::query()
            // ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn(Builder $query) => $query->whereAny(['nama', 'kontak', 'tglawal', 'tglakhir', 'tujuan', 'terbayar', 'harga', 'narahubung'], 'like', '%' . trim($this->search) . '%'))
            // ->orderBy(...array_values($this->sort))
            // ->withQueryString()
            // ->get()
            ->sum('harga');

        $userAll = User::all();

        return view('livewire.schedule.index', [
            'sum_harga' => $sum_harga,
            'userAll' => $userAll,
        ]);
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        return Schedule::query()
            // ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn(Builder $query) => $query->whereAny(['nama', 'kontak', 'tglawal', 'tglakhir', 'tujuan', 'terbayar', 'harga', 'narahubung'], 'like', '%' . trim($this->search) . '%'))
            ->orderBy(...array_values($this->sort))
            ->paginate($this->quantity)
            ->withQueryString();
    }

    public function bulkStatusTerbayar()
    {
        if ($this->selected == null) {
            $this->toast()->error('Gagal', 'Tidak ada data terpilih')->send();
        } else {
            $this->question()
                ->warning('Ubah Status', 'yakin data ini akan diubah?')
                ->confirm(method: 'bulkStatusTerbayarYes')
                ->cancel()
                ->send();
        }
    }

    public function bulkStatusTerbayarYes()
    {
        foreach ($this->selected as $key => $id) {
            Schedule::find($id)->update(['terbayar' => true]);
        }

        $this->success('Berhasil', 'barusan telah diubah');
    }

    public function bulkDelete()
    {
        if ($this->selected == null) {
            $this->toast()->error('Gagal', 'Tidak ada data terpilih')->send();
        } else {
            $this->question()
                ->error('Hapus', 'yakin data ini akan dihapus?')
                ->confirm(method: 'bulkdeleteyes')
                ->cancel()
                ->send();
        }
    }

    public function bulkdeleteyes()
    {
        foreach ($this->selected as $key => $id) {
            Schedule::find($id)->delete();
        }

        return $this->redirect('/jadwal', navigate: true);
    }
}
