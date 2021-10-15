<?php

namespace App\View\Components\Roles;

use Illuminate\View\Component;
use App\Models\Role;

class roleline extends Component
{
    public $role;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.roles.roleline');
    }
}
