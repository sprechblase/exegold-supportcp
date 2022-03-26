<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banprotokoll;
use App\User;
use App\Log;

class BanprotokollController extends ViaAuthController
{
    public function list(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Banprotokoll lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('banprotokoll.list')->with('cases', Banprotokoll::orderBy('created_at', 'desc')->get());
    }

    public function ajax(Banprotokoll $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Banprotokoll lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	echo json_encode($id);
    	die();
    }

    public function edit(Banprotokoll $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Banprotokoll bearbeiten')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;

    	if($r->isMethod('post')) {

    		foreach($id->getFillable() as $prop)
    		{
    			if($prop == "supporter") {
    				$id->supporter = implode(", ", $r->supporter);
    			} else {
    				$id->$prop = $r->$prop;
    			}

    		}

    		$id->save();

    		Log::create(['user_id' => $r->user()->id, 'model' => 'BANPROTOKOLL', 'action' => 'EDIT', 'dataold' => json_encode($old), 'datanew' => json_encode($id)]);

    		return redirect()->back()->with('success', 'Das Banprotokoll wurde gespeichert!');

    	} else {
    		return view('banprotokoll.edit')->with('case', $id);
    	}
    }

    public function delete(Banprotokoll $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Banprotokoll löschen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;
    	$id->delete();

    	Log::create(['user_id' => $r->user()->id, 'model' => 'BANPROTOKOLL', 'action' => 'DELETE', 'dataold' => json_encode($old), 'datanew' => '-']);

    	return redirect()->back()->with('success', 'Das Banprotokoll wurde gelöscht!');
    }

    public function create(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Banprotokoll erstellen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($r->isMethod('post')) {

	    	$case = Banprotokoll::create([

	    		'supporter' => implode(", ", $r->supporter),
	    		'spieler' => $r->spieler,
	    		'forumname' => $r->forumname,
	    		'von' => $r->von,
	    		'bis' => $r->bis,
	    		'supportfallid' => $r->supportfallid,
	    	]);
	    	Log::create(['user_id' => $r->user()->id, 'model' => 'BANPROTOKOLL', 'action' => 'CREATE', 'datanew' => json_encode($case), 'dataold' => '-']);
	    	return redirect()->back()->with('success', 'Das Banprotokoll wurde angelegt!');
    	} else {
    		return view('banprotokoll.create');
    	}
    }
}
