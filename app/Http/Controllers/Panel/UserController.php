<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $user;
    private $prefix = 'panel.';

    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->prefix . 'users.index');
    }

    public function load(int $offset = 0, int $limit = 10, string $search = ''){
        $users = $this->user
                        ->where('name', 'LIKE', "%{$search}%")
                        ->offset($offset)
                        ->limit($limit)
                        ->get();

        $html = '';

        foreach($users as $user):
           $html .= view('components.users.userline', compact('user'));
        endforeach;

        if($users->count() >= 10):
            $html .= view('components.table.btnload', [
                'container'     => '.table-users-body',
                'route'         => 'panel.users.load',
                'removeElement' => '#parentLoading',
                'offset'        => $users->count(),
                'limit'         => $limit,
                'search'        => $search
            ]);
        endif;

        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
