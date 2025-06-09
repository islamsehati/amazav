<?php

namespace App\Livewire\Catatan;

use App\Livewire\Traits\Alert;
use App\Models\Catatan;
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
        ['index' => 'title', 'label' => 'Judul'],
        ['index' => 'images', 'label' => 'Images'],
        ['index' => 'catatan', 'label' => 'Catatan'],
        ['index' => 'status', 'label' => 'Status'],
        ['index' => 'type', 'label' => 'Tipe'],
        ['index' => 'categories', 'label' => 'Categories'],
        ['index' => 'tags', 'label' => 'Tags'],
        ['index' => 'created_at', 'label' => 'Created'],
        ['index' => 'tanggal', 'label' => '<span>Tanggal</span>', 'unescaped' => true],
        ['index' => 'target', 'label' => '<span class="text-end text-amber-500">Target</span>', 'unescaped' => true],
        ['index' => 'collected', 'label' => '<span class="text-end text-amber-500">Collected</span>', 'unescaped' => true],
    ];

    public function render(): View
    {
        $sum_target = Catatan::query()
            // ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn(Builder $query) => $query->whereAny(['title', 'slug', 'catatan', 'status', 'type', 'categories', 'tags', 'target', 'collected'], 'like', '%' . trim($this->search) . '%'))
            // ->orderBy(...array_values($this->sort))
            // ->withQueryString()
            // ->get()
            ->sum('target');
        $sum_collected = Catatan::query()
            // ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn(Builder $query) => $query->whereAny(['title', 'slug', 'catatan', 'status', 'type', 'categories', 'tags', 'target', 'collected'], 'like', '%' . trim($this->search) . '%'))
            // ->orderBy(...array_values($this->sort))
            // ->withQueryString()
            // ->get()
            ->sum('collected');
        return view('livewire.catatan.index', [
            'sum_target' => $sum_target,
            'sum_collected' => $sum_collected,
        ]);
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        return Catatan::query()
            // ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn(Builder $query) => $query->whereAny(['title', 'slug', 'catatan', 'status', 'type', 'categories', 'tags', 'target', 'collected'], 'like', '%' . trim($this->search) . '%'))
            ->orderBy(...array_values($this->sort))
            ->paginate($this->quantity)
            ->withQueryString();
    }

    public function bulkStatusSelesai()
    {
        if ($this->selected == null) {
            $this->toast()->error('Gagal', 'Tidak ada data terpilih')->send();
        } else {
            $this->question()
                ->warning('Ubah Status', 'yakin data ini akan diubah?')
                ->confirm(method: 'bulkStatusSelesaiYes')
                ->cancel()
                ->send();
        }
    }

    public function bulkStatusSelesaiYes()
    {
        foreach ($this->selected as $key => $id) {
            Catatan::find($id)->update(['status' => 'selesai']);
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
            Catatan::find($id)->delete();
        }

        return $this->redirect('/catatan', navigate: true);
    }
}
