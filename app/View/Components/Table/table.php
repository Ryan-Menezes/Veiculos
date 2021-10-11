<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class table extends Component
{
    public $columns;
    public $container;
    public $route;
    public $title;
    public $btnnew;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $columns, string $container, string $route, string $title = null, bool $btnnew = true)
    {
        $this->columns = $columns;
        $this->container = $container;
        $this->route = $route;
        $this->title = $title;
        $this->btnnew = $btnnew;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.table');
    }
}
