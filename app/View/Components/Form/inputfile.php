<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class inputfile extends Component
{
    public $name;
    public $class;
    public $id;
    public $title;
    public $accept;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = '', string $placeholder = '', string $class = '', string $id = '', string $title = 'Arquivo', string $accept = '')
    {
        $this->name = $name;
        $this->class = $class;
        $this->id = $id;
        $this->title = $title;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.inputfile');
    }
}
