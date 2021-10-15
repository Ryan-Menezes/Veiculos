<?php

namespace App\View\Components\Permissions;

use Illuminate\View\Component;
use App\Models\Permission;

class permissionline extends Component
{
    public $permission;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.permissions.permissionline');
    }
}
