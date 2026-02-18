<?php

namespace app\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class admin extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.modals.admin');
    }
}
