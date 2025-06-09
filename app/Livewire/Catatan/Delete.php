<?php

namespace App\Livewire\Catatan;

use App\Livewire\Traits\Alert;
use App\Models\Catatan;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Delete extends Component
{
    use Alert;

    public Catatan $catatan;

    public function render(): string
    {
        return <<<'HTML'
        <div>
            <x-button sm icon="trash" color="red" wire:click="confirm" />
        </div>
        HTML;
    }

    #[Renderless]
    public function confirm(): void
    {
        $this->question()
            ->error('Hapus', 'yakin data ini dihapus?')
            ->confirm(method: 'delete')
            ->cancel()
            ->send();
    }

    public function delete(): void
    {
        $this->catatan->delete();

        $this->dispatch('deleted');

        $this->success();
    }
}
