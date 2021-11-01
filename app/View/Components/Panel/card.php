<?php

namespace App\View\Components\Panel;

use Illuminate\View\Component;

class card extends Component
{
    public $title;
    public $content;
    public $route;
    public $icon;
    public $class;
    public $can;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $content, string $route, string $icon, string $class = null, string $can = null)
    {
        $this->title = $title;
        $this->content = $content;
        $this->route = $route;
        $this->icon = $icon;
        $this->class = $class;
        $this->can = $can;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.panel.card');
    }
}
