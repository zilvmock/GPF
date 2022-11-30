<?php

namespace App\Http\ViewComposers;

use App\Models\Room;
use Illuminate\View\View;

class MetaViewComposer
{
    public function compose(View $view)
    {
        /* PROFILE */
        /* - View */
        if (request()->is('profile/*')) {
            $metaTitle = ucwords(str_replace('-', ' ', request()->segment(2)));
        }
        /* - Edit */
        if (request()->is('profile/edit')) {
            $metaTitle = ucwords('Edit Profile');
        }

        /* BROWSE */
        /* - main*/
        if (request()->is('browse')) {
            $metaTitle = ucwords('Browse');
        }
        /* - game */
        if (request()->is('browse/*/*/rooms')) {
            $metaTitle = ucwords(str_replace('-', ' ', request()->segment(2)));
        }
        /* -- game room */
        elseif (request()->is('browse/*/*/*')) {
            $metaTitle = Room::select('title')->where('id', request()->segment(4))->first()->title;
        }

        /* GUEST */
        /* - login */
        if (request()->is('login')) {
            $metaTitle = ucwords('Login');
        }
        /* - register */
        if (request()->is('register')) {
            $metaTitle = ucwords('Register');
        }

        if (isset($metaTitle)) {
            $view->with('metaTitle', $metaTitle);
        }
    }
}
