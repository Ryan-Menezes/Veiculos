<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class editcreate extends Component
{
    public $title;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = null, string $class = null)
    {
        $this->title = $title;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.editcreate');
    }
}
