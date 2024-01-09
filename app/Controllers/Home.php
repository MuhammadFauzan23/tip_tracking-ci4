<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function viewListTip()
    {
        return view('Tip_tracking/list_tip');
    }

    public function edit_profile()
    {
        return view('Tip_tracking/edit_profile');
    }
}
