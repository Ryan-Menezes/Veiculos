<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class inputtextarea extends Component
{
    public $name;
    public $value;
    public $placeholder;
    public $class;
    public $id;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = '', string $value = '', string $placeholder = '', string $class = '', string $id = '', string $title = 'Texto')
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.inputtextarea');
    }
}
