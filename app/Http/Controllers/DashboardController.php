<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use App\User;

class DashboardController extends ViaAuthController
{
    public function home(Request $r)
    {
    	if($this->isLocked($r)) return redirect('locked');

    	return view('home');
    }

    public function permissioninit()
    {


    	/*$host = '147.135.186.145/3050:E:\\GTA5\\Roleplay.FDB';
		$dbh = ibase_connect($host, "TEST", "FFz9fDuAd9Kgmua8");
		$stmt = 'SELECT * FROM PLAYER_ACCOUNT';
		$sth = ibase_query($dbh, $stmt);
		while ($row = ibase_fetch_object($sth)) {
		    echo $row->PASSWORD, "\n";
		}
		ibase_free_result($sth);
		ibase_close($dbh);*/

		$dbh = new \PDO("firebird:dbname=147.135.186.145/3050:E:\GTA5\Roleplay.FDB", "TEST", "FFz9fDuAd9Kgmua8");
	    $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	    $stmt = $dbh->query('SELECT * FROM PLAYER_CHARACTER'); 

    	//$str_conn='firebird:DataSource=147.135.186.145;charset=UTF8;';
		//$dbh = new \PDO($str_conn, "TEST", "FFz9fDuAd9Kgmua8");
		//$stmt = $db->query('SELECT * FROM PLAYER_CHARACTER');
 
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		    echo $row['field1'].' '.$row['field2'];
		    $result = "";
		    foreach ($row as $key => $value) {
		    	$result = $row[$key] . " ";
		    }
		    $result = $result . " <br>";
		}

		echo $result;
		die();


        // print_r(\PDO::getAvailableDrivers());
        // die();

    	//User::where('email', 'sprechblase@hotmail.com')->first()->givePermissionTo('Benutzerverwaltung lesen', 'Benutzerverwaltung bearbeiten', 'Benutzerverwaltung löschen', 'Benutzerverwaltung erstellen');

        // Permission::create(['name' => 'I am the Master']);

        /*Permission::create(['name' => 'Docs lesen']);
        Permission::create(['name' => 'Docs bearbeiten']);
        Permission::create(['name' => 'Docs löschen']);
        Permission::create(['name' => 'Docs erstellen']);*/

        /*Permission::create(['name' => 'Banprotokoll lesen']);
        Permission::create(['name' => 'Banprotokoll bearbeiten']);
        Permission::create(['name' => 'Banprotokoll löschen']);
        Permission::create(['name' => 'Banprotokoll erstellen']);*/

        /*Permission::create(['name' => 'Pad lesen']);
        Permission::create(['name' => 'Pad bearbeiten']);
        Permission::create(['name' => 'Pad löschen']);
        Permission::create(['name' => 'Pad erstellen']);

        Permission::create(['name' => 'Pad Support']);
        Permission::create(['name' => 'Pad Projektleitung']);
        Permission::create(['name' => 'Pad Entwicklung']);*/

        // Permission::create(['name' => 'Position lesen']);
        // Permission::create(['name' => 'Position bearbeiten']);
        // Permission::create(['name' => 'Position löschen']);
        // Permission::create(['name' => 'Position erstellen']);

        // Permission::create(['name' => 'Benutzerverwaltung lesen']);
        // Permission::create(['name' => 'Benutzerverwaltung bearbeiten']);
        // Permission::create(['name' => 'Benutzerverwaltung löschen']);
        // Permission::create(['name' => 'Benutzerverwaltung erstellen']);
        
        // Permission::create(['name' => 'Log lesen']);

    	// Permission::create(['name' => 'Supportfall lesen']);
    	// Permission::create(['name' => 'Supportfall bearbeiten']);
    	// Permission::create(['name' => 'Supportfall löschen']);
    	// Permission::create(['name' => 'Supportfall erstellen']);
    }
}
