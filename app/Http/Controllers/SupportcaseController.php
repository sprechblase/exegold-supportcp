<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supportcase;
use App\User;
use App\Log;

class SupportcaseController extends ViaAuthController
{
    public function list($type, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Supportfall lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('supportcase.list')->with('cases', Supportcase::where('casetype', $type)->orderBy('created_at', 'desc')->get());
    }

    public function ajax(Supportcase $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Supportfall lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	echo json_encode($id);
    	die();
    }

    public function edit(Supportcase $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Supportfall bearbeiten')) {
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

    		if($r->Beweise == "") {
    			$Beweise = "<p></p>";
    		} else {
				$Beweise = $r->Beweise;
    		}

    		if($r->Entscheidung == "") {
    			$Entscheidung = "<p></p>";
    		} else {
    			$Entscheidung = $r->Entscheidung;
    		}

    		$id->Beweise = $Beweise;
    		$id->Entscheidung = $Entscheidung;

    		$id->save();

    		Log::create(['user_id' => $r->user()->id, 'model' => 'SUPPORTCASES', 'action' => 'EDIT', 'dataold' => json_encode($old), 'datanew' => json_encode($id)]);

    		return redirect()->back()->with('success', 'Der Supportfall wurde gespeichert!');

    	} else {
    		return view('supportcase.edit')->with('case', $id);
    	}
    }

    public function delete(Supportcase $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Supportfall löschen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;
    	$id->delete();

    	Log::create(['user_id' => $r->user()->id, 'model' => 'SUPPORTCASES', 'action' => 'DELETE', 'dataold' => json_encode($old), 'datanew' => '-']);

    	return redirect()->back()->with('success', 'Der Supportfall wurde gelöscht!');
    }

    public function create(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Supportfall erstellen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($r->isMethod('post')) {


    		if($r->Beweise == "") {
    			$Beweise = "<p></p>";
    		} else {
				$Beweise = $r->Beweise;
    		}

    		if($r->Entscheidung == "") {
    			$Entscheidung = "<p></p>";
    		} else {
    			$Entscheidung = $r->Entscheidung;
    		}

	    	$case = Supportcase::create([

	    		'type' => $r->type,
	    		'casetype' => $r->casetype,
	    		'supporter' => implode(", ", $r->supporter),
	    		'spieler' => $r->spieler,
	    		'scn' => $r->scn,
	    		'geschehen' => $r->geschehen,
	    		'Beweise' => $Beweise,
	    		'Entscheidung' => $Entscheidung,
	    		'done' => $r->done,
	    	]);
	    	Log::create(['user_id' => $r->user()->id, 'model' => 'SUPPORTCASES', 'action' => 'CREATE', 'datanew' => json_encode($case), 'dataold' => '-']);
	    	return redirect()->back()->with('success', 'Der Supportfall wurde angelegt!');
    	} else {
    		return view('supportcase.create');
    	}
    }
}
