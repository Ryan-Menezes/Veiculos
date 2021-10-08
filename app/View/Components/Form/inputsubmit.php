<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class inputsubmit extends Component
{
    public $value;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $value, string $class)
    {
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.inputsubmit');
    }
}
