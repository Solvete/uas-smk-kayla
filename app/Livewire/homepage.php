<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Homepage')]
#[Layout('components.layouts.guest')]
class Homepage extends Component
{
    public function render()
    {
        return view('livewire.homepage');
    }
}
