<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use App\Position;
use App\Pad;

class PadController extends ViaAuthController
{

	public function open(Pad $id, Request $r)
	{
		if($this->isLocked($r)) return redirect('locked');
    	if($id->type == "support" && !$r->user()->hasPermissionTo('Pad Support')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($id->type == "projektleitung" && !$r->user()->hasPermissionTo('Pad Projektleitung')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($id->type == "entwicklung" && !$r->user()->hasPermissionTo('Pad Entwicklung')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('pad.open')->with('id', $id);
	}

    public function list(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Pad lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('pad.list');
    }

    public function edit(Pad $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Pad bearbeiten')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}


    	$old = $id;

    	if($r->isMethod('post')) {

    		foreach($id->getFillable() as $prop)
    		{
    			if($r->$prop != "") {
					$id->$prop = $r->$prop;
    			}
    		}

    		$id->save();

    		Log::create(['user_id' => $r->user()->id, 'model' => 'PAD', 'action' => 'EDIT', 'dataold' => json_encode($old), 'datanew' => json_encode($id)]);

    		return redirect()->back()->with('success', 'Das Pad wurde gespeichert!');

    	} else {
    		return view('pad.edit')->with('pad', $id);
    	}
    }

    public function delete(Pad $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Pad löschen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;
    	$id->delete();

    	Log::create(['user_id' => $r->user()->id, 'model' => 'PAD', 'action' => 'DELETE', 'dataold' => json_encode($old), 'datanew' => '-']);

    	return redirect()->back()->with('success', 'Das Pad wurde gelöscht!');
    }

    public function create(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Pad erstellen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($r->isMethod('post')) {

    		$pad = new Pad();
    		$pad->type = $r->type;
    		$pad->done = "NO";
    		$pad->title = $r->title;
    		$pad->slug = md5(uniqid());

    		$pad->save();

        	
	    	Log::create(['user_id' => $r->user()->id, 'model' => 'PAD', 'action' => 'CREATE', 'datanew' => json_encode($pad), 'dataold' => '-']);
	    	return redirect()->back()->with('success', 'Das Pad wurde angelegt!');
    	} else {
    		return view('pad.create');
    	}
    }
}
