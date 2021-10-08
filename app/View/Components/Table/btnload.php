<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class btnload extends Component
{
    public $class;
    public $container;
    public $route;
    public $search;
    public $offset;
    public $limit;
    public $removeElement;
    public $remove;
    public $append;
    public $method;
    public $datax;
    public $loading;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $class, string $container, string $route, string $search = '', int $offset = 0, int $limit = 10, string $removeElement = null, bool $remove = true, bool $append = true, string $method = 'POST', string $data = null, bool $loading = true)
    {
        $this->class = $class;
        $this->container = $container;
        $this->route = $route;
        $this->search = $search;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->removeElement = $removeElement;
        $this->remove = $remove;
        $this->append = $append;
        $this->method = $method;
        $this->datax = $data;
        $this->loading = $loading;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.btnload');
    }
}
