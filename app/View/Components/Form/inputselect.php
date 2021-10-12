<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class inputselect extends Component
{
    public $options;
    public $name;
    public $value;
    public $class;
    public $id;
    public $title;
    public $size;
    public $multiple;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options, string $name = '', string $value = null, string $class = '', string $id = '', string $title = 'Select', int $size = 1, bool $multiple = false)
    {
        $this->options = $options;
        $this->name = $name;
        $this->value = $value;
        $this->class = $class;
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
        $this->multiple = $multiple;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.inputselect');
    }
}
