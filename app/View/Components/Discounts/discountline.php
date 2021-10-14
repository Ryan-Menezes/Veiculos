<?php

namespace App\View\Components\Discounts;

use Illuminate\View\Component;
use App\Models\Discount;

class discountline extends Component
{
    public $discount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.discounts.discountline');
    }
}
