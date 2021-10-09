<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class delete extends Component
{
    public $title;
    public $message;
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = null, string $message = null, string $id = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.delete');
    }
}
