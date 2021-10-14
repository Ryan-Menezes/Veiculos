<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class inputemail extends Component
{
    public $name;
    public $value;
    public $placeholder;
    public $class;
    public $id;
    public $title;
    public $maxlength;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = '', string $value = '', string $placeholder = '', string $class = '', string $id = '', string $title = 'E-Mail', int $maxlength = 191)
    {
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->id = $id;
        $this->title = $title;
         $this->maxlength = $maxlength;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.inputemail');
    }
}
