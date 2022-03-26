<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use App\Position;

class UserController extends ViaAuthController
{
    public function list(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Benutzerverwaltung lesen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	return view('user.list')->with('users', User::orderBy('created_at', 'desc')->get());
    }

    public function info(User $id, Request $r)
    {
        if($this->isLocked($r)) return redirect('locked');
        if(!$r->user()->hasPermissionTo('Benutzerverwaltung lesen')) {
            return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
        }

        return view('user.info')->with('user', $id);
    }

    public function edit(User $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Benutzerverwaltung bearbeiten')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

        if(!(Position::where('id', $id->position_id)->first()->priority < Position::where('id', $r->user()->position_id)->first()->priority || $r->user()->email == "sprechblase@hotmail.com" || Position::where('id', $r->user()->position_id)->first()->position == "Projektleitung"))
        {
            return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
        }

    	$old = $id;

    	if($r->isMethod('post')) {

    		foreach($id->getFillable() as $prop)
    		{
    			if($prop == "password") {
    				continue;
    			}

    			if($r->$prop != "") {
					$id->$prop = $r->$prop;
    			}
    		}

    		if($id->password != $r->password) {
    			$id->password = bcrypt($r->password);
    		}

    		$id->syncPermissions($r->permissions);

    		$id->save();

    		Log::create(['user_id' => $r->user()->id, 'model' => 'USERS', 'action' => 'EDIT', 'dataold' => json_encode($old), 'datanew' => json_encode($id)]);

    		return redirect()->back()->with('success', 'Der User wurde gespeichert!');

    	} else {
    		return view('user.edit')->with('user', $id);
    	}
    }

    public function selfedit(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	$old = $r->user();

    	if($r->isMethod('post')) {

    		foreach($r->user()->getFillable() as $prop)
    		{

    			if($prop == "password") {
    				continue;
    			}

    			if($r->$prop != "") {
					$r->user()->$prop = $r->$prop;
    			}
    		}

    		if($r->user()->password != $r->password) {
    			$r->user()->password = bcrypt($r->password);
    		}


    		$r->user()->save();

    		Log::create(['user_id' => $r->user()->id, 'model' => 'USERS', 'action' => 'SELFEDIT', 'dataold' => json_encode($old), 'datanew' => json_encode($r->user())]);

    		return redirect()->back()->with('success', 'Du hast deine Daten bearbeitet!');

    	} else {
    		return view('user.selfedit')->with('user', $r->user());
    	}
    }

    public function delete(User $id, Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Benutzerverwaltung löschen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	$old = $id;
    	$id->delete();

    	Log::create(['user_id' => $r->user()->id, 'model' => 'USER', 'action' => 'DELETE', 'dataold' => json_encode($old), 'datanew' => '-']);

    	return redirect()->back()->with('success', 'Der User wurde gelöscht!');
    }

    public function create(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');
    	if(!$r->user()->hasPermissionTo('Benutzerverwaltung erstellen')) {
    		return redirect()->back()->with('error', 'Du hast nicht die benötigten Zugriffsrechte!');
    	}

    	if($r->isMethod('post')) {

    		$user = new User();
    		$user->name = $r->name;
    		$user->position_id = $r->position_id;
    		$user->email = $r->email;
    		$user->password = bcrypt($r->password);
    		$user->save();

	    	/*$user = User::create([
	            'name' => $r->name,
	            'position_id' => $r->position_id,
	            'email' => $r->email,
	            'password' => bcrypt($r->password),
        	]);*/

        	
        	$user->syncPermissions($r->permissions);

	    	Log::create(['user_id' => $r->user()->id, 'model' => 'USER', 'action' => 'CREATE', 'datanew' => json_encode($user), 'dataold' => '-']);
	    	return redirect()->back()->with('success', 'Der User wurde angelegt!');
    	} else {
    		return view('user.create');
    	}
    }
}
