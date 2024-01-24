<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Demand extends Component
{

    public function add()
    {
        return view('livewire.form-demand');
    }

    public function render() : View
    {
        return view('livewire.demand');
    }
}
