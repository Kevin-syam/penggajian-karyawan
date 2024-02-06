<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Delete extends Component
{
    public $url;
    /**
     * Create a new component instance.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.delete');
    }
}
