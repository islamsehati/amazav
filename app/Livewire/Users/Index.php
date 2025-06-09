<?php

namespace App\Livewire\Users;

use App\Livewire\Traits\Alert;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use Alert, WithPagination, Interactions;

    public ?int $quantity = 10;

    #[Url()]
    public ?string $search = null;

    #[Url()]
    public array $selected = [];

    public array $sort = [
        'column'    => 'updated_at',
        'direction' => 'desc',
    ];

    public array $headers = [
        ['index' => 'action', 'label' => 'Act', 'sortable' => false],
        ['index' => 'id', 'label' => '#'],
        ['index' => 'name', 'label' => 'Name'],
        ['index' => 'email', 'label' => 'E-mail'],
        ['index' => 'photo', 'label' => 'Photo'],
        ['index' => 'age', 'label' => 'Age'],
        ['index' => 'created_at', 'label' => 'Created'],
        ['index' => 'updated_at', 'label' => 'Updated'],
        ['index' => 'date_active', 'label' => 'Tgl Aktif'],
    ];

    public function render(): View
    {
        return view('livewire.users.index');
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        return User::query()
            ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn(Builder $query) => $query->whereAny(['name', 'email'], 'like', '%' . trim($this->search) . '%'))
            ->orderBy(...array_values($this->sort))
            ->paginate($this->quantity)
            ->withQueryString();
    }

    public function bulkAge()
    {
        if ($this->selected == null) {
            $this->toast()->error('Gagal', 'Tidak ada data terpilih')->send();
        } else {
            $this->question()
                ->warning('Ubah Usia', 'yakin data ini akan diubah?')
                ->confirm(method: 'bulkageyes')
                ->cancel()
                ->send();
        }
    }

    public function bulkageyes()
    {
        foreach ($this->selected as $key => $id) {
            User::find($id)->update(['age' => '17']);
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
            User::find($id)->delete();
        }

        return $this->redirect('/users', navigate: true);
    }
}
