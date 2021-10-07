<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class inputpassword extends Component
{
    public $name;
    public $placeholder;
    public $class;
    public $id;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = '', string $placeholder = '', string $class = '', string $id = '', string $title = 'Senha')
    {
        $this->name = $name;
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
        return view('components.form.inputpassword');
    }
}
