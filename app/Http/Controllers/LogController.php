<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;

class LogController extends ViaAuthController
{
    public function list(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Log lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('log.list')->with('logs', Log::orderBy('created_at', 'desc')->get());
    }

    public function ajax(Log $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Log lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	echo json_encode($id);
    	die();
    }
}
