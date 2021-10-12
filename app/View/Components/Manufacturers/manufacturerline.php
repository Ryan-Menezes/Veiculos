<?php

namespace App\View\Components\Manufacturers;

use Illuminate\View\Component;
use App\Models\Manufacturer;

class manufacturerline extends Component
{
    public $manufacturer;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.manufacturers.manufacturerline');
    }
}
