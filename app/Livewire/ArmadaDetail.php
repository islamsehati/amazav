<?php

namespace App\Livewire;

use App\Models\Armada;
use Livewire\Component;

class ArmadaDetail extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.armada-detail', [
            'armada' => Armada::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
