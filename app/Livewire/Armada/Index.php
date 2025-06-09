<?php

namespace App\Livewire\Armada;

use App\Livewire\Traits\Alert;
use App\Models\Armada;
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
        ['index' => 'images', 'label' => 'Images'],
        ['index' => 'name', 'label' => 'Nama'],

        ['index' => 'status', 'label' => 'Status'],
        ['index' => 'type', 'label' => 'Tipe'],
        ['index' => 'categories', 'label' => 'Categories'],
        ['index' => 'tags', 'label' => 'Tags'],

        ['index' => 'price', 'label' => '<span class="text-end text-amber-500">Harga</span>', 'unescaped' => true],
    ];

    public function render()
    {
        return view('livewire.armada.index');
    }

    #[Computed()]
    public function rows(): LengthAwarePaginator
    {
        return Armada::query()
            // ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn(Builder $query) => $query->whereAny(['name', 'slug', 'description', 'status', 'type', 'categories', 'tags', 'price'], 'like', '%' . trim($this->search) . '%'))
            ->orderBy(...array_values($this->sort))
            ->paginate($this->quantity)
            ->withQueryString();
    }


    public function bulkStatusOpen()
    {
        if ($this->selected == null) {
            $this->toast()->error('Gagal', 'Tidak ada data terpilih')->send();
        } else {
            $this->question()
                ->warning('Ubah Status', 'yakin data ini akan diubah?')
                ->confirm(method: 'bulkStatusOpenYes')
                ->cancel()
                ->send();
        }
    }

    public function bulkStatusOpenYes()
    {
        foreach ($this->selected as $key => $id) {
            Armada::find($id)->update(['status' => 'open']);
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
            Armada::find($id)->delete();
        }

        return $this->redirect('/armada', navigate: true);
    }
}
