<?php

namespace App\Livewire;

use App\Models\Armada;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $armadas = Armada::query();
        return view('livewire.home', [
            'armadas' => $armadas->get(),
        ]);
    }
}
