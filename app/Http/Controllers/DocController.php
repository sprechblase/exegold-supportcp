<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docs;
use App\User;
use App\Log;
use App\Position;

class DocController extends ViaAuthController
{
    public function open(Docs $id, Request $r)
    {
        if($this->isLocked($r)) return redirect('locked');
        if(!$r->user()->hasPermissionTo('Docs lesen')) {
            return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
        }

        if(!(strpos($id->access, Position::where('id', $r->user()->position_id)->first()->position) !== false)){
            return redirect()->back()->with('error', 'Das Dokument ist nicht für dich bestimmt!');
        }

        return view('doc.open')->with('doc', $id);
    }

    public function team(Docs $id, Request $r)
    {
        if($this->isLocked($r)) return redirect('locked');
        if(!$r->user()->hasPermissionTo('Docs lesen')) {
            return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
        }

        return view('doc.team')->with('positions', Position::orderBy('priority', 'desc')->get())->with('users', User::orderBy('created_at', 'desc')->get());
    }

    public function list(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Docs lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('doc.list')->with('docs', Docs::orderBy('created_at', 'desc')->get());
    }

    public function edit(Docs $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Docs bearbeiten')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;

    	if($r->isMethod('post')) {

    		foreach($id->getFillable() as $prop)
    		{
    			if($prop == "access") {
    				$id->access = implode(", ", $r->access);
    			} else {
    				$id->$prop = $r->$prop;
    			}

    		}

    		$id->save();

    		Log::create(['user_id' => $r->user()->id, 'model' => 'DOCS', 'action' => 'EDIT', 'dataold' => json_encode($old), 'datanew' => json_encode($id)]);

    		return redirect()->back()->with('success', 'Das Doc wurde gespeichert!');

    	} else {
    		return view('doc.edit')->with('doc', $id);
    	}
    }

    public function delete(Docs $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Docs löschen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;
    	$id->delete();

    	Log::create(['user_id' => $r->user()->id, 'model' => 'DOCS', 'action' => 'DELETE', 'dataold' => json_encode($old), 'datanew' => '-']);

    	return redirect()->back()->with('success', 'Das Doc wurde gelöscht!');
    }

    public function create(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Docs erstellen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($r->isMethod('post')) {

	    	$case = Docs::create([

	    		'access' => implode(", ", $r->access),
	    		'description' => $r->description,
	    		'iframelink' => $r->iframelink,
	    	]);
	    	Log::create(['user_id' => $r->user()->id, 'model' => 'DOCS', 'action' => 'CREATE', 'datanew' => json_encode($case), 'dataold' => '-']);
	    	return redirect()->back()->with('success', 'Das Doc wurde angelegt!');
    	} else {
    		return view('doc.create');
    	}
    }
}
