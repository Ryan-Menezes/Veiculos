<?php

namespace App\View\Components\Requests;

use Illuminate\View\Component;
use App\Models\Request;

class requestline extends Component
{
    public $request;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.requests.requestline');
    }
}
