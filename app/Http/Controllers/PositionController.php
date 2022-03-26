<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;
use App\Log;

class PositionController extends ViaAuthController
{
    public function list(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Position lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('position.list')->with('positions', Position::orderBy('created_at', 'desc')->get());
    }

    public function edit(Position $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Position bearbeiten')) {
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

    		Log::create(['user_id' => $r->user()->id, 'model' => 'POSITION', 'action' => 'EDIT', 'dataold' => json_encode($old), 'datanew' => json_encode($id)]);

    		return redirect()->back()->with('success', 'Die Position wurde gespeichert!');

    	} else {
    		return view('position.edit')->with('position', $id);
    	}
    }

    public function delete(Position $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Position löschen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;
    	$id->delete();

    	Log::create(['user_id' => $r->user()->id, 'model' => 'POSITION', 'action' => 'DELETE', 'dataold' => json_encode($old), 'datanew' => '-']);

    	return redirect()->back()->with('success', 'Die Position wurde gelöscht!');
    }

    public function create(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Position erstellen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($r->isMethod('post')) {

    		$position = new Position();
    		$position->position = $r->position;
            $position->position_description = $r->position_description;
    		$position->priority = $r->priority;
    		$position->save();

	    	Log::create(['user_id' => $r->user()->id, 'model' => 'POSITION', 'action' => 'CREATE', 'datanew' => json_encode($position), 'dataold' => '-']);
	    	return redirect()->back()->with('success', 'Die Position angelegt!');
    	} else {
    		return view('position.create');
    	}
    }
}
