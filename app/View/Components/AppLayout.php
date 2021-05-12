<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     *
     *
     */

    public function logout(){
        dd('log');
        auth()->logout();
        return redirect('/login');
    }

    public function render()
    {
        return view('layouts.app');
    }
}
